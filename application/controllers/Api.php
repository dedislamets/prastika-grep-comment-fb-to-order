<?php

    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    header('Content-Type: application/json');

// Default
// $users = [
//     ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
//     ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
// ];

// $id = $this->get( 'id' );

// if ( $id === null )
// {
//     if ( $users )
//     {
//         $this->response( $users, 200 );
//     }
//     else
//     {
//         $this->response( [
//             'status' => false,
//             'message' => 'No users were found'
//         ], 404 );
//     }
// }
// else
// {
//     if ( array_key_exists( $id, $users ) )
//     {
//         $this->response( $users[$id], 200 );
//     }
//     else
//     {
//         $this->response( [
//             'status' => false,
//             'message' => 'No such user found'
//         ], 404 );
//     }
// }
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController  {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function koneksi_get()
    {   

        $this->response([
                'status' => true,
            ], 200 );
    }
    public function room_get()
    {
        $shift = $this->admin->api_array('tb_ruangan');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'data' => array(),
                'message' => 'No data were found'
            ], 200 );
        }
    }

    public function notifikasi_get()
    {
        $shift = $this->admin->api_array('tb_notifikasi',array("sent_to"=> $this->get('id') ));

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'data' => array(),
                'message' => 'No users were found'
            ], 200 );
        }
    }

    public function barang_get()
    {
        $shift = $this->admin->api_array('barang');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }

    public function config_get()
    {
        $shift = $this->admin->api_array('tb_setting');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }

    public function jenis_get()
    {
        $shift = $this->admin->api_array('jenis_barang');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }

    public function pic_get()
    {
        $shift = $this->admin->api_array('tb_user');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }

    public function defect_get()
    {
        $shift = $this->admin->api_array('tb_defect');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }

    public function kategori_get()
    {
        $shift = $this->admin->api_array('kategori');

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No data were found'
            ], 404 );
        }
    }


    public function cari_room_get()
    {
        $data =array(
            "ruangan"=>$this->get('ruangan'),
            
        );
        $shift = $this->admin->get_like_array('tb_ruangan',$data);

        if ($shift != FALSE) {
            $this->response([
                'status' => true,
                'data' => $shift
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }
    public function login_post()
    {
        $data =array(
            "email"=>$this->post('email'),
            "password"=> $this->Acak($this->input->post('password', TRUE), "goldenginger"),
        );

        $this->db->from('tb_user');
        $this->db->join('tb_group_user','tb_group_user.id_user=tb_user.id_user');
        $this->db->join('tb_group_role','tb_group_role.id=tb_group_user.id_group_role');
        $this->db->where($data);
        $shift = $this->db->get()->row();

        if ($shift != FALSE) {
            $this->response($shift, 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }
    function Acak($varMsg,$strKey) {
        try {
            $Msg = $varMsg;
            $char_replace="";
            $intLength = strlen($Msg);
            $intKeyLength = strlen($strKey);
            $intKeyOffset = $intKeyLength;
            $intKeyChar = ord(substr($strKey, -1));
            for ($n=0; $n < $intLength ; $n++) { 
                $intKeyOffset = $intKeyOffset + 1;

                if($intKeyOffset > $intKeyLength) {
                    $intKeyOffset = 1;
                }
                $intAsc = ord(substr($Msg,$n, 1));

                if($intAsc > 32 && $intAsc < 127){
                    $intAsc = $intAsc - 32;
                    $intAsc = $intAsc + $intKeyChar;

                    while ( $intAsc > 94) {
                       $intAsc = $intAsc - 94;
                    }

                    $intSkip = $n+1 % 94;
                    $intAsc = $intAsc + $intSkip;
                    if($intAsc > 94){
                        $intAsc = $intAsc - 94;
                    }

                    $char_replace .= chr($intAsc + 32);
                    
                    $Msg = $char_replace . substr($varMsg, $n+1) ;
                }

                $intKeyChar = ord(substr($strKey, $intKeyOffset-1));
            }
            return $Msg;
        } catch (Exception $e) {
            
        }
    }

    public function linen_bersih_all_get()
    {
        $linen_bersih = $this->admin->api_array('linen_bersih');
        $linen_bersih_detail = $this->admin->api_array('linen_bersih_detail');

        foreach ($linen_bersih_detail as $key => $value) {
            $this->db->from('barang');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->where(array( 'serial' => $value['epc']));
            $data_exist = $this->db->get()->row();
            if(!empty($data_exist)){
                $linen_bersih_detail[$key]['item'] = $data_exist->jenis;
                $linen_bersih_detail[$key]['berat'] = $data_exist->berat;
            }
        }

        if ($linen_bersih != FALSE) {
            $this->response([
                'status' => true,
                'data' => $linen_bersih,
                'data_detail' => $linen_bersih_detail
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }

    public function request_linen_all_get()
    {
        $linen_request = $this->admin->api_array('request_linen');
        $linen_request_detail = $this->admin->api_array('request_linen_detail');

        if ($linen_request != FALSE) {
            $this->response([
                'status' => true,
                'data' => $linen_request,
                'data_detail' => $linen_request_detail
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }
  
    public function linen_kotor_get()
    {
        $linen_kotor = $this->admin->api_array('linen_kotor','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');
        $linen_kotor_detail = $this->admin->api_array('linen_kotor_detail','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');

        foreach ($linen_kotor_detail as $key => $value) {
            $this->db->from('barang');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->where(array( 'serial' => $value['epc']));
            $data_exist = $this->db->get()->row();
            if(!empty($data_exist)){
                $linen_kotor_detail[$key]['item'] = $data_exist->jenis;
            }
        }

        if ($linen_kotor != FALSE) {
            $this->response([
                'status' => true,
                'data' => $linen_kotor,
                'data_detail' => $linen_kotor_detail
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }

    public function linen_bersih_get()
    {
        $linen_bersih = $this->admin->api_array('linen_bersih','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');
        $linen_bersih_detail = $this->admin->api_array('linen_bersih_detail','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');

        foreach ($linen_bersih_detail as $key => $value) {
            $this->db->from('barang');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->where(array( 'serial' => $value['epc']));
            $data_exist = $this->db->get()->row();
            if(!empty($data_exist)){
                $linen_bersih_detail[$key]['item'] = $data_exist->jenis;
                $linen_bersih_detail[$key]['berat'] = $data_exist->berat;
            }
        }

        if ($linen_bersih != FALSE) {
            $this->response([
                'status' => true,
                'data' => $linen_bersih,
                'data_detail' => $linen_bersih_detail
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }

    public function linen_keluar_get()
    {
        $linen_bersih = $this->admin->api_array('linen_keluar','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');
        $linen_bersih_detail = $this->admin->api_array('linen_keluar_detail','DATEDIFF(CURRENT_INSERT,CURDATE()) > -4');

        foreach ($linen_bersih_detail as $key => $value) {
            $this->db->from('barang');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->where(array( 'serial' => $value['epc']));
            $data_exist = $this->db->get()->row();
            if(!empty($data_exist)){
                $linen_bersih_detail[$key]['item'] = $data_exist->jenis;
                $linen_bersih_detail[$key]['berat'] = $data_exist->berat;
            }
        }

        if ($linen_bersih != FALSE) {
            $this->response([
                'status' => true,
                'data' => $linen_bersih,
                'data_detail' => $linen_bersih_detail
            ], 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }

    public function hapus_linen_get()
    {
        // echo $this->get('id');exit();
        $del = $this->admin->deleteTable('serial', $this->get('serial') ,'barang');

        if ($del) {
            $this->response([
                'status' => 200,
                'message' => "Berhasil dihapus"
            ], 200 );
        }else{

            $this->response( [
                'status' => 502,
                'message' => 'Gagal menghapus data'
            ], 404 );
        }
    }

    public function wa_get()
    {
        // print("<pre>".print_r($this->post(),true)."</pre>");exit();
        $response= [];
        $response['false']=true;
        // if(empty($this->post('pesan', true))){
        //     $response['error']=true;
        //     $response['msg'][]= "Tidak ada pesan dikirim";
        // }
        // if(empty($this->post('hp', true))){
        //     $response['error']=true;
        //     $response['msg'][]= "Tidak ada nomor hp dikirim";
        // }
        $this->db->from("job_pesan");
        $this->db->where("sent",0);
        $this->db->order_by("created ASC");
        $this->db->limit(5);
        $job = $this->db->get()->result_array();

        foreach ($job as $key => $value) {
            $sent = $this->admin->kirim_wa($value['no_hp'],$value['pesan']);
            $response['sent'][]= $value['no_hp'] . " - ". $value['pesan'];
            $data['sent'] = 1;
            $this->db->set($data);
            $this->db->where('id', $value['id']);
            $result  =  $this->db->update('job_pesan'); 
        }
        $this->response($response,200);
    }

    public function linen_kotor_post()
    {
        $arr_date = explode("/", $this->post('tanggal'));
        $data =array(
            "NO_TRANSAKSI"  => $this->post('no_transaksi'),
            "TANGGAL"       => $arr_date[2] . "-" . $arr_date[1]. "-". $arr_date[0],
            "PIC"           => $this->post('pic'),
            "STATUS"        => 'CUCI',
            "KATEGORI"        => $this->post('kategori'),
            "F_INFEKSIUS"        => $this->post('infeksius'),
            "TOTAL_BERAT"        => $this->post('total_berat'),
            "TOTAL_QTY"        => $this->post('total_qty'),
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_kotor',array( 'NO_TRANSAKSI' => $this->post('no_transaksi')));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_kotor", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';
            }
        }
        
        $this->response($response);
    }

    public function linen_keluar_post()
    {
        $arr_date = explode("/", $this->post('tanggal'));
        $data =array(
            "NO_TRANSAKSI"  => $this->post('no_transaksi'),
            "TANGGAL"       => $arr_date[2] . "-" . $arr_date[1]. "-". $arr_date[0],
            "PIC"           => $this->post('pic'),
            "STATUS"        => 0,
            "RUANGAN"        => $this->post('ruangan'),
            "NO_REFERENSI"        => $this->post('no_referensi'),
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_keluar',array( 'NO_TRANSAKSI' => $this->post('no_transaksi')));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_keluar", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';
            }

             
        }
        
        $this->response($response);
    }

    public function linen_bersih_post()
    {
        $arr_tgl = explode("/",$this->post('tanggal') );
        $tgl = $arr_tgl[2] . "-" . $arr_tgl[1] . "-" . $arr_tgl[0];
        $data =array(
            "NO_TRANSAKSI"  => $this->post('no_transaksi'),
            "TANGGAL"       => $tgl,
            "PIC"           => $this->post('pic'),
            "STATUS"        => $this->post('status'),
            "KATEGORI"      => "",
            "TOTAL_BERAT"   => $this->post('total_berat'),
            "TOTAL_BERAT_REAL"  => $this->post('total_berat_real'),
            "TOTAL_QTY"     => $this->post('total_qty'),
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_bersih',array( 'NO_TRANSAKSI' => $this->post('no_transaksi')));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_bersih", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';

                unset($data);
                $data['status'] = 'BERSIH';
                $this->db->set($data);
                $this->db->where('NO_TRANSAKSI', $this->input->post('no_transaksi'));
                $result  =  $this->db->update('linen_kotor');  
            }
        }
        
        $this->response($response);
    }

    public function linen_kotor_detail_post()
    {
        $data =array(
            "no_transaksi"  => $this->post('no_transaksi'),
            "epc"           => $this->post('epc'),
            "ruangan"        => $this->post('room')
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_kotor_detail',array( 'no_transaksi' => $this->post('no_transaksi'), 'epc' => $this->post('epc') ));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_kotor_detail", $data);
            if($insert){

                $this->db->set(array("kotor" => 1));
                $this->db->where(array( "epc" => $this->post('epc'), "kotor" => 0 ));
                $this->db->update('linen_keluar_detail');

                $this->db->set(array("nama_ruangan" => $this->post('room')));
                $this->db->where(array( "serial" => $this->post('epc') ));
                $this->db->update('barang');

                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';
            }

        }
        
        $this->response($response);
    }

    public function linen_bersih_detail_post()
    {
        $data =array(
            "no_transaksi"  => $this->post('no_transaksi'),
            "epc"           => $this->post('epc'),
            "ruangan"        => $this->post('room'),
            "status_linen"        => $this->post('status_linen'),
            "checked"        => $this->post('checked')
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_bersih_detail',array( 'no_transaksi' => $this->post('no_transaksi'), 'epc' => $this->post('epc') ));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_bersih_detail", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';
            }
        }
        
        $this->response($response);
    }

    public function linen_rusak_detail_post()
    {
        $data =array(
            "no_transaksi"  => $this->post('no_transaksi'),
            "epc"           => $this->post('epc'),
            "jml_cuci"        => $this->post('jml_cuci')
        );

        $response['error']=true;
        $response['message']='Data gagal ditambahkan.';

        $data_exist = $this->admin->get_array('linen_rusak_detail',array( 'no_transaksi' => $this->post('no_transaksi'), 'epc' => $this->post('epc') ));
        if(empty($data_exist)){
            $insert = $this->db->insert("linen_rusak_detail", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data berhasil ditambahkan.';
            }
        }
        
        $this->response($response);
    }


    public function send_notif_app_get(){
        error_reporting(-1);
        ini_set('display_errors', 'On');

 
        $type = isset($_GET['type']) ? $_GET['type'] : 'single';
        
        $fields = NULL;
        $token = isset($_GET['token']) ? $_GET['token'] : 'cUzamsGi3pA:APA91bFUmb-zNoPWXvn8RgVtDhExlX8d6yPDMMWBOXVTaLjEZuOWiViZRT_h63qWJ0StNPv3bwUR6FikfSNua89gH7GlRS5wiZrifcriljsB9BIs3frmfad1Xo7-mzqxOYtc_xk23D2Y';
        
        if($type == "single") {
        // echo $token; exit();
            
            $message = isset($_GET['message']) ? $_GET['message'] : '';
            
            $res = array();
            $res['body'] = $message;
            
            $fields = array(
                'to' => $token,
                'notification' => $res,
            );
            echo json_encode($fields);
            // echo 'FCM Reg Id : '. $token . '<br/>Message : ' . $message;
        }else if($type == "topics") {
            $topics = isset($_GET['topics']) ? $_GET['topics'] : '';
            $message = isset($_GET['message']) ? $_GET['message'] : '';
            
            $res = array();
            $res['body'] = $message;
            
            $fields = array(
                'to' => '/topics/' . $topics,
                'notification' => $res,
            );
            
            echo json_encode($fields);
            echo 'Topics : '. $topics . '<br/>Message : ' . $message . '<br>';
        }
        
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = "AAAA-XXzNh4:APA91bFtdWD6MfsRH3PeYz62vYQdCNFNoXZdi5BaOyZ6AiEdIqQpYjuBplob5baO7RCU6iw-ElrX6GH60g95fTE6ltK2ejbC9XXPcfFOby4BMuVTSi2LEnPMHAxgMforeOFnJN_gCu7l";
        
        $headers = array(
            'Authorization: key=' . $server_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            echo 'Curl failed: ' . curl_error($ch);
        }else{
            echo "<br>Curl Berhasil";
        }
 
        // Close connection
        curl_close($ch);
    }
       
}