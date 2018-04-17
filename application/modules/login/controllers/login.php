<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends HT_Controller {

    private $connection;

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        // $this->load->model('welcome/welcome_model');		
    }

    function index() {
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $Data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
            $checkAdmin = $this->login_model->countrecords('gm_user', $Data);
           // echo $checkAdmin;die;
            if ($checkAdmin > 0) {
                $TableName = 'gm_user';
                $Selectdata = 'id AS user_id, email AS user_email, username, firstname, lastname';
                $orderby = 'id ASC';
                $adminData = $this->login_model->SelectSingleRecord($TableName, $Selectdata, $Data, $orderby);
                $this->session->set_userdata($adminData);
                $this->SetSession(array('Success' => "Welcome " . $adminData->firstname . " " . $adminData->lastname), "flash");
                redirect('admin');
            } else {
                $this->SetSession(array('Error' => "Invalid Username or Password"), "flash");
                redirect('login');
            }
        }
        $data['Error'] = $this->GetSession('Error', "flash");
        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Admin| login";
        $this->load->view('login', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function delete_entry() {
        $WhereData = $this->input->post('id');
        $TableName = $this->input->post('name');
        $column = "id";
        echo $this->login_model->DeleteRecord($TableName, $WhereData, $column);
    }

    // Signup function start here
    //   public function sign_up()
    // {
    //        $data['get_blogs'] = $this->welcome_model->get_all_blogs();
    // 	$this->load->view('header_front');
    //        $this->load->view('login_front');
    //        $this->load->view('footer_front',$data);
    // }
}

?>