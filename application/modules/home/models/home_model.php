<?php

class Home_model extends HT_Model {

    function __construct() {
        parent::__construct();
    }

    function getSearchResults($filter) {
        $this->db->select('gm_music.music_id,gm_music.album_id,gm_music.year,gm_album.album_id,gm_album.album_name,gm_album.album_description,gm_album.album_image,gm_album.album_interpret,gm_album.album_kategorien');
       $this->db->group_by('gm_album.album_id'); 
        $this->db->from('gm_music');

       // print_r($filter);die;

    //  $minvalue = $filter['yearafter'];
    // $maxvalue = $filter['yearbefore'];
        
//        $this->db->where('date >=', $minvalue);
//        $this->db->where('date <=', $maxvalue);

  // $this->db->where("year BETWEEN $minvalue AND $maxvalue");

//        if (!empty($filter['tracks'])) {
//            $this->db->where('tracktype_id', $this->security->xss_clean(trim($filter['tracks'])));
//        }
//        if (!empty($filter['interpreter'])) {
//            $this->db->where('interpreter_id', $this->security->xss_clean(trim($filter['interpreter'])));
//        }

        if (!empty($filter['tracks'])) {
//            $tracks = explode(',', $this->security->xss_clean(($filter['tracks'])));
            foreach ($filter['tracks'] as $tval) {
                $this->db->or_where("FIND_IN_SET('$tval',tracktype_id) !=", 0);
              // $this->db->where("find_in_set(".$tval.",tracktype_id) ",!null,true);
            }
        }

        if (!empty($filter['interpreter'])) {
            //   $interpreter = explode(',', $this->security->xss_clean(($filter['interpreter'])));
            foreach ($filter['interpreter'] as $ival) {
                $this->db->or_where("FIND_IN_SET('$ival',interpreter_id) !=", 0);
               //  $this->db->where("find_in_set(".$ival.",interpreter_id) ",!null,true);
            }
        }

        if (!empty($filter['album'])) {
            //   $interpreter = explode(',', $this->security->xss_clean(($filter['interpreter'])));
            foreach ($filter['album'] as $aval) {
                $this->db->or_where("FIND_IN_SET('$aval',gm_music.album_id) !=", 0);
               // $this->db->where("find_in_set(".$aval.",album_id) ",!null,true);
            }
        }

        if (!empty($filter['category'])) {
            //   $interpreter = explode(',', $this->security->xss_clean(($filter['interpreter'])));
            foreach ($filter['category'] as $cval) {
                $this->db->or_where("FIND_IN_SET('$cval',category_id) !=", 0);
                //$this->db->where("find_in_set(".$cval.",category_id) ",!null,true);
            }
        }

      $this->db->join('gm_album', 'gm_album.album_id = gm_music.album_id', 'left');

    $queryresult = $this->db->get()->result();
    // echo "<pre>";
    // print_r($queryresult);die;
 //  echo $this->db->last_query(); die;
        
        //$query = $this->db->get();
        // $queryresult['result'] = $query->result();
        // $queryresult['count'] =  $query->num_rows();
        return $queryresult;
    }


    public function GetRow($keyword, $albumArray, $categoryArray, $tracktypeArray, $interpreterArray) {
        $this->db->select('*');
        $this->db->from('gm_music');
        $this->db->group_by('gm_album.album_id'); 

        if (!empty($albumArray)) {
            foreach ($albumArray as $alb_id) {
                $this->db->or_where("FIND_IN_SET('$alb_id',gm_music.album_id) !=", 0);
            }
        }
        if (!empty($categoryArray)) {
            foreach ($categoryArray as $cat_id) {
                $this->db->or_where("FIND_IN_SET('$cat_id',category_id) !=", 0);
            }
        }
        if (!empty($interpreterArray)) {
            foreach ($interpreterArray as $int_id) {
                $this->db->or_where("FIND_IN_SET('$int_id',interpreter_id) !=", 0);
            }
        }
        if (!empty($tracktypeArray)) {
            foreach ($tracktypeArray as $trc_id) {
                $this->db->or_where("FIND_IN_SET('$trc_id',tracktype_id) !=", 0);
            }
        }
        $this->db->or_where("`track_name` LIKE '%$keyword%'");

           $this->db->join('gm_album', 'gm_album.album_id = gm_music.album_id', 'left');

        $queryresult = $this->db->get()->result();

//        echo $this->db->last_query();   die;
        return $queryresult;
    }

//    public function GetRow($keyword) {
//
//        $query = $this->db->query("SELECT music_id FROM gm_music WHERE track_name LIKE '%" .
//                $keyword . "%' OR artist_name LIKE '%" . $keyword . "%') 
//           UNION
//           (SELECT album_id FROM gm_album WHERE album_name LIKE '%" .
//                $keyword . "%' OR album_description LIKE '%" . $keyword . "%') 
//           UNION
//           (SELECT tracktype_id FROM gm_tracktype WHERE tracktype_name LIKE '%" .
//                $keyword . "%' OR tracktype_description LIKE '%" . $keyword . "%'");
//        //$queryresult = $query->result();
//
//        //$queryresult = $this->db->get()->result_array();
//        echo $this->db->last_query();die;
//        return $queryresult;
//    }


    function getSearchCount($filter) {
        $this->db->select('*');
        $this->db->from('gm_music');
     $cnt = array(); ;
     $cnt2 = array(); ; 
        if (!empty($filter['tracks'])) {
          //  $t = 1;
            foreach ($filter['tracks'] as $tval) {
               // $this->db->where("FIND_IN_SET('$tval',tracktype_id) !=", 0);
              $cnt['tracks'] =  countcolumn($tval, 'tracktype_id', 'gm_music');
              $cnt2['tracks'] =  countcolumn2($tval, 'tracktype_id', 'gm_music');
             //   $count['tracks'][$t] =   $t;
          // $t++;
            }
            //print_r($count['tracks'] );die;
        }

        if (!empty($filter['interpreter'])) {
            foreach ($filter['interpreter'] as $ival) {
               // $this->db->where("FIND_IN_SET('$ival',interpreter_id) !=", 0);
                $cnt['interpreter'] =  countcolumn($tval, 'interpreter_id', 'gm_music');
                $cnt2['interpreter'] =  countcolumn2($tval, 'interpreter_id', 'gm_music');
         }
        }

        if (!empty($filter['album'])) {
            foreach ($filter['album'] as $aval) {
              //  $this->db->where("FIND_IN_SET('$aval',gm_music.album_id) !=", 0);
                 $cnt['album'] =  countcolumn($tval, 'album_id', 'gm_music');
                 $cnt2['album'] =  countcolumn2($tval, 'album_id', 'gm_music');
           }
        }

        if (!empty($filter['category'])) {
            foreach ($filter['category'] as $cval) {
               // $this->db->where("FIND_IN_SET('$cval',category_id) !=", 0);
                $cnt['category']  =  countcolumn($tval, 'category_id', 'gm_music');
                $cnt2['category'] =  countcolumn2($tval, 'category_id', 'gm_music');
            }
        }

      //  print_r($count); die;

        // $minvalue = $filter['yearafter'];
        // $maxvalue = $filter['yearbefore'];
        

    //  $this->db->where("YEAR(date) BETWEEN $minvalue AND $maxvalue");

    $queryresult = $this->db->get()->result();
    //echo $this->db->last_query(); die;
        
        //$query = $this->db->get();
        // $queryresult['result'] = $query->result();
        // $queryresult['count'] =  $query->num_rows();

//print_r($cnt);die;
    //$myresutl = $cnt.'#'.$cnt2;
   return $cnt;
    //return $myresutl;
        //return $queryresult;
    }
}
