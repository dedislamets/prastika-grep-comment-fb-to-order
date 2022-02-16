<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
			$config = $this->admin->get_array('tb_setting');
			$data['config'] = $config;

			if(!empty($this->input->get('id',true))){

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  	CURLOPT_URL => 'https://graph.facebook.com/' . $this->input->get('id',true) . '?access_token=' . $config['token'],
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
				        'content' => $response['title'],
				        'full_picture' => $response['embed_html'],
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
	    $data['data'] = $this->admin->get_result_array('rekapan',array( 'id_posting' => $id));
	    $qty=0;
	    foreach ($data['data'] as $key => $value) {
	        $routing = $this->admin->get_array('members',array( 'id' => $value['id_member']));
	        $barang = $this->admin->get_array('barang',array( 'kode_barang' => $value['kode_product']));
	        $data['data'][$key]['nama_lengkap'] = $routing['nama_lengkap'];
	        $data['data'][$key]['nama_facebook'] = $routing['nama_facebook'];
	        $data['data'][$key]['nomor_wa'] = $routing['nomor_wa'];
	        $data['data'][$key]['kota'] = $routing['kota'];
	        $data['data'][$key]['id_member'] = $routing['id'];
	        $data['data'][$key]['nama_barang'] = $barang['nama_barang'];

	        $qty +=(int)$value['qty'];
	    }
	    $data['total_qty'] = $qty;
	    $data['total_rekap'] = $this->db->query("select count(*) as total from rekapan where id_posting='". $id ."'")->row_array();;

	    // print("<pre>".print_r($data,true)."</pre>");
	    $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function data(){
	    $id= $this->input->get("id", true);
	    $data = $this->admin->get_array('postingan',array( 'id_posting' => $id));
	    $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function wa(){
	    $no= $this->input->post("nomor", true);
	    $msg= $this->input->post("msg", true);
	    $data = $this->admin->kirim_wa($no,$msg);
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

	public function export()
  	{

        $id = $this->input->get('id',TRUE);

        $this->db->select("order_date,id_member, nama_lengkap,nomor_wa,kode_comment, pesan");
        $this->db->from("rekapan a");
        $this->db->join('members b', 'a.id_member=b.id');
        $this->db->where("a.id_member>0");
        $this->db->where("id_posting", $id);
        $this->db->order_by("order_date", 'ASC');
        
        $data = $this->db->get()->result();

        $spreadsheet = new Spreadsheet;

        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A1', 'NO')
          ->setCellValue('B1', 'Tanggal Rekap')
          ->setCellValue('C1', 'ID Member')
          ->setCellValue('D1', 'Nama Member')
          ->setCellValue('E1', 'Nomor WA')
          ->setCellValue('F1', 'Comment')
          ->setCellValue('G1', 'Pesan');

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        $spreadsheet->getActiveSheet()->setTitle('Rekapan');

        $i=2; 
        foreach($data as $key=>$row) {

          $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $key+1)
            ->setCellValue('B'.$i, $row->order_date)
            ->setCellValue('C'.$i, $row->id_member)
            ->setCellValue('D'.$i, $row->nama_lengkap)
            ->setCellValue('E'.$i, $row->nomor_wa)
            ->setCellValue('F'.$i, $row->kode_comment)
            ->setCellValue('G'.$i, $row->pesan);

            $spreadsheet->getActiveSheet()->getStyle('A2:G'.$i)->applyFromArray($styleArray);
          $i++;
        }


        foreach (range('A','G') as $col) {
          $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
        }

       
        // exit();
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Rekapan '. $id .'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
  	}
}
