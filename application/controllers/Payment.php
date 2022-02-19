<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

class Payment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin');
	}

	public function index()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Penjualan';
			$data['main'] = 'payment/index';
			$data['js'] = 'script/payment';
			// $data['modal'] = 'modal/barang';
	    // $data['jenis'] = $this->admin->getmaster('jenis_barang');

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  						
	}

	public function dataTable()
  	{
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $order = $this->input->get("order");
      $search= $this->input->get("search");
      $search = $search['value'];
      $col = 10;
      $dir = "";

      if(!empty($order))
      {
          foreach($order as $o)
          {
              $col = $o['column'];
              $dir= $o['dir'];
          }
      }

      if($dir != "asc" && $dir != "desc")
      {
          $dir = "desc";
      }

      $valid_columns = array(
          0=>'id',
          1=>'module',
          2=>'system_date',
          3=>'description',
          4=>'type',
          5=>'amount',
          6 => 'balance',
      );
      $valid_sort = array(
          0=>'id',
          1=>'module',
          2=>'system_date',
          3=>'description',
          4=>'type',
          5=>'amount',
          6 => 'balance',
      );
      if(!isset($valid_sort[$col]))
      {
          $order = null;
      }
      else
      {
          $order = $valid_sort[$col];
      }
      if($order !=null)
      {
          $this->db->order_by($order, $dir);
      }
      
      if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
      $this->db->limit($length,$start);
      $this->db->from("mutasi");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      $r->id,
                      strtoupper($r->module),
                      $r->system_date,
                      $r->description,
                      $r->type,
                      number_format($r->amount),
                      number_format($r->balance),
                 );
      }
      $total_pengguna = $this->totalPengguna($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  	}

  	public function totalPengguna($search, $valid_columns)
  	{
    	$query = $this->db->select("COUNT(*) as num");
    	if(!empty($search))
      	{
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      	}

	    $this->db->from("mutasi");
	    $query = $this->db->get();
	    $result = $query->row();
	    if(isset($result)) return $result->num;
	    return 0;
  	}

  	
}