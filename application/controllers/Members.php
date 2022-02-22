<?php
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout-2.7.2/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Members extends CI_Controller {
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

			$data['title'] = 'Members';
			$data['main'] = 'users/members';
			$data['js'] = 'script/members';
			$data['modal'] = 'modal/users';
      $data['group'] = $this->admin->getmaster('tb_group_role');
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
            0=>'id',
            1=>'email',
            2=>'nomor_wa',
            3=>'nama_lengkap',
            4=>'nama_facebook',
            5=>'kelurahan',
            6=>'kecamatan',
            7=>'kota',
            8=>'provinsi',
	          9 =>'kode_member'
        );
        $valid_sort = array(
            0=>'id',
            1=>'email',
            2=>'nomor_wa',
            3=>'nama_lengkap',
            4=>'nama_facebook',
            5=>'kelurahan',
            6=>'kecamatan',
            7=>'kota',
            8=>'provinsi',
	          9 =>'kode_member'
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
        $this->db->from("members");
        // $this->db->join('tb_group_role', 'tb_group_role.id = tb_user.id_role','left');
        $pengguna = $this->db->get();
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->id,
		    	$r->kode_member,
                        $r->email,
                        $r->nomor_wa,
                        $r->nama_lengkap,
                        $r->nama_facebook,
                        $r->kelurahan,
                        $r->kecamatan,
                        $r->kota,
                        $r->provinsi,
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
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
        $this->db->from("members");
        // $this->db->join('tb_group_role', 'tb_group_role.id = tb_user.id_role','left');
        $query = $this->db->get();
      	$result = $query->row();
      	if(isset($result)) return $result->num;
      	return 0;
    }

    public function dataTableModal()
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
          0=>'nama_user',
          1=>'email',
          
      );
      $valid_sort = array(
          0=>'nama_user',
          1=>'email',
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
      $this->db->select("tb_user.*");
      $this->db->from("tb_user");
      $this->db->where('id_atasan', NULL);

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      '<input type="checkbox" name="selected_courses[]" value="'.$r->id_user.'">',
                      $r->nama_user,
                      $r->email,
                 );
      }
      $total_pengguna = $this->totalPenggunaModal($search, $valid_columns, $this->input->get("id", TRUE));

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
    }

    public function totalPenggunaModal($search, $valid_columns,$id)
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
      $this->db->from("tb_user");
      $this->db->where('id_atasan', NULL);
     
      $query = $this->db->get();
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function export()
    {
      $this->db->from("members");
      
      $data = $this->db->get()->result();

      $writer = WriterFactory::create(Type::XLSX);

      $writer->openToBrowser("Data Members.xlsx");

      $sheet = $writer->getCurrentSheet();
      $sheet->setName('Rekap');

      $header = [
          'No',
          'KODE',
          'NAMA LENGKAP',
          "FACEBOOK",
          'NO WA',
          'Kelurahan',
          'Kecamatan',
          'Kota',
          'Provinsi',
          'Admin',
      ];
      $writer->addRow($header);

      $data_excel   = array(); 
      $no     = 1;

      foreach ($data as $key) {
          $anggota = array(
              $no++,
              $key->kode_member,
              $key->nama_lengkap,
              $key->nama_facebook,
              $key->nomor_wa,
              $key->kelurahan,
              $key->kecamatan,
              $key->kota,
              $key->provinsi,
              '',
          );

          array_push($data_excel, $anggota); 
      }

      $writer->addRows($data_excel);

      $writer->close(); 
    }

    public function export_lama()
    {

        $this->db->from("members");
        $this->db->limit(1000);
        
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
          ->setCellValue('B1', 'Kode Member')
          ->setCellValue('C1', 'Nomor WA')
          ->setCellValue('D1', 'Nama Lengkap')
          ->setCellValue('E1', 'Facebook')
          ->setCellValue('F1', 'Kelurahan')
          ->setCellValue('G1', 'Kecamatan')
          ->setCellValue('H1', 'Kota')
          ->setCellValue('I1', 'Provinsi');

        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        $spreadsheet->getActiveSheet()->setTitle('Members');

        $i=2; 
        foreach($data as $key=>$row) {

          $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $key+1)
            ->setCellValue('B'.$i, $row->kode_member)
            ->setCellValue('C'.$i, $row->nomor_wa)
            ->setCellValue('D'.$i, $row->nama_lengkap)
            ->setCellValue('E'.$i, $row->nama_facebook)
            ->setCellValue('F'.$i, $row->kelurahan)
            ->setCellValue('G'.$i, $row->kecamatan)
            ->setCellValue('H'.$i, $row->provinsi)
            ->setCellValue('I'.$i, $row->kota);

            $spreadsheet->getActiveSheet()->getStyle('A2:I'.$i)->applyFromArray($styleArray);
          $i++;
        }


        foreach (range('A','I') as $col) {
          $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
        }

       
        // exit();
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Member.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
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
}
