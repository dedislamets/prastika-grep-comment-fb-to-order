<?php
/* 
	Contoh Controller 
*/

class Mutasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('Mutasi',null, 'mutasi');
	}

	/*
		anda dapat mengakses callback melalui 
		http://domain-anda.com/example/callback
	*/
	public function callback(){
		$data = $this->mutasi->callback();
		if(isset($data['status']) && $data['status']==true){
			//do something with this data
			file_put_contents('log-mutasi.txt',json_encode($data)."\n", FILE_APPEND);
		}
	}

	public function get_user_info(){
		$data = $this->mutasi->user_info();
		file_put_contents('log-mutasi.txt',json_encode($data)."\n", FILE_APPEND);
	}
}