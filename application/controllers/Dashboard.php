<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){

            $data['title'] = 'Home';
            $data['main'] = 'dashboard';
			$data['js'] = 'dashboard/js';
            $data['modal'] = 'modal/dashboard';
			$this->load->view('dashboard',$data,FALSE); 

        }else{

            redirect("login");

        }				  			
	}

    public function notifikasi($id){
        $this->db->from('tb_notifikasi');
        $this->db->where('read',0);
        $query = $this->db->where('sent_to', $id)->get();
        $data['notifikasi'] = $query->result();
        $data['notifikasi_count'] = $query->num_rows();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
	
}
