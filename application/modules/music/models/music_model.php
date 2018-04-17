<?php

class Music_model extends HT_Model {

    function __construct() {
        parent::__construct();
    }

    public function insertCSV($tbl_name, $data) {
        $this->db->insert($tbl_name, $data);
//        echo $this->db->last_query(); die;
        return TRUE;
    }

}
