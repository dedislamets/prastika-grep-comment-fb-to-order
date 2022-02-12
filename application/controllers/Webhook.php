<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {

        $json = file_get_contents("php://input");
        $array = json_decode($json, true);

        $pengirim = $array["number"];
        $chatid = $array["chatid"];
        $pesan = $array["message"];
        $waktu = date("Y-m-d H:i:s", $array["time"]);
        $message="";
        foreach ($_REQUEST AS $key => $value){
            $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
        }
        $input = file_get_contents("php://input");
        $array = print_r(json_decode($input, true), true);
        file_put_contents('log_webhook.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
        

    }


    public function Save()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'app_code'          => $this->input->get('app_code'),
            'base_url'          => $this->input->get('base_url'), 
            'tabel_user'        => $this->input->get('tabel_user'), 
            'key_tbl'           => $this->input->get('key_tbl'), 
            'field_password'    => $this->input->get('field_password'), 
            'driver'            => $this->input->get('driver'), 
            'encrypt_type'      => $this->input->get('encrypt_type'),            
        );


        $this->db->trans_begin();

        if($this->input->get('txtCode') != "") {

            $this->db->set($data);
            $this->db->where('app_code', $this->input->get('txtCode'));
            $result  =  $this->db->update('app_tbl');  

            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }else{

            $result  = $this->db->insert('app_tbl', $data);
            
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