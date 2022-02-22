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
        
        $kec_id = 0;

        $cek_duplicate = $this->admin->get_array('members',array( 'nomor_wa' => $this->input->post('nomor_wa',true)));
        if(!empty($cek_duplicate)){
            $this->session->set_flashdata('message', 'Selamat anda sudah terdaftar di Prastika Collection <br><br>
        <div style="color: darkblue;font-weight: bold;text-align:center">ID MEMBER :<br>' . $cek_duplicate['kode_member'] . '</div><br>
        Harap simpan kode member ini untuk bertransaksi di facebook setiap saat.<br><div style="font-size:15px;font-weight:600">**Anda bisa kembali ke Facebook untuk bertransaksi.</div>');
            redirect('Register');
        }
       
        $cek_kec_id = $this->admin->get_array('tb_kecamatan',array( 'subdistrict_name' => $this->input->post('kecamatan',true)));
        if(!empty($cek_kec_id)){
            $kec_id = $cek_kec_id['subdistrict_id'];
        }

        $this->db->from('members');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $get_last = $this->db->get()->row_array();
        $kode = 'A1';
        if(!empty($get_last)){
            $urut = preg_replace('/[^0-9]/', '', $get_last['kode_member']);
            $prefix = preg_replace('/[^a-zA-Z]/', '',$get_last['kode_member']);
            // print("<pre>".print_r($prefix,true)."</pre>");exit();
  
            if($urut > 999){
                ++$prefix;
                $kode = $prefix . '1';
            }else{
                $kode = $prefix . ((int)$urut+1);
            }
        }

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
            'kode_member' => $kode,
            'kec_id' => $kec_id
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
        <div style="color: darkblue;font-weight: bold;text-align:center">ID MEMBER :<br>' . $kode . '</div><br>
        Harap simpan kode member ini untuk bertransaksi di facebook setiap saat.<br><div style="font-size:15px;font-weight:600">**Anda bisa kembali ke Facebook untuk bertransaksi.</div>');


        $msg = "*Selamat anda sudah terdaftar di Prastika Collection*
==================================================
ID MEMBER : ". $kode ."
EMAIL: ". $this->input->post('email',true) ."
NOMOR : ". $this->input->post('nomor_wa',true) ."
KOTA : ". $this->input->post('kota',true) ."

*Note : **Harap simpan kode member ini untuk bertransaksi di facebook setiap saat. Anda bisa kembali ke Facebook untuk bertransaksi.*";
        // $this->admin->simpan_wa($this->input->post('nomor_wa',true), $msg);

        redirect('Register');
    }
  
  public function Rekap()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    
    $postingan = $this->admin->get_array('postingan',array( 'id_posting' => $this->input->get('id_posting',true)));
    if(empty($postingan)){
        goto finish;
    }    

    $format_order = $postingan['format_order']; 
    $arr_kode = explode(".", $this->input->get('kode',true));

    if(empty($format_order)) goto finish;
    $arr_format = explode(".", $format_order);

    $qty = 1;
    if($arr_format[1] === "QTY"){
        $qty = $arr_kode[1];
    }

    $idmember = "";
    if($arr_format[1] === "IDMEMBER"){
        $idmember = $arr_kode[1];
    }else{
        $idmember = $arr_kode[2];
    }

    $kode = "ODR-" . date("ymd-his");

    $this->db->trans_begin();
    $barang = $this->admin->get_array('barang',array( 'kode_barang' => strtoupper($arr_kode[0]) ));
    $member = $this->admin->get_array('members',array( 'kode_member' => $idmember));
    $exist = $this->admin->get_array('rekapan',array( 'kode_comment' => $this->input->get('kode',true), 'id_posting' => $this->input->get('id_posting',true)));
    // print("<pre>".print_r($barang,true)."</pre>");exit();

    if(empty($exist) && !empty($barang) && !empty($member)){

        $results_ongkir = $this->admin->cek_ongkir('746',$member['kec_id'],$barang['berat']);

        $data = array(
            'kode_order'    => $kode,
            'id_member'     => $idmember,
            'qty'           => $qty,
            'kode_product'  => strtolower($arr_kode[0]),
            'pesan'         => $this->input->get('pesan',true),
            'id_posting'    => $this->input->get('id_posting',true),
            'kode_comment'  => $this->input->get('kode',true),
            'kode_rand'     => '',
            'total'         => (($qty * (float)$barang['harga'])),
            'ongkir'        => $results_ongkir['costs'][0]['cost'][0]['value'],
            'courier'       => $results_ongkir['name'],
            'service'       => $results_ongkir['costs'][0]['service']
        );
        $result  = $this->db->insert('rekapan', $data);
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;

            $msg = "*Kode Deal ". $kode ."*
-----------------------------------
ID MEMBER : ". $idmember ."
NAMA: ". $member['nama_lengkap'] ."
TANGGAL: ". date("Y-m-d H:i:s") ."

BARANG : ". $barang['kode_barang'] ." ". $barang['nama_barang'] ."
JUMLAH : ". $qty ."
HARGA : ". number_format($barang['harga']) ."

------------------------------------
*Note : Harga diatas belum termasuk Ongkir.*

_Tim Prastika Collection_";
    // $this->admin->simpan_wa($member['nomor_wa'], $msg);
      }
    }
    $this->db->trans_complete();        

    finish:              
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}



// ONGKIR : ". number_format($results_ongkir['costs'][0]['cost'][0]['value']) ."
//EXPDS : ". $results_ongkir['name'] ."
