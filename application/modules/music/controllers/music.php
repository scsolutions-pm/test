<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Music extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('music_model');
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->library('user_agent');
        // $this->load->library('excel');
        $this->load->library('Excel');
        $this->CheckLogin();
    }

    function index() {
        $data['music'] = $this->getMusic();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Good Music  | Dashboard";

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);

        $data['albums'] = $this->GetAlbums();
        $data['categories'] = $this->GetCategories();
        $data['tracktypes'] = $this->GetTracktypes();
        $data['interpreters'] = $this->GetInterpreters();

        $this->load->view('music/all_music', $data);
        $this->load->view('footer');
    }

    function getMusic() {
        $TableName = "gm_music";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "music_id ASC";
        return $this->music_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function addEditmusic() {
        $Id = $this->uri->segment(3);
        $data['music'] = "";
        if (!empty($Id)) {
            $data['music'] = $this->getMusicDetails($Id);
        }
        $data['albums'] = $this->GetAlbums();
        $data['categories'] = $this->GetCategories();
        $data['tracktypes'] = $this->GetTracktypes();
        $data['interpreters'] = $this->GetInterpreters();
        $validationStatus = $this->musicValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'gm_music';
            $musicData = $this->musicArray($Id);
           //  print_r($musicData);die();
            if (!empty($Id)) {
                $insertID = $this->music_model->UpdateRecord($TableName, $musicData, array('music_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('music');
            } else {
                $insertID = $this->music_model->InsertRecord($TableName, $musicData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('music/addEditmusic');
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/edit Music";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('music/edit_music', $data);
        } else {
            $this->load->view('music/add_music', $data);
        }
        $this->load->view('footer');
    }

    public function musicValidation($ID) {
        $this->form_validation->set_rules('track_name', 'track_name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('year', 'year', 'required|trim|xss_clean');
        $this->form_validation->set_rules('album_track_number', 'Album Track Number', 'required|numeric|trim|xss_clean');


        return $this->form_validation->run();
    }

    public function GetAlbums() {
        $TableName = 'gm_album';
        $Selectdata = 'album_id,album_name,album_description';
        $WhereData = array('album_status' => 1);
        $orderby = "album_id asc";
        return $this->music_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetCategories() {
        $TableName = 'gm_category';
        $Selectdata = 'category_id,category_name,category_description';
        $WhereData = array('category_status' => 1);
        $orderby = "category_id asc";
        return $this->music_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetTracktypes() {
        $TableName = 'gm_tracktype';
        $Selectdata = 'tracktype_id,tracktype_name as tracktype_name';
        $WhereData = array('tracktype_status' => 1);
        $orderby = "tracktype_id asc";
        return $this->music_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function GetInterpreters() {
        $TableName = 'gm_interpreter';
        $Selectdata = 'interpreter_id,interpreter_name,interpreter_description';
        $WhereData = array('interpreter_status' => 1);
        $orderby = "interpreter_id asc";
        return $this->music_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function getMusicDetails($Id) {
        $TableName = 'gm_music';
        $Selectdata = '*';
        $WhereData = array('music_id' => $Id);
        $orderby = 'music_id desc';
        return $this->music_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function musicArray($Id) {
        unset($_POST['submit']);
        unset($_POST['userfile']);
        $tempData = $_POST;
        $tempData['album_id'] = implode(",", $tempData['album_id']);
        $tempData['interpreter_id'] = implode(",", $tempData['interpreter_id']);
        $tempData['tracktype_id'] = implode(",", $tempData['tracktype_id']);
        $tempData['category_id'] = implode(",", $tempData['category_id']);

        // $tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        return $tempData;
    }

    public function music_image() {
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

// Upload music excel data in gm_mmusic Table function start here
//    public function upload_music_data_old() {
//
//        if (!empty($_FILES['file']['tmp_name'])) {
//          //  print_r($_POST);die;
//            $a_id = implode(",", $_POST['album_id']);
//            $i_id = implode(",", $_POST['interpreter_id']);
//            $t_id = implode(",", $_POST['tracktype_id']);
//            $c_id = implode(",", $_POST['category_id']);
////        echo $a_id . '<br>' . $i_id . '<br>' . $t_id . '<br>' . $c_id;   die;
//
//            $uploads_dir = './uploads/upload_excels';
//            $tmp_name = $_FILES["file"]["tmp_name"];
//            $temp = explode(".", $_FILES["file"]["name"]);
//            $tc_file = 'music_' . round(microtime(true)) . '.' . end($temp);
//            move_uploaded_file($tmp_name, "$uploads_dir/$tc_file");
//            $this->load->library("PHPExcel");
//            $objReader = PHPExcel_IOFactory::createReader('CSV');
//            $objReader->setReadDataOnly(true);
//            $objPHPExcel = $objReader->load("./uploads/upload_excels/" . $tc_file);
//            $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
//            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
//            // echo "<pre>";
//            // print_r($objWorksheet); die;
//            // echo $value = $objWorksheet->getCell( 'A2' )->getValue(); die;
//            for ($i = 2; $i <= $totalrows; $i++) {
//                echo $track_name = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
//
//                $album_id = $a_id;
//                $category_id = $c_id;
//                $interpreter_id = $i_id;
//                $tracktype_id = $t_id;
//
//                $isrc = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
//                $language = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
//                $publishing_company = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
//                $arranger = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
//                $producer = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
//                $interpreter = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue();
//                $dateInput = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
//                $year = date('Y-m-d', strtotime($dateInput));
//                $duration = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
//                $apple_itunes = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
//                $apple_music = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
//                $deezer = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
//                $amazon_music = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
//                $google_play_music = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
//                $Juke = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
//                $microsoft = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
//                $musicload = $objWorksheet->getCellByColumnAndRow(16, $i)->getValue();
//                $napster = $objWorksheet->getCellByColumnAndRow(17, $i)->getValue();
//                $qobuz = $objWorksheet->getCellByColumnAndRow(18, $i)->getValue();
//                $spotify = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();
//                $tidal = $objWorksheet->getCellByColumnAndRow(20, $i)->getValue();
//                $vimeo = $objWorksheet->getCellByColumnAndRow(21, $i)->getValue();
//                $youtube = $objWorksheet->getCellByColumnAndRow(22, $i)->getValue();
//                $amazon_books = $objWorksheet->getCellByColumnAndRow(23, $i)->getValue();
//                $apple_books = $objWorksheet->getCellByColumnAndRow(24, $i)->getValue();
//                $google_play_books = $objWorksheet->getCellByColumnAndRow(25, $i)->getValue();
//                $music_notes = $objWorksheet->getCellByColumnAndRow(26, $i)->getValue();
//                $notafina = $objWorksheet->getCellByColumnAndRow(27, $i)->getValue();
//                $note_download = $objWorksheet->getCellByColumnAndRow(28, $i)->getValue();
//                $sheet_music_plus = $objWorksheet->getCellByColumnAndRow(29, $i)->getValue();
//                $music_url = $objWorksheet->getCellByColumnAndRow(30, $i)->getValue();
//
//                if (empty($music_url)) {
//                    $music_url = 'http://f9portfolio.com/goodmusic/uploads/category_img/No-image-found.jpg';
//                }
////$url = 'http://www.google.co.in/intl/en_com/images/srpr/logo1w.png';
/////* Extract the filename */
////$filename = substr($url, strrpos($url, '/') + 1);
/////* Save file wherever you want */
////file_put_contents('upload/'.$filename, file_get_contents($url));
//
//                $music_image = basename($music_url);
//                /* Save file wherever you want */
//                file_put_contents('./uploads/category_img/' . $music_image, file_get_contents($music_url));
//
//                // if(!empty($state_id) && !empty($tc_master_id) && !empty($city_id) && !empty($project_id)) {
//                //      $num  = $this->music_model->get_data('gm_music',array('tc_master_id'=>$tc_master_id,'assessment_date'=>$dates,'project_id'=>$project_id))->num_rows();
//                //           if($num == '0'){
//                $tbl_name = 'gm_music';
//                $data = array(
//                    'track_name' => $track_name,
//                    'album_id' => $album_id,
//                    'category_id' => $category_id,
//                    'interpreter_id' => $interpreter_id,
//                    'tracktype_id' => $tracktype_id,
//                    'isrc' => $isrc,
//                    'language' => $language,
//                    'publishing_company' => $publishing_company,
//                    'arranger' => $arranger,
//                    'producer' => $producer,
//                    'interpreter' => $interpreter,
//                    'date' => $year,
//                    'duration' => $duration,
//                    'apple_itunes' => $apple_itunes,
//                    'apple_music' => $apple_music,
//                    'deezer' => $deezer,
//                    'amazon_music' => $amazon_music,
//                    'google_play_music' => $google_play_music,
//                    'Juke' => $Juke,
//                    'microsoft' => $microsoft,
//                    'musicload' => $musicload,
//                    'napster' => $napster,
//                    'qobuz' => $qobuz,
//                    'spotify' => $spotify,
//                    'tidal' => $tidal,
//                    'vimeo' => $vimeo,
//                    'youtube' => $youtube,
//                    'amazon_books' => $amazon_books,
//                    'apple_books' => $apple_books,
//                    'google_play_books' => $google_play_books,
//                    'music_notes' => $music_notes,
//                    'notafina' => $notafina,
//                    'note_download' => $note_download,
//                    'sheet_music_plus' => $sheet_music_plus,
//                    'music_image' => $music_image,
//                    'music_status' => 1,
//                );
//              //  print_r($data);
//                $insert = $this->music_model->insertCSV($tbl_name, $data);
////                echo $this->db->last_query();
////                die;
//            }
//            $this->SetSession(array('Success' => "Data are imported successfully.."), "flash");
//            redirect('music');
//        } else {
//            $this->SetSession(array('Error' => "Sorry File is not Imported.."), "flash");
//            redirect('music');
//        }
////        $this->session->set_flashdata('success', 'Sheet successfully Uploaded');
////        $this->session->set_flashdata('files', 'Sheet fail Uploaded');
//        redirect('music');
//    }


    public function upload_music_data() {
        if (!empty($_FILES['file']['tmp_name'])) {
            $album_id = implode(",", $_POST['album_id']);
            $interpreter_id = implode(",", $_POST['interpreter_id']);
            $tracktype_id = implode(",", $_POST['tracktype_id']);
            $category_id = implode(",", $_POST['category_id']);

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
//                        if ($val[31] != '') {
//                            $music_image = basename($val[31]);
//                            file_put_contents('./uploads/category_img/' . $music_image, file_get_contents($val[31]));
//                        } else {
//                            $music_image = "no_image.jpg";
//                        }

                        $insert_data = array(
//                            'cat_id' => $this->input->post('cat_id'),
//                            'insert_date' => date('Y-m-d H:i:s'),

                            'album_id' => $album_id,
                            'category_id' => $category_id,
                            'interpreter_id' => $interpreter_id,
                            'tracktype_id' => $tracktype_id,
                            
                            'track_name' => $val[0],
                            'arranger' => $val[1],
                            'producer' => $val[2],
                            'album_track_number' => $val[3],
                            
                            'year' => $val[4],
                            'isrc' => $val[5],
                            'language' => $val[6],
                            'publishing_company' => $val[7],
                            
                            'authors' => $val[8],
                            'duration' => $val[9],
                            'apple_itunes' => $val[10],
                            'apple_music' => $val[11],
                            'deezer' => $val[12],
                            'amazon_music' => $val[13],
                            'google_play_music' => $val[14],
                            'juke' => $val[15],
                            'microsoft' => $val[16],
                            'musicload' => $val[17],
                            'napster' => $val[18],
                            'qobuz' => $val[19],
                            'spotify' => $val[20],
                            'tidal' => $val[21],
                            'vimeo' => $val[22],
                            'youtube' => $val[23],
                            'amazon_books' => $val[24],
                            'apple_books' => $val[25],
                            'google_play_books' => $val[26],
                            'music_notes' => $val[27],
                            'notafina' => $val[28],
                            'note_download' => $val[29],
                            'sheet_music_plus' => $val[30],
                            //  'music_image' => $music_image,
                            'music_status' => 1,
                        );

                        //   print_r($insert_data);die;
                        $insert_id = $this->music_model->InsertRecord('gm_music', $insert_data);
                        $i++;
                    }
                    $this->SetSession(array('Success' => "Data are imported successfully.."), "flash");
                    redirect('music');
                }
            } else {
                //  $this->SetSession(array('Error' => lang('invalid_file')), "flash");
                $this->SetSession(array('Error' => "invalid file.."), "flash");
                redirect('music');
            }
        } else {
            //  $this->SetSession(array('Error' => lang('sorry_file_not_imported')), "flash");
            $this->SetSession(array('Error' => "sorry file is not imported.."), "flash");
            redirect('music');
        }
    }

}

?>