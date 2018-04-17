<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library('image_lib');
        $this->CheckLogin();
    }

    function index() {
        $data['categories'] = $this->getCategory();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Good Music | Dashboard";

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('category/all_category', $data);
        $this->load->view('footer');
    }

    function getCategory() {
        $TableName = "gm_category";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "category_id ASC";
        return $this->category_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function addEditCategory() {
        $Id = $this->uri->segment(3);
        $data['category'] = "";
        if (!empty($Id)) {
            $data['category'] = $this->getCategoryDetails($Id);
        }
        $validationStatus = $this->CategoryValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'gm_category';
            $CategoryData = $this->CategoryArray($Id);
            // print_r($CategoryData);die();
            if (!empty($Id)) {
                $insertID = $this->category_model->UpdateRecord($TableName, $CategoryData, array('category_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('category');
            } else {
                $insertID = $this->category_model->InsertRecord($TableName, $CategoryData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('category/addEditCategory');
            }
        }

        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/edit Category";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('category/edit_category', $data);
        } else {
            $this->load->view('category/add_category', $data);
        }
        $this->load->view('footer');
    }

    public function CategoryValidation($ID) {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('category_description', 'Category Description', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }

    public function getCategoryDetails($Id) {
        $TableName = 'gm_category';
        $Selectdata = '*';
        $WhereData = array('category_id' => $Id);
        $orderby = 'category_id desc';
        return $this->category_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function CategoryArray($Id) {
        unset($_POST['submit']);
        unset($_POST['categoryfile']);
        $tempData = $_POST;
        // $tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        return $tempData;
    }

    public function Category_image() {
        $status = "";
        $msg = "";
        $file_element_name = 'Categoryfile';
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these types
            'max_size' => 2048, //2MB max
            'upload_path' => './uploads/Category_img/', //upload directory
            'overwrite' => TRUE,
            'file_name' => time(),
        );

        $this->load->library('upload', $config);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library('upload', $config);
        $tmpName = $_FILES['Categoryfile']['tmp_name'];
        if ($this->upload->do_upload($file_element_name)) {
            $image_data = $this->upload->data();
            $status = "Picture saved";
            $msg = $image_data['file_name'];
            echo json_encode(array('category_status' => $status, 'msg' => $msg));
        } else {
            $status = 'Error';
            $msg = "Maximum upload limit is 2MB";
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }

}

?>