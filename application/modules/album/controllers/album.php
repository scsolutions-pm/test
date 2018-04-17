<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Album extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Album_model');
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('user_agent');
        // $this->load->library('excel');
        $this->load->library('Excel');
        $this->CheckLogin();
    }

    function index() {
        $data['albums'] = $this->getAlbum();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Good Music | Dashboard";

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('album/all_album', $data);
        $this->load->view('footer');
    }

    function getAlbum() {
        $TableName = "gm_album";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "album_id ASC";
        return $this->Album_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function addEditAlbum() {
        $Id = $this->uri->segment(3);
        $data['album'] = "";
        if (!empty($Id)) {
            $data['album'] = $this->getAlbumDetails($Id);
        }
        $data['albums'] = $this->GetAlbums();
        $data['categories'] = $this->GetCategories();
        $data['tracktypes'] = $this->GetTracktypes();
        $data['interpreters'] = $this->GetInterpreters();

        $validationStatus = $this->albumValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'gm_album';
            $AlbumData = $this->albumArray($Id);
            // print_r($albumArray);die();
            if (!empty($Id)) {
                $insertID = $this->Album_model->UpdateRecord($TableName, $AlbumData, array('album_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('album');
            } else {
                $insertID = $this->Album_model->InsertRecord($TableName, $AlbumData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('album/addEditAlbum');
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/Edit Album";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('album/edit_album', $data);
        } else {
            $this->load->view('album/add_album', $data);
        }
        $this->load->view('footer');
    }

    public function albumValidation($ID) {
        $this->form_validation->set_rules('album_name', 'album_name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('album_description', 'album_description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('album_interpret', 'album_interpret', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }

    public function getAlbumDetails($Id) {
        $TableName = 'gm_album';
        $Selectdata = '*';
        $WhereData = array('album_id' => $Id);
        $orderby = 'album_id desc';
        return $this->Album_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function albumArray($Id) {
        $_POST['album_image'] = $_POST['userfile'];
        unset($_POST['submit']);
        unset($_POST['userfile']);
        $tempData = $_POST;
        // $tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        //$tempData['album_id'] = implode(",", $tempData['album_id']);
        $tempData['album_interpret'] = implode(",", $tempData['album_interpret']);
        //$tempData['tracktype_id'] = implode(",", $tempData['tracktype_id']);
        $tempData['album_kategorien'] = implode(",", $tempData['album_kategorien']);
        return $tempData;
    }

    public function GetAlbums() {
        $TableName = 'gm_album';
        $Selectdata = 'album_id,album_name as album_name';
        $WhereData = array('album_status' => 1);
        $orderby = "album_id asc";
        return $this->Album_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetCategories() {
        $TableName = 'gm_category';
        $Selectdata = 'category_id,category_name as category_name';
        $WhereData = array('category_status' => 1);
        $orderby = "category_id asc";
        return $this->Album_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetTracktypes() {
        $TableName = 'gm_tracktype';
        $Selectdata = 'tracktype_id,tracktype_name as tracktype_name';
        $WhereData = array('tracktype_status' => 1);
        $orderby = "tracktype_id asc";
        return $this->Album_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetInterpreters() {
        $TableName = 'gm_interpreter';
        $Selectdata = 'interpreter_id,interpreter_name as interpreter_name';
        $WhereData = array('interpreter_status' => 1);
        $orderby = "interpreter_id asc";
        return $this->Album_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function album_image() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these types
            'max_size' => 2048, //2MB max
            'upload_path' => './uploads/category_img/', //upload directory
            'overwrite' => TRUE,
            'file_name' => time(),
        );
        $this->load->library('upload', $config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library('upload', $config);
        $tmpName = $_FILES['userfile']['tmp_name'];

        if ($this->upload->do_upload($file_element_name)) {
            $image_data = $this->upload->data();
            $status = "Picture saved";
            $msg = $image_data['file_name'];
            echo json_encode(array('status' => $status, 'msg' => $msg));
        } else {
            $status = 'Error';
            $msg = "Maximum upload limit is 2MB";
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }

    
      public function upload_album_data() {
        if (!empty($_FILES['file']['tmp_name'])) {
//            $album_id = implode(",", $_POST['album_id']);
//            $interpreter_id = implode(",", $_POST['interpreter_id']);
//            $tracktype_id = implode(",", $_POST['tracktype_id']);
//            $category_id = implode(",", $_POST['category_id']);

            $file_name = explode('.', $_FILES['file']['name']);
            if (end($file_name) == 'xlsx') {

                $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow(); // e.g. 10  
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    $nrColumns = ord($highestColumn) - 64;

                    $ErrorArray = [];

                    $i = 1;
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $val = array();
                        for ($col = 0; $col < $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val[] = $cell->getValue();
                        }
                        if ($val[15] != '') {
                            $album_image = basename($val[15]);
                            file_put_contents('./uploads/category_img/' . $album_image, file_get_contents($val[15]));
                        } else {
                            $album_image = "No-image-found.jpg";
                        }

                        $insert_data = array(
//                            'cat_id' => $this->input->post('cat_id'),
//                            'insert_date' => date('Y-m-d H:i:s'),
                            
                            'album_name' => $val[0],
                            'album_description' => $val[1],
                            'album_interpret' => $val[2],
                            'album_kategorien' => $val[3],
                            
                            'album_EAN' => $val[4],
                            'amazon_music_album' => $val[5],
                            'apple_itunes_album' => $val[6],
                            'apple_music_album' => $val[7],
                            
                            'deezer_album' => $val[8],
                            'google_play_music_album' => $val[9],
                            'juke_album' => $val[10],
                            'microsoft_album' => $val[11],
                            
                            'musicload_album' => $val[12],
                            'napster_album' => $val[13],
                            'qobuz_album' => $val[14],
                            'spotify_album' => $val[15],
                            'tidal_album' => $val[16],
                            'label' => $val[17],
                            'label_code' => $val[18],
                             'album_image' => $album_image,
                            'album_status' => 1,
                        );

                        //   print_r($insert_data);die;
                        $insert_id = $this->Album_model->InsertRecord('gm_album', $insert_data);
                        $i++;
                    }
                    $this->SetSession(array('Success' => "Data are imported successfully.."), "flash");
                    redirect('album');
                }
            } else {
                //  $this->SetSession(array('Error' => lang('invalid_file')), "flash");
                $this->SetSession(array('Error' => "invalid file.."), "flash");
                redirect('album');
            }
        } else {
            //  $this->SetSession(array('Error' => lang('sorry_file_not_imported')), "flash");
            $this->SetSession(array('Error' => "sorry file is not imported.."), "flash");
            redirect('album');
        }
    }
}

?>