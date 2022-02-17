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
            $data['provinsi'] = $this->db->query("select * from tb_provinsi")->result();
            // $data['kota'] = $this->db->query('select distinct kota from master_city')->result();
            // $data['kecamatan'] = $this->db->query("select distinct kecamatan from master_city")->result();
            // $data['kelurahan'] = $this->db->query("select distinct kelurahan from master_city")->result();
			$this->load->view('register',$data,FALSE); 		  
						
	}

    public function getKota()
    {
        $data = $this->db->query("select distinct city_id,city_name,type from tb_kota where province='" . $this->input->get('prov',true) ."'")->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getKecamatan()
    {
        $arr = explode('. ', $this->input->get('kota',true)) ;
          // print("<pre>".print_r($arr,true)."</pre>");exit();

        $data = $this->db->query("select distinct subdistrict_id,subdistrict_name from tb_kecamatan where city='" . $arr[1] ."' and type='" . $arr[0] ."'")->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function getKelurahan()
    {
        $data = $this->db->query("select distinct kelurahan from master_city where kecamatan='" . $this->input->get('kec',true) ."'")->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
        //$this->admin->kirim_wa($this->input->post('nomor_wa',true), $msg);

        redirect('Register');
    }
  
  public function Rekap()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    
    random:
    $kode_rand = rand(100,1000); 
    $arr_kode = explode("/", $this->input->get('kode',true));

    $cek_kode = $this->admin->get_array('rekapan',array( 'kode_rand' => $kode_rand, 'status' => 'Booking'));
    if(!empty($cek_kode)){
        goto random;
    }

    $kode = "ODR-" . date("ymd-his");

    $this->db->trans_begin();
    $barang = $this->admin->get_array('barang',array( 'kode_barang' => strtolower($arr_kode[0]) ));
    $member = $this->admin->get_array('members',array( 'id' => $arr_kode[2]));
    $exist = $this->admin->get_array('rekapan',array( 'kode_comment' => $this->input->get('kode',true), 'id_posting' => $this->input->get('id_posting',true)));
    if(empty($exist)){

        $data = array(
            'kode_order'  => $kode,
            'id_member' => $arr_kode[2],
            'qty'           => $arr_kode[1],
            'kode_product'  => strtolower($arr_kode[0]),
            'pesan'         => $this->input->get('pesan',true),
            'id_posting'    => $this->input->get('id_posting',true),
            'kode_comment'  => $this->input->get('kode',true),
            'kode_rand'     => $kode_rand,
            'total'         => (((int)$arr_kode[1] * (float)$barang['harga']) + $kode_rand)
        );
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
*Note : Harga diatas belum termasuk Ongkir.*

_Tim Prastika Collection_";
    $this->admin->kirim_wa($member['nomor_wa'], $msg);
      }
    }
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
