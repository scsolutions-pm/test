<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Interpreter extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('interpreter_model');
        $this->load->library('image_lib');
        $this->CheckLogin();
    }

    function index() {
        $data['interpreter'] = $this->getInterpreter();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Good Music  | Dashboard";

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('interpreter/all_interpreter', $data);
        $this->load->view('footer');
    }

    function getInterpreter() {
        $TableName = "gm_interpreter";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "interpreter_id ASC";
        return $this->interpreter_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function addEditinterpreter() {
        $Id = $this->uri->segment(3);
        $data['interpreter'] = "";
        if (!empty($Id)) {
            $data['interpreter'] = $this->getInterpreterDetails($Id);
        }
        $validationStatus = $this->interpreterValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'gm_interpreter';
            $interpreterData = $this->interpreterArray($Id);
            // print_r($interpreterData);die();
            if (!empty($Id)) {
                $insertID = $this->interpreter_model->UpdateRecord($TableName, $interpreterData, array('interpreter_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('interpreter');
            } else {
                $insertID = $this->interpreter_model->InsertRecord($TableName, $interpreterData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('interpreter/addEditinterpreter');
            }
        }

        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/edit Interpreter";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('interpreter/edit_interpreter', $data);
        } else {
            $this->load->view('interpreter/add_interpreter', $data);
        }
        $this->load->view('footer');
    }

    public function interpreterValidation($ID) {
        $this->form_validation->set_rules('interpreter_name', 'Interpreter Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('interpreter_description', 'Interpreter Description', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }

    public function getinterpreterDetails($Id) {
        $TableName = 'gm_interpreter';
        $Selectdata = '*';
        $WhereData = array('interpreter_id' => $Id);
        $orderby = 'interpreter_id desc';
        return $this->interpreter_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function interpreterArray($Id) {
        unset($_POST['submit']);
        unset($_POST['interpreterfile']);
        $tempData = $_POST;
        // $tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        return $tempData;
    }

    public function interpreter_image() {
        $status = "";
        $msg = "";
        $file_element_name = 'interpreterfile';
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these types
            'max_size' => 2048, //2MB max
            'upload_path' => './uploads/interpreter_img/', //upload directory
            'overwrite' => TRUE,
            'file_name' => time(),
        );

        $this->load->library('upload', $config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library('upload', $config);
        $tmpName = $_FILES['interpreterfile']['tmp_name'];
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

}

?>