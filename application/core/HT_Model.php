<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class HT_Model extends CI_Model {

    function InsertRecord($TableName, $Data) {
        $this->db->insert($TableName, $Data);
        return $this->db->insert_id();
    }

    function UpdateRecord($TableName, $Data, $WhereData = NULL) {
        if ($WhereData != NULL) {
            $this->db->where($WhereData);
        }
        $Result = $this->db->update($TableName, $Data);
        return $Result;
    }

    function DeleteRecord($TableName, $WhereData, $column) {

        $this->db->where($column, $WhereData);
        return $result = $this->db->delete($TableName);
    }

    function SelectSingleRecord($TableName, $Selectdata, $WhereData = array(), $orderby = array()) {
        $this->db->select($Selectdata);
        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($WhereData)) {
            $this->db->where($WhereData);
        }
        $query = $this->db->get($TableName);
        return $query->row();
    }

    function SelectRecord($TableName, $Selectdata, $WhereData, $orderby) {
        $this->db->select($Selectdata);
        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($WhereData)) {
            $this->db->where($WhereData);
        }
        $query = $this->db->get($TableName);

        return $query->result_array();
    }
        function FindRecord($TableName, $Selectdata, $Find, $Inset, $orderby) {
        $this->db->select($Selectdata);
        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($Find)) {
            $this->db->where("FIND_IN_SET('$Find',$Inset) !=", 0);
        } 
        $query = $this->db->get($TableName);
      //  echo  $this->db->last_query();die;

        return $query->result_array();
    }

    function SelectLikeRecord($TableName, $Selectdata, $column, $column1, $WhereData, $orderby) {
        $this->db->select($Selectdata);
        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($column)) {
            $this->db->like($column, $WhereData);
        }
        if (!empty($column1)) {
            $this->db->or_like($column1, $WhereData);
        }
        $query = $this->db->get($TableName);

        return $query->result_array();
    }

    function joindata($place1, $place2, $WhereData, $Selectdata, $TableName1, $TableName2, $orderby) {
        $this->db->select($Selectdata);
        $this->db->from($TableName1);
        $this->db->join($TableName2, $place1 . '=' . $place2);
        $this->db->order_by($orderby);
        $this->db->where($WhereData);
        $query = $this->db->get();
        return $query->row_array();
    }

    function joinApidata($place1, $place2, $WhereData, $Selectdata, $TableName1, $TableName2, $orderby) {
        $this->db->select($Selectdata);
        $this->db->from($TableName1);
        $this->db->join($TableName2, $place1 . '=' . $place2);
        $this->db->order_by($orderby);
        $this->db->where($WhereData);
        $query = $this->db->get();
        return $query->result_array();
    }

    function countrecords($TableName, $WhereData) {
        $this->db->where($WhereData);
        return $query = $this->db->count_all_results($TableName);
    }

    function get_cd_list($aColumns, $TableName, $order_index, $searchCol) {

        /* Total data set length */
        $sQuery = "SELECT COUNT('id') AS row_count
            FROM " . $TableName;
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;
        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }

        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/\%5B/", '[', $uri_string);
        $uri_string = preg_replace("/\%5D/", ']', $uri_string);

        $get_param_array = explode("&", $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            $arr[$explode[0]] = $explode[1];
        }

        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
        /*
         * Ordering
         */
        $sOrder = "ORDER BY ";
        $sOrderIndex = $order_index; //$arr['order[0][column]'] passed 1 for default desc sorting with column 1
        $sOrderDir = 'DESC';
        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        if ($bSortable_ == "true") {
            $sOrder .= $aColumns[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }
        $sWhere = "WHERE ((";
        foreach ($searchCol as $key => $value) {
            $sWhere .= $key . " = " . $value . " AND ";
        }
        $sWhere = rtrim($sWhere, "AND ");
        /*
         * Filtering
         */
        $sSearchVal = $arr['search[value]'];
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere .= " ) AND ";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3) . ")";
        } else {
            $sWhere .= '))';
        }
        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM " . $TableName . "
        $sWhere
        $sOrder
        $sLimit
        ";
        $rResult = $this->db->query($sQuery);
        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;
        /*
         * Output
         */
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "temp_data" => $rResult->result_array()
        );
        return ($output);
    }

}
