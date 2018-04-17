<?php

class Admin_model extends HT_Model {

    function __construct() {
        parent::__construct();
    }

     public function insertCSV($tbl_name,$data)
        {
            $this->db->insert($tbl_name, $data);
            // echo $this->db->last_query(); die;
            return TRUE;
        }
        
        
    // public function view_data()
    //    {
    //        $query=$this->db->query("SELECT im.*
    //                                 FROM import im 
    //                                 ORDER BY im.id DESC");
    //        return $query->result_array();
    //    }		
}
