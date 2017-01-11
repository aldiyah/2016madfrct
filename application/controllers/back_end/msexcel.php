<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Msexcel extends Back_end {
    
    public $model = 'model_master_kotama';
    
    function __construct(){
        parent::__construct('kelola_pustaka_kotama', 'Pustaka Kotama');
        //$this->load->library(array('excel','excel/IOFactory'));
        $this->load->library(array('excel'));
    }
    public function index()
    {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = 'uploads/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = 'uploads/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "id_upload"=> $rowData[0][0],
                    "nama_file"=> $rowData[0][1],
                    "ukuran"=> $rowData[0][2]
                    
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("transaksi_upload",$data);
                delete_files($media['file_path']);
                     
            }
        redirect('msexcel/');
    }
}
