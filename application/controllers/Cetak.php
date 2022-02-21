<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
		$page=$this->input->get("p", TRUE);

		if($this->admin->logged_id())
	    {
			$data['title'] = 'Laporan';
			$data['main'] = 'laporan/index';
			$data['js'] = 'script/laporan';
			$bln = date('m');
			$thn = date('Y');
			
			$id="";
			if(!empty($this->input->get("id", TRUE))){
				$id=$this->input->get("id", TRUE);
			}
			$data['page'] = $page;

			$arr = array();
			$arr_sum = array();

			if ($page == 'invoice'){	
				$this->db->from("invoice");
		      	// $this->db->join("barang","barang.kode_barang=rekapan.kode_product");
		      	$this->db->join("members","members.id=invoice.id_member");
		      	$this->db->where("kode_inv",$id);
	        	$data['header'] = $this->db->get()->row_array();

	          	$this->db->select("kode_order,kode_barang,nama_barang,qty,berat,harga");
	          	$this->db->from("rekapan");
	          	$this->db->join("barang","barang.kode_barang=rekapan.kode_product");
	          	$this->db->where(array("id_posting" => $data['header']['id_posting'], "id_member" => $data['header']['id_member']));
	          	$data['detail'] = $this->db->get()->result_array();
				$this->load->view('cetak_thermal',$data,FALSE); 
			}
			// print("<pre>".print_r($data,true)."</pre>"); exit();	

	    }else{
	        redirect("login");

	    }	
	    			  
						
	}

}
