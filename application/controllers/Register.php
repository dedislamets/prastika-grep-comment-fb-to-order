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
        $last_id = $this->db->insert_id();
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
    }

    $this->db->trans_complete();                      
    $this->session->set_flashdata('message', 'Selamat anda sudah terdaftar di Prastika Collection <br><br>
      <div style="color: darkblue;font-weight: bold;text-align:center">ID MEMBER :<br>' . $last_id . '</div><br>
      Harap simpan kode member ini untuk bertransaksi di facebook setiap saat.<br><div style="font-size:15px;font-weight:600">**Anda bisa kembali ke Facebook untuk bertransaksi.</div>');


    $msg = "*Selamat anda sudah terdaftar di Prastika Collection*
==================================================
ID MEMBER : ". $last_id ."
EMAIL: ". $this->input->post('email',true) ."
NOMOR : ". $this->input->post('nomor_wa',true) ."
KOTA : ". $this->input->post('kota',true) ."

*Note : **Harap simpan kode member ini untuk bertransaksi di facebook setiap saat. Anda bisa kembali ke Facebook untuk bertransaksi.*";
    $this->admin->kirim_wa($this->input->post('nomor_wa',true), $msg);

    redirect('Register');
  }
  
  public function Rekap()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    
    $arr_kode = explode("/", $this->input->get('kode',true));
    $kode = "ODR-" . date("ymd-his");
    $data = array(
        'kode_order'  => $kode,
        'id_member' => $arr_kode[2],
        'qty'         => $arr_kode[1],
        'kode_product' => $arr_kode[0],
        'pesan'       => $this->input->get('pesan',true),
        'id_posting'  => $this->input->get('id_posting',true),
        'kode_comment'  => $this->input->get('kode',true)
    );

    $this->db->trans_begin();
    $barang = $this->admin->get_array('barang',array( 'kode_barang' => $arr_kode[0]));
    $member = $this->admin->get_array('members',array( 'id' => $arr_kode[2]));
    $exist = $this->admin->get_array('rekapan',array( 'kode_comment' => $this->input->get('kode',true), 'status' => 'Booking'));
    if(empty($exist)){

      $result  = $this->db->insert('rekapan', $data);
      if(!$result){
          print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
          $response['error']= FALSE;

          $msg = "*Kode Rekap ". $kode ."*
-----------------------------------
ID MEMBER : ". $arr_kode[2] ."
NAMA: ". $member['nama_lengkap'] ."
TANGGAL: ". date("Y-m-d H:i:s") ."

BARANG : ". $barang['kode_barang'] ." ". $barang['nama_barang'] ."
JUMLAH : ". $arr_kode[1] ."
HARGA : ". number_format($barang['harga']) ."

------------------------------------
Bank Transfer

BCA 0183139867
Hendra Ardiansyah (otomatis sekitar 5 - 10 menit)
Rp ". number_format((int)$arr_kode[1] * (float)$barang['harga']) ."

Invoice expired 2022-02-12 21:39:40

*Note : pembayaran kamu akan kami proses secara otomatis. Jika pembayaran kamu masih belum terproses, silahkan hubungi kami.*

_Tim Prastika Collection_";
    $this->admin->kirim_wa($member['nomor_wa'], $msg);
      }
    }
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
