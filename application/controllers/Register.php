<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
			$data['title'] = 'Register';
			// $data['main'] = 'dashboard/register';
			$data['js'] = 'script/register';
			$this->load->view('register',$data,FALSE); 		  
						
	}

  public function Daftar()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $kode = "M-" . date("ymd-his");
    $data = array(
        'email'   => $this->input->post('email',true),
        'nomor_wa'   => $this->input->post('nomor_wa',true),
        'nama_lengkap'   => $this->input->post('nama_lengkap',true),
        'nama_facebook'   => $this->input->post('nama_facebook',true),
        'alamat'   => $this->input->post('alamat_lengkap',true),
        'kelurahan'   => $this->input->post('kelurahan',true),
        'kecamatan'   => $this->input->post('kecamatan',true),
        'kota'   => $this->input->post('kota',true),
        'provinsi'   => $this->input->post('provinsi',true),
        'kode_member' => $kode
    );

    $this->db->trans_begin();

    if($this->input->post('id_members',true) != "") {

        $this->db->set($data);
        $this->db->where('id', $this->input->post('id_members',true));
        $result  =  $this->db->update('members');  

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
    }else{  

        $result  = $this->db->insert('members', $data);
        
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
    }

    $this->db->trans_complete();                      
    $this->session->set_flashdata('message', 'Selamat anda sudah terdaftar di Prastika Collection <br><br>
      <div style="color: darkblue;font-weight: bold;text-align:center">KODE MEMBER :<br>' . $kode . '</div><br>
      Harap simpan kode member ini untuk bertransaksi di facebook.<br><div style="font-size:15px;font-weight:600">**Anda bisa kembali ke Facebook untuk bertransaksi.</div>');
    redirect('Register');
  }
  
  public function Rekap()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    
    $arr_kode = explode("/", $this->input->get('kode',true));

    $data = array(
        'kode_order'  => $this->input->get('kode',true),
        'kode_member' => $arr_kode[3],
        'qty'         => $arr_kode[2],
        'kode_product' => $arr_kode[1],
        'kode_book'   => $arr_kode[0],
        'pesan'   => $this->input->get('pesan',true)
    );

    $this->db->trans_begin();

    $exist = $this->admin->get_array('rekapan',array( 'kode_order' => $this->input->get('kode', true), 'status' => 'Booking'));
    if(empty($exist)){

      $result  = $this->db->insert('rekapan', $data);
      if(!$result){
          print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
          $response['error']= FALSE;
      }
    }
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
