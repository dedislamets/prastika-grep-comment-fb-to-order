<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Mutasi',null, 'mutasi');
		$this->load->model('admin');
	}

	public function callback(){
		$data = $this->mutasi->callback();
		if(isset($data['status']) && $data['status']==true){
			//do something with this data
			file_put_contents('log-mutasi.txt',json_encode($data)."\n", FILE_APPEND);
			$response = $data;

			// print("<pre>".print_r($response['data'],true)."</pre>");exit();
			/*foreach($response['data'] as $key => $value) {
		        $data = array(
			        'id_provinsi'  => $value->province_id,
			        'provinsi' 	=> $value->province,
			    );

			    $result  = $this->db->insert('tb_provinsi', $data);
		    }*/

			$credit = $response['data'][0]->credit;

			$cek_kode = $this->admin->get_array('rekapan',array( 'total' => $credit, 'status' => 'Booking'));
		    if(!empty($cek_kode)){
		        
				$data = array(
			        'metode_bayar'  => $response['data'][0]->bank_name,
			        'payment_date' => $response['data'][0]->created,
			        'status'         => 'Payment',
			    );

				$this->db->set($data);
	          	$this->db->where('kode_order', $cek_kode['kode_order']);
	          	$result  =  $this->db->update('rekapan');  

	          	$member = $this->admin->get_array('members',array( 'id' => $cek_kode['id_member'] ));
	          	$msg = "*Pembayaran Diterima*
-----------------------------------
NO INVOICE : ". $cek_kode['kode_order'] ."
BANK: ". $response['data'][0]->bank_name ."
TANGGAL: ". $response['data'][0]->created ."
REKENING : ". $response['data'][0]->account_number ."
TOTAL : ". number_format($credit) ."

------------------------------------
*Note : Pembayaran berhasil, pesanan anda akan segera kami proses.*

_Tim Prastika Collection_";
    $this->admin->kirim_wa($member['nomor_wa'], $msg);

		    }

		}
	}

	public function get_user_info(){
		$data = $this->mutasi->user_info();
		file_put_contents('log-mutasi.txt',json_encode($data)."\n", FILE_APPEND);
	}

	public function index()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Penjualan';
			$data['main'] = 'order/index';
			$data['js'] = 'script/order';
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
          0=>'kode_order',
          1=>'order_date',
          2=>'nama_lengkap',
          3=>'kode_barang',
          4=>'nama_barang',
          5=>'qty',
          6 => 'harga',
          7 => 'subtotal',
          8 => 'rekapan.status'
      );
      $valid_sort = array(
          0=>'kode_order',
          1=>'order_date',
          2=>'nama_lengkap',
          3=>'kode_barang',
          4=>'nama_barang',
          5=>'qty',
          6 => 'harga',
          7 => 'subtotal',
          8 => 'rekapan.status'
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
      $this->db->select("rekapan.*,nama_lengkap,kode_barang,nama_barang,harga");
      $this->db->from("rekapan");
      $this->db->join("barang","barang.kode_barang=rekapan.kode_product",'left');
      $this->db->join("members","members.id=rekapan.id_member",'left');

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      $r->kode_order,
                      $r->order_date,
                      $r->id_member .' - '. $r->nama_lengkap,
                      $r->kode_barang,
                      $r->nama_barang,
                      $r->qty,
                      number_format($r->harga),
                      number_format($r->harga * $r->qty),
                      $r->status,
                      '<a href="'. base_url() .'order/invoice/'. $r->kode_order .'" class="btn btn-warning btn-sm " >
                        <i class="icofont icofont-ui-edit"></i>Detail
                      </a>',
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

	    $this->db->from("rekapan");
      	$this->db->join("barang","barang.kode_barang=rekapan.kode_product");
      	$this->db->join("members","members.id=rekapan.id_member");
	    $query = $this->db->get();
	    $result = $query->row();
	    if(isset($result)) return $result->num;
	    return 0;
  	}

  	public function invoice($id)
  	{   
    	if($this->admin->logged_id())
      	{
      		$data['title'] = 'Edit Barang';
      		$data['main'] = 'order/invoice';
      		$data['js'] = 'script/order';
      		$data['mode'] = 'Edit';

      		$this->db->from("rekapan");
	      	$this->db->join("barang","barang.kode_barang=rekapan.kode_product");
	      	$this->db->join("members","members.id=rekapan.id_member");
	      	$this->db->where("kode_order",$id);
        	$data['header'] = $this->db->get()->row_array();

      		// $data['barang'] = $this->admin->get_array('barang',array( 'kode_barang' => $id));
      
      		$this->load->view('dashboard',$data,FALSE); 

      	}else{
        	redirect("login");

      	}                 
  	}
}