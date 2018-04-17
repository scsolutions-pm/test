<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('image_lib');
       $this->load->library('Excel');
       //$this->load->library('excel');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->CheckLogin();
    }

    public function langSetting($type) {
        if (!empty($type)) {
            if ($type == "de") {
                $this->session->unset_userdata('d_language');
                $this->session->set_userdata('d_language', 'de,german');
            } else {
                $this->session->set_userdata('d_language', 'en,english');
            }
        }
        redirect($this->agent->referrer());
    }

    function index() {
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Online Music | Dashboard";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('footer');
    }

    function settings() {
        $data['settings'] = $this->getsettings();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Settings  | Dashboard";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('footer');
    }

    function getsettings() {
        $TableName = "settings";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "id ASC";
        return $this->admin_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function editSettings() {
        $Id = $this->uri->segment(3);
        $data['setting'] = "";
        // $data['allcategory'] = $this->getAllcategories();
        if (!empty($Id)) {
            $data['setting'] = $this->getSettingsDetails($Id);
        }
        $validationStatus = $this->settingValidation($Id);
        if ($validationStatus == TRUE) {
            $TableName = 'settings';
            $settingData = $this->settingsArray($Id);
            if (!empty($Id)) {
                $insertID = $this->admin_model->UpdateRecord($TableName, $settingData, array('id' => $Id));
                $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
                redirect('admin/settings');
            } else {
                $insertID = $this->admin_model->InsertRecord($TableName, $settingData);
                $this->SetSession(array('Success' => "Record Successfully inserted"), "flash");
                redirect('admin/settings');
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Add/edit Settings";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        if (!empty($Id)) {
            $this->load->view('admin/editSettings', $data);
        } else {
            $this->load->view('subcategory/addSubcategory', $data);
        }
        $this->load->view('footer');
    }

    public function getSettingsDetails($Id) {
        $TableName = 'settings';
        $Selectdata = '*';
        $WhereData = array('id' => $Id);
        $orderby = 'id desc';
        return $this->admin_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function settingValidation($ID) {
        $this->form_validation->set_rules('value', 'Value', 'required|trim|xss_clean');
        return $this->form_validation->run();
    }

    public function settingsArray($Id) {
        unset($_POST['submit']);
        $tempData = $_POST;
        // $tempData['created'] = date('Y-m-d H:i:s');
        return $tempData;
    }

//admin controller code
    // view admin profile 09052017 
    public function adminprofile() {
        $data['user'] = $this->getAdmindata();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Admin profile";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/adminprofile', $data);
        $this->load->view('footer');
    }

    // Get admin Profile
    public function getAdmindata() {
        $TableName = "gm_user";
        $Selectdata = "*";
        $WhereData = array('id' => $this->user_id);
        $orderby = "id DESC";
        return $this->admin_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    // adit admin profile
    public function editAdminProfile() {
        // $this->checkEmployee();
        $ValidationStatus = $this->adminProfileValidation($this->user_id);
        if ($ValidationStatus == TRUE) {
            $TableName = 'gm_user';
            $UserData = $this->DataArray($this->user_id);
            // print_r($UserData);die();
            $Result = $this->admin_model->UpdateRecord($TableName, $UserData, array('id' => $this->user_id));
            $this->SetSession(array('Success' => "Record Successfully Update"), "flash");
            if (!empty($Result)) {
                redirect('admin/adminprofile');
            } else {
                $this->SetSession(array('Error' => "Record not insert due to some technical problem"), "flash");
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Admin profile";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/adminprofile', $data);
        $this->load->view('footer');
    }

// admin profile validation
    public function adminProfileValidation($ID) {
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        return $this->form_validation->run();
    }

    // input post array
    public function DataArray($ID) {
        unset($_POST['submit']);
        unset($_POST['userfile1']);
        $UserData = $_POST;
        return $UserData;
    }

    // change admin password
    public function changePwd() {
        // $this->checkEmployee();
        $data['user'] = $this->getAdmindata();
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Change Password";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/changepwd', $data);
        $this->load->view('footer');
    }

    // Start Change password code
    public function editSettingaccount() {
        // $this->checkEmployee();
        $SettingStatus = $this->SettingAccountValidation();
        if ($SettingStatus == TRUE) {
            $TableName = 'gm_user';
            $UserData['password'] = md5($this->input->post('npassword'));
            $Result = $this->admin_model->UpdateRecord($TableName, $UserData, array('id' => $this->user_id));
            $this->SetSession(array('Success' => "Password Successfully Update"), "flash");
            if (!empty($Result)) {
                redirect('admin/editSettingaccount');
            } else {
                $this->SetSession(array('Error' => "Setting not updated due to some technical problem"), "flash");
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Change password";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/changepwd', $data);
        $this->load->view('footer');
    }

// account setting validations
    public function SettingAccountValidation() {
        $this->form_validation->set_rules('opassword', 'old Password', 'trim|required|callback_check_oldpass');
        $this->form_validation->set_message('check_oldpass', 'Current password is incorrect');
        $this->form_validation->set_rules('npassword', 'New Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[npassword]');
        $this->form_validation->set_message('matches', 'Password not match');
        return $this->form_validation->run();
    }

// check old password
    public function check_oldpass() {
        $TableName = 'gm_user';
        $WhereData = array('id' => $this->user_id, 'password' => md5($this->input->post('opassword')));
        $Results = $this->admin_model->countrecords($TableName, $WhereData);
        if ($Results > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function import() {
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Import Music | Dashboard";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/import', $data);
        $this->load->view('footer');
    }

// Dashboard import excel data inserted in the database function start here
    // table name : gm_category, gm_album, gm_interpreter and gm_tracktype
    public function import_data() {

        if (isset($_POST["table_name"])) {
            $filename = $_FILES["file"]["tmp_name"];
            // echo $_FILES["file"]["size"];die;
            if ($_FILES["file"]["size"] > 0) {
            // if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $tbl_name = 'gm_' . $_POST['table_name'];
                $clm_name = $_POST['table_name'];
                $file = fopen($filename, "r");
                while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
                    // print_r($importdata); die;
                  $c1 =  htmlentities($importdata[0]);
                   $c2 =  htmlentities($importdata[1]);
                    $data = array(
                        $clm_name . '_name' =>  $c1,
                        $clm_name . '_description  ' => $c2,
                        $clm_name . '_status' => 1,
                    );
                    $insert = $this->admin_model->insertCSV($tbl_name, $data);
                }
                fclose($file);
                $this->SetSession(array('Success' => "Data are imported successfully.."), "flash");
                redirect('admin/import');
            } else {
                //  echo "fail"; die;
                $this->SetSession(array('Error' => "Something went wrong.."), "flash");
                redirect('admin/import');
            }
        }
    }

    // End here import excel data function

    function popup() {
        $data['title'] = "Music Online | Dashboard";
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['music'] = $this->getMusicDetails();
        $data['popup_id'] = $this->getPopUp(1);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/popup', $data);
        $this->load->view('footer');
    }

    public function update_popup() {
        $data['music'] = $this->getMusicDetails();
        $data['popup_id'] = $this->getPopUp(1);

        $TableName = 'gm_popup';
        $popupId = $this->input->post('track_id');
        $Result = $this->admin_model->UpdateRecord($TableName, array('track_id' => $popupId), array('popup_id' => 1));
        if (!empty($Result)) {
            $this->SetSession(array('Success' => "Successfully Updated"), "flash");
            redirect('admin/popup');
        } else {
            $this->SetSession(array('Error' => "Sorry there is some technical problem"), "flash");
        }

        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Change Popup";
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('admin/popup', $data);
        $this->load->view('footer');
    }

    public function getPopUp($Id) {
        $TableName = 'gm_popup';
        $Selectdata = 'track_id';
        $WhereData = array('popup_id' => $Id);
        $orderby = 'popup_id desc';
        return $this->admin_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function getMusicDetails() {
        $TableName = 'gm_album';
        $Selectdata = 'album_id,album_name';
        $WhereData = array('album_status' => 1);
        $orderby = "album_id asc";
        return $this->admin_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }
   
}
