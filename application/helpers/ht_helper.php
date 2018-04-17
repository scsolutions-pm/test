<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function showStatus($status) {
    switch ($status) {
        case 1:
            $currentStatus = "<button class='btn btn-warning btn-mini'>Active</button>";
            break;
        default:
            $currentStatus = "<button class='btn btn-danger btn-mini'>Deactive</button>";
            break;
    }
    return $currentStatus;
}

function showRolename($name) {
    switch ($status) {
        case 1:
            $currentStatus = "<button class='btn btn-warning btn-mini'>Active</button>";
            break;
        default:
            $currentStatus = "<button class='btn btn-danger btn-mini'>Deactive</button>";
            break;
    }
    return $currentStatus;
}

function showPaymentStatus($status) {
    switch ($status) {
        case 1:
            $currentStatus = "<button class='btn btn-warning btn-mini'>Completed</button>";
            break;
        default:
            $currentStatus = "<button class='btn btn-success btn-mini'>Pending</button>";
            break;
    }
    return $currentStatus;
}

function showRequestStatus($status) {
    switch ($status) {
        case 1:
            $currentStatus = "<button class='btn btn-warning btn-mini'>Approved</button>";
            break;
        default:
            $currentStatus = "<button class='btn btn-danger btn-mini'>Pending</button>";
            break;
    }
    return $currentStatus;
}

function namefromid($id, $tablename, $column) {
    //  echo $id."<br>".$tablename."<br>".$column;

    $tbname = substr($tablename, strpos($tablename, '_') + 1);
    $col = $tbname . '_id';
    $obj = & get_instance();
    $result = $obj->db->select($column)
            ->from($tablename)
            // ->where($tbname . '_id', $id)
            ->where("FIND_IN_SET('$id',$col) !=", 0)
            ->get();
    // echo $obj->db->last_query();

    $num_rows = $result->num_rows();
    if ($num_rows == '0') {
        $colname = '';
    } else {
        $colname = $result->row()->$column;
    }
    return $colname;
}

function emailfromid($id) {
    $obj = & get_instance();
    $result = $obj->db->select('email')
            ->from('ex_users')
            ->where('id', $id)
            ->get();
    return $result->row()->email;
}

function zonename($data) {
    $i = 0;
    $obj = & get_instance();
    $final_array = [];
    $zone = explode(',', $data);
    foreach ($zone as $value) {
        $name = namefromid($value, 'ex_zones', 'zone_name');
        $final_array[$i] = $name;
        $i++;
    }
    $zonenames = implode(',', $final_array);
    return $zonenames;
}

// get album id function start here
function getAlbumId($aname) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_album Where album_name='" . $aname . "'";
    $query = $ci->db->query($sql);
    $result = $query->row();
    // echo $sql; die;
    return $result;
}

// get Category id function start here
function getCategoryId($cname) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_category Where category_name='" . $cname . "'";
    $query = $ci->db->query($sql);
    $result = $query->row();
    // echo $sql; die;
    return $result;
}

// get Interpreter id function start here
function getInterpreterId($iname) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_interpreter Where interpreter_name='" . $iname . "'";
    $query = $ci->db->query($sql);
    $result = $query->row();
    // echo $sql; die;
    return $result;
}

// get Track id function start here
function getTracktypeId($tname) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_tracktype Where tracktype_name='" . $tname . "'";
    $query = $ci->db->query($sql);
    $result = $query->row();
    // echo $sql; die;
    return $result;
}

function countcolumn($columval, $column, $tablename) {
    // echo $columval ."&&".$column ."&&".$tablename ;
    $obj = & get_instance();
    $result = $obj->db->select($column)
            ->from($tablename)
            // ->where($column, $columval)
            ->where("FIND_IN_SET('$columval',$column) !=", 0)
            ->get();

    //echo $obj->db->last_query(); 
    // echo $result->num_rows();die; 
    return $result->num_rows();
}

function countcolumn2($columval, $column, $tablename) {
    // echo $columval ."==".$column ."==".$tablename ;
    $obj = & get_instance();
    $result = $obj->db->select($column)
            ->from($tablename)
            // ->where($column, $columval)
            ->where("FIND_IN_SET('$columval',$column) !=", 0)
            ->get();
    // echo $result->num_rows();die; 
    $num_rowss = $result->num_rows();
    $mycount = array('column_id' => $column, 'total_count' => $num_rowss);
    return $mycount;
}

function namefromAlbumId($id) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_album Where album_id='" . $id . "'";
    $query = $ci->db->query($sql);
    $result = $query->row()->album_description;
    // echo $sql; die;
    return $result;
}

function interpretDescFromInterpretId($id) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_interpreter Where interpreter_id='" . $id . "'";
    $query = $ci->db->query($sql);
    $result = $query->row()->interpreter_description;
     echo $sql; die;
    return $result;
}

function idFromAlbumName($title) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_album Where album_description='" . $title . "'";
    $query = $ci->db->query($sql);
    $result = $query->row()->album_id;
    // echo $sql; die;
    return $result;
}

function idFromMusicName($title) {
    //echo $title;
    $ci = & get_instance();
    $ci->load->database();
    $sql = 'SELECT * FROM gm_music Where track_name="' . $title . '" ';
    $query = $ci->db->query($sql);
    $result = $query->row()->music_id;
   //  echo $sql; die;
    return $result;
}

function namefromMusicId($id) {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "SELECT * FROM gm_music Where music_id='" . $id . "'";
    $query = $ci->db->query($sql);
    $track_name = $query->row()->track_slug;
   // $track_names = explode(" ", $track_name);
   // $strss = implode("-", $track_names);
    return $track_name;
}

?>