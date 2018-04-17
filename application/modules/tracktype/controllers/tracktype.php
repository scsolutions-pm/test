<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tracktype extends HT_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('Tracktype_model');
        $this->load->library('image_lib');
        $this->CheckLogin();
    }

    function index() 
    {
        $data['tracktypes']   = $this->getTracktype();
        $data['Error']   = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title']   = "Good Music | Dashboard";
        
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('tracktype/all_tracktype', $data);
        $this->load->view('footer');
    }

    function getTracktype()
    {
        $TableName  = "gm_tracktype";
        $Selectdata = "*";
        $WhereData  = array();
        $orderby    = "tracktype_id ASC";
        return $this->Tracktype_model->SelectRecord($TableName,$Selectdata,$WhereData,$orderby);
    }

    function addEditTracktype()
    {
         $Id = $this->uri->segment(3);
         $data['tracktype'] = "";
        if (!empty($Id)) 
        {
            $data['tracktype'] = $this->getTracktypeDetails($Id);
        }
        $validationStatus = $this->TracktypeValidation($Id);
        if ($validationStatus == TRUE) 
        {
            $TableName = 'gm_tracktype';
            $TracktypeData  = $this->TracktypeArray($Id);
            // print_r($TracktypeData);die();
            if (!empty($Id)) 
            {
                $insertID = $this->Tracktype_model->UpdateRecord($TableName, $TracktypeData, array('tracktype_id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('tracktype');
            } 
            else 
            {
                $insertID = $this->Tracktype_model->InsertRecord($TableName, $TracktypeData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('tracktype/addEditTracktype');
            }
        }
        
        $data['Error']   = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title']   = "Add/edit Track Type";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) 
        {
            $this->load->view('tracktype/edit_tracktype', $data);
        } 
        else 
        {
            $this->load->view('tracktype/add_tracktype', $data);
        }
        $this->load->view('footer');
    }

    public function TracktypeValidation($ID) 
    {
        $this->form_validation->set_rules('tracktype_name', 'Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('tracktype_description', 'Description', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }
    
   
    public function getTracktypeDetails($Id) 
    {
        $TableName  = 'gm_tracktype';
        $Selectdata = '*';
        $WhereData  = array('tracktype_id' => $Id);
        $orderby    = 'tracktype_id desc';
        return $this->Tracktype_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function TracktypeArray($Id) 
    {
        unset($_POST['submit']);
        unset($_POST['Tracktypefile']);
        $tempData = $_POST;
       // $tempData['created_date'] = date('Y-m-d H:i:s');
        // print_r($tempData);die();
        return $tempData;
    }

    public function Tracktype_image() 
    {
        $status            = "";
        $msg               = "";
        $file_element_name = 'Tracktypefile';
        $config            = array(
            'allowed_types' => 'jpg|jpeg|gif|png', //only accept these types
            'max_size'      => 2048, //2MB max
            'upload_path'   => './uploads/Tracktype_img/', //upload directory
            'overwrite'     => TRUE,
            'file_name'     => time(),
        ); 

        $this->load->library('upload', $config);
        if (!is_dir($config['upload_path'])) 
        {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library('upload', $config);
        $tmpName = $_FILES['Tracktypefile']['tmp_name'];
        if ($this->upload->do_upload($file_element_name)) 
        {
            $image_data = $this->upload->data();
            $status     = "Picture saved";
            $msg        = $image_data['file_name'];
            echo json_encode(array('status' => $status, 'msg' => $msg));
        } 
        else 
        {
            $status = 'Error';
            $msg    = "Maximum upload limit is 2MB";
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }
}

?>