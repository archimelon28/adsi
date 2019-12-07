<?php
/**
 * @package Phpspreadsheet :  Phpspreadsheet
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Phpspreadsheet Controller
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');
//PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
class C_Matkul extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('M_Matkul', 'M_Matkul');
    }
    // index
    public function import()
    {
        $data = array();    
        $data['title'] = 'Import Excel Sheet | TechArise';
        // $data['breadcrumbs'] = array('Home' => '#');
        $this->load->view('form/index', $data);
    }
 
    // file upload functionality
    public function upload() {
        $data = array();
        $data['title'] = 'Import Excel Sheet | TechArise';
        $data['breadcrumbs'] = array('Home' => '#');
         // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
         if($this->form_validation->run() == false) {
            
            $this->load->view('form/index', $data);
         } else {
            // If file uploaded
            if(!empty($_FILES['fileURL']['name'])) { 
                // get file extension
                $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
                // array Count
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                $createArray = array('id_matkul','nama_matkul');
                $makeArray = array('id_matkul' => 'id_matkul','nama_matkul' => 'nama_matkul');
                $SheetDataKey = array();
                foreach ($allDataInSheet as $dataInSheet) {
                    foreach ($dataInSheet as $key => $value) {
                        if (in_array(trim($value), $createArray)) {
                            $value = preg_replace('/\s+/', '', $value);
                            $SheetDataKey[trim($value)] = $key;
                        } 
                    }
                }
                $dataDiff = array_diff_key($makeArray, $SheetDataKey);
                if (empty($dataDiff)) {
                    $flag = 1;
                }
                // match excel sheet column
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $addresses = array();
                        $id_matkul = $SheetDataKey['id_matkul'];
                        $nama_matkul = $SheetDataKey['nama_matkul'];
                        
                        $id_matkul = filter_var(trim($allDataInSheet[$i][$id_matkul]), FILTER_SANITIZE_STRING);
                        $nama_matkul = filter_var(trim($allDataInSheet[$i][$nama_matkul]), FILTER_SANITIZE_STRING);
                        $fetchData[] = array('id_matkul' =>  $id_matkul,'nama_matkul' => $nama_matkul);
                    }   
                    $data['dataInfo'] = $fetchData;
                    $this->M_Matkul->setBatchImport($fetchData);
                    $this->M_Matkul->importData();
                } else {
                    echo "Please import correct file, did not match excel sheet column";
                }
                $this->load->view('spreadsheet/display', $data);
            }              
        }
    }
 
    // checkFileValidation
    public function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
        'text/comma-separated-values', 
        'application/octet-stream', 
        'application/vnd.ms-excel', 
        'application/x-csv', 
        'text/x-csv', 
        'text/csv', 
        'application/csv', 
        'application/excel', 
        'application/vnd.msexcel', 
        'text/plain', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }
 
}
 
?>