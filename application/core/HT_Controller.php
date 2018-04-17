<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class HT_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('language');
        
        $this->name = $this->session->userdata('firstname') . " " . $this->session->userdata('lastname');
        $this->username = $this->session->userdata('username');
        $this->email = $this->session->userdata('email');
        $this->id = $this->session->userdata('admin_id');
        $this->role_id = $this->session->userdata('role_id');
        $this->user_email = $this->session->userdata('user_email');
        $this->user_id = $this->session->userdata('user_id');
        $this->user_name = $this->session->userdata('user_firstname') . " " . $this->session->userdata('user_lastname');
          
        $d_language = $this->session->userdata('d_language');
//           echo $d_language;die;
        if (empty($d_language)) {
            $this->lang->load('en', 'english');
            $this->config->set_item('language', 'english');
        } else {
            $lang_1 = explode(',', $d_language);
            $this->lang->load($lang_1[0], $lang_1[1]);
            $this->config->set_item('language', $lang_1[1]);
        }
    }

    function CheckLogin() {
        if (empty($this->user_id)) {
            redirect('login/logout');
        }
    }

    // function Checkuserlogin_home()
    // {
    // 	if(empty($this->user_id))
    // 	{
    // 		redirect('home');
    // 	}
    // }

    function CheckuserLogin() {
        if (empty($this->user_id)) {
            $this->SetSession(array('Error' => "You must login to access this page"), "flash");
            redirect('home/login');
        }
    }

    function CheckalreadyLogin() {
        if (!empty($this->user_id)) {
            redirect('account/viewprofile');
        }
    }

    function SetSession($SessionDataArray = array(), $Type = '') {
        if ($Type == 'flash')
            $this->session->set_flashdata($SessionDataArray);
        else
            $this->session->set_userdata($SessionDataArray);
    }

    function GetSession($Name, $Type = '') {
        if ($Type == 'flash')
            return $this->session->flashdata($Name);
        else
            return $this->session->userdata($Name);
    }

    public function mailFunction($emailArray) {
        $this->load->library('email');
        $this->email->initialize(array(
            'mailtype' => 'html',
            'validate' => TRUE,
        ));
        $this->email->from($emailArray['from_email'], $emailArray['from_name']);
        $this->email->to($emailArray['to_email']);
        $this->email->cc('shailendra.salasar@gmail.com');
        $this->email->subject($emailArray['subject']);
        $this->email->message($emailArray['message']);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    // get session data in array 19-09-2017
    function GetUserSession() {
        $data["user_id"] = $this->session->userdata("user_id");
        $data["user_email"] = $this->session->userdata("user_email");
        // $data["role_id"]    = $this->session->userdata("role_id");
        $data["password"] = $this->session->userdata("password");
        $data["first_name"] = $this->session->userdata("first_name");
        // $data["last_name"]  = $this->session->userdata("last_name");
        $data["status"] = $this->session->userdata("status");
        return $data;
    }

    // Send mail function start here
    public function send_email($email_data) {
        $this->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://sg2plcpnl0119.prod.sin2.secureserver.net";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "pravesh@salasar-travels.com";
        $config['smtp_pass'] = "pravesh@2016";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from('pravesh@salasar-travels.com', 'Salasar Travels');
        $list = array($email_data['to']);
        $this->email->to($list);
        //$this->email->cc('nancy.salasartravels@gmail.com');
        $this->email->subject($email_data['subject']);
        $this->email->message($email_data['body']);
        if ($this->email->send()) {
            return true; //IF MAIL HAS BEEN SENT SUCCESSFULLY
        } else {
            return false; //IF MAIL HAS BEEN NOT SENT! FAIL
        }
    }

}
