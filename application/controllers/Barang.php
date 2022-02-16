<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once APPPATH.'/third_party/spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
      // if(CheckMenuRole('barang')){
      //   redirect("barang");
      // }
			$data['title'] = 'Master Barang';
			$data['main'] = 'barang/index';
			$data['js'] = 'script/barang';
			$data['modal'] = 'modal/barang';
      // $data['jenis'] = $this->admin->getmaster('jenis_barang');

			$this->load->view('dashboard',$data,FALSE); 

    }else{
        redirect("login");

    }				  						
	}

  public function dataTable()
  {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $order = $this->input->get("order");
      $search= $this->input->get("search");
      $search = $search['value'];
      $col = 10;
      $dir = "";

      if(!empty($order))
      {
          foreach($order as $o)
          {
              $col = $o['column'];
              $dir= $o['dir'];
          }
      }

      if($dir != "asc" && $dir != "desc")
      {
          $dir = "desc";
      }

      $valid_columns = array(
          0=>'kode_barang',
          1=>'nama_barang',
          2=>'warna',
          3=>'spesifikasi',
          4=>'berat',
          5 => 'harga',
          6 => 'stok',
          7 => 'status'
      );
      $valid_sort = array(
          0=>'kode_barang',
          1=>'nama_barang',
          2=>'warna',
          3=>'spesifikasi',
          4=>'berat',
          5 => 'harga',
          6 => 'stok',
          7 => 'status'
      );
      if(!isset($valid_sort[$col]))
      {
          $order = null;
      }
      else
      {
          $order = $valid_sort[$col];
      }
      if($order !=null)
      {
          $this->db->order_by($order, $dir);
      }
      
      if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
      $this->db->limit($length,$start);
      $this->db->from("barang");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->kode_barang,
                      $r->nama_barang,
                      $r->warna,
                      $r->spesifikasi,
                      $r->stok,
                      $r->berat,
                      number_format($r->harga),
                      $r->status,
                      '<a href="'. base_url() .'barang/edit/'. $r->kode_barang .'" class="btn btn-warning btn-sm " >
                        <i class="icofont icofont-ui-edit"></i>Edit
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->kode_barang.'" >
                        <i class="icofont icofont-trash"></i>Hapus
                      </button> ',
                 );
      }
      $total_pengguna = $this->totalPengguna($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalPengguna($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
    if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
    $this->db->from("barang");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function edit($id)
  {   
    if($this->admin->logged_id())
      {
      $data['title'] = 'Edit Barang';
      $data['main'] = 'barang/create';
      $data['js'] = 'script/barang-create';
      $data['mode'] = 'Edit';

      $data['barang'] = $this->admin->get_array('barang',array( 'kode_barang' => $id));
      
      $this->load->view('dashboard',$data,FALSE); 

      }else{
          redirect("login");

      }                 
  }

  public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    
      $data = array(
          'kode_barang'   => $this->input->post('kode_barang'),
          'nama_barang'   => $this->input->post('nama_barang'),
          'warna'         => $this->input->post('warna'),
          'spesifikasi'   => $this->input->post('spesifikasi'),
          'stok'        => $this->input->post('stok'),
          'berat'       => $this->input->post('berat'),
          'harga'       => str_replace('.', '',  $this->input->post('harga',TRUE)),
          'status'      => $this->input->post('status'),
      );

      $this->db->trans_begin();

      if($this->input->post('mode') == "edit") {

          $this->db->set($data);
          $this->db->where('kode_barang', $this->input->post('old_code'));
          $result  =  $this->db->update('barang');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  

          $result  = $this->db->insert('barang', $data);
          
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }

      $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function update()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $data=[];
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";

    $data = array(
        'id_jenis'        => $this->input->post('id_jenis'),       
      );

    $this->db->set($data);
    $this->db->where(
      array( 
        "serial" => $this->input->post('serial') 
      ));
    $result = $this->db->update('barang');

    if(!$result){
      print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
      $response['error']= FALSE;
    }
  
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("kode_barang",$this->input->get('id'), 'barang' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

  public function create(){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Register Barang';
      $data['main'] = 'barang/create';
      $data['js'] = 'script/barang-create';
      $data['mode'] = "new";
      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }
  public function template()
  {

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
        ->setCellValue('A1', 'Kode')
        ->setCellValue('B1', 'Nama Barang')
        ->setCellValue('C1', 'Warna')
        ->setCellValue('D1', 'Berat')
        ->setCellValue('E1', 'Harga');

      $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

      $spreadsheet->getActiveSheet()->setTitle('Barang');

      foreach (range('A','E') as $col) {
        $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
      }

     
      // exit();
      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Template Upload Barang.xlsx"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

  public function upload(){
    
    array_map('unlink', array_filter(
            (array) array_merge(glob("./upload/*"))));
  
    $fileName = $_FILES['file']['name'];

    $config['remove_spaces'] = FALSE;
    $config['upload_path'] = './upload/'; //path upload
    $config['file_name'] = $fileName;  // nama file
    $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
    $config['max_size'] = 10000; // maksimal sizze


    $this->load->library('upload'); //meload librari upload
    $this->upload->overwrite = true;
    $this->upload->initialize($config);
      
    if(! $this->upload->do_upload('file') ){
        echo $this->upload->display_errors();exit();
    }
            
    $inputFileName = './upload/'.$fileName;

    
    $reader = ReaderFactory::create(Type::XLSX); //set Type file xlsx
    $reader->open($inputFileName); //open the file           

    echo "<pre>";           
    $i = 0; 

    foreach ($reader->getSheetIterator() as $sheet) {             
        foreach ($sheet->getRowIterator() as $rowData) {
          if($i>0){
            $data = array(
                "kode_barang"=> $rowData[0],
                "nama_barang"=> $rowData[1],
                "warna"=> $rowData[2],
                "berat"=> $rowData[3],
                "harga"=> $rowData[4],
            );

            $exist = $this->admin->get_array('barang',array( 'kode_barang' => $rowData[0]));
            if(empty($exist)){
              $insert = $this->db->insert("barang",$data);
              print_r($rowData);
            }elseif ($rowData[0] == trim($rowData[0]) && strpos($rowData[0], ' ') !== false) {
              print_r($rowData[0] . " tidak boleh mengadung spasi.<br>");
            }else{
              print_r($rowData[0] . " tidak boleh duplicate.<br>");
            }
            
             
          }
          ++$i;
        }
    }

    echo "<br> Total Rows : ".$i." <br>";               
    $reader->close();
                   

    echo "Peak memory:", (memory_get_peak_usage(true) / 1024 / 1024), " MB" ,"<br>";
  }

}
