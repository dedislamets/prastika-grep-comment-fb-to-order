<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){

            $data['title'] = 'Home';
            $data['main'] = 'dashboard/comment';
			$data['js'] = 'script/comment';

			if(!empty($this->input->get('id',true))){
				$config = $this->admin->get_array('tb_setting');

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  	CURLOPT_URL => 'https://graph.facebook.com/' . $this->input->get('id',true) . '?fields=full_picture,message,story,created_time&access_token=' . $config['token'],
				  	CURLOPT_RETURNTRANSFER => true,
				  	CURLOPT_ENCODING => '',
				  	CURLOPT_MAXREDIRS => 10,
				  	CURLOPT_TIMEOUT => 0,
				  	CURLOPT_FOLLOWLOCATION => true,
				  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  	CURLOPT_CUSTOMREQUEST => 'GET',
				));

				$response = curl_exec($curl);
				$response = json_decode($response, true);

				curl_close($curl);
				// print("<pre>".print_r($response,true)."</pre>");exit();

				$exist = $this->admin->get_array('postingan',array( 'id_posting' => $this->input->get('id', true)));
			    if(empty($exist)){
			    	$data = array(
				        'id_posting'  => $response['id'],
				        'content' => $response['message'],
				        'full_picture' => $response['full_picture'],
				        'format_order'  => '',
				        'status'		=> 'Aktif'
				        
				    );
			      	$result  = $this->db->insert('postingan', $data);
			      	
			    }
				
			}
			$this->load->view('dashboard',$data,FALSE); 

        }else{

            redirect("login");

        }				  			
	}

	public function rekap(){
	    $id= $this->input->get("id");
	    $data['data'] = $this->admin->get_result_array('rekapan',array( 'kode_book' => 'XYZ'));
	    foreach ($data['data'] as $key => $value) {
	        $routing = $this->admin->get_array('members',array( 'kode_member' => $value['kode_member']));
	        $data['data'][$key]['nama_lengkap'] = $routing['nama_lengkap'];
	        $data['data'][$key]['nama_facebook'] = $routing['nama_facebook'];
	        $data['data'][$key]['nomor_wa'] = $routing['nomor_wa'];
	        $data['data'][$key]['kota'] = $routing['kota'];
	    }
	    // print("<pre>".print_r($data,true)."</pre>");
	    $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function data(){
	    $id= $this->input->get("id", true);
	    $data = $this->admin->get_array('postingan',array( 'id_posting' => $id));
	    $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update(){
		$response['error']= true ;
		$jsonArray = json_decode(file_get_contents('php://input'),true); 
		$data = array(
	        'format_order'  => $jsonArray['format_order'],
	        'status'		=> $jsonArray['status']
	    );
		$this->db->set($data);
        $this->db->where('id_posting', $jsonArray['id']);
        $result  =  $this->db->update('postingan'); 
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
            $response['query'] = $jsonArray;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
	}
}
