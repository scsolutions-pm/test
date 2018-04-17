<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('page_model');
        $this->load->library('image_lib');
        $this->CheckLogin();

        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
       $this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
           $this->ckeditor->config['toolbar'] = array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
        );
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '450px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../assets/ckfinder/');
    }

    function index() {
        $data['pages'] = $this->getPage();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Good Music | Dashboard";

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('page/all_page', $data);
        $this->load->view('footer');
    }

    function getPage() {
        $TableName = "gm_page";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "page_id ASC";
        return $this->page_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function addEditPage() {
        $Id = $this->uri->segment(3);
        $data['page'] = "";
        if (!empty($Id)) {
            $data['page'] = $this->getPageDetails($Id);
        }
        $validationStatus = $this->pageValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'gm_page';
            $pageData = $this->pageArray($Id);
//            print_r($pageData);die();
            if (!empty($Id)) {
                $insertID = $this->page_model->UpdateRecord($TableName, $pageData, array('page_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('page');
            } else {
                $insertID = $this->page_model->InsertRecord($TableName, $pageData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('page');
            }
        }

        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/edit Music";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('page/edit_page', $data);
        } else {
            $this->load->view('page/add_page', $data);
        }
        $this->load->view('footer');
    }

    public function PageValidation($ID) {
        $this->form_validation->set_rules('page_title', 'Page Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('page_content', 'Page Content', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }

    public function getPageDetails($Id) {
        $TableName = 'gm_page';
        $Selectdata = '*';
        $WhereData = array('page_id' => $Id);
        $orderby = 'page_id desc';
        return $this->page_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function pageArray($Id) {
        unset($_POST['submit']);
        unset($_POST['pagefile']);
        $tempData = $_POST;
        //$tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        return $tempData;
    }

}

?>