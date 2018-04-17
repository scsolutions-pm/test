<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends HT_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('image_lib');
        $this->load->library('PHPExcel');
        $this->load->helper('url');
        $this->load->library('user_agent');
        //   $this->CheckLogin();
    }

    function searchresults() {
        $filter = array(
            'tracks' => $this->input->post('tracks'),
            'interpreter' => $this->input->post('inter'),
            'album' => $this->input->post('album'),
            'category' => $this->input->post('category'),
            'yearafter' => $this->input->post('yearafter'),
            'yearbefore' => $this->input->post('yearbefore')
        );
        $music = $this->home_model->getSearchResults($filter);
        // $count = $this->home_model->getSearchCount($filter);

        $data = '';
        // echo "<pre>";  print_r($music); die;

        foreach ($music as $value) {
            if (!empty($value->album_interpret)) {
                $trackArray = explode(',', $value->album_interpret);
                $prefix = $intlist = '';
                foreach ($trackArray as $track) {
                    $intlist .= $prefix . '' . namefromid($track, 'gm_interpreter', 'interpreter_name') . '';
                    $prefix = ', ';
                }
                $intlist = $intlist;
            } else {
                $intlist = '';
            }

            // echo $value->track_name;die;
            //print_r($value);die;
            $data .= '<div class="col-md-4"><div class="heightdiv">';
            $data .= "<a href = '" . base_url() . "home/albumDetails/" . namefromAlbumId($value->album_id) . "'><img src='" . base_url() . "uploads/category_img/$value->album_image' height='150' width='150'/></a>";
            $data .= '<h4>' . $value->album_name . '</h4>';
            $data .= '<p>' . $value->album_interpret . '</p>';
            $data .= '</div></div>';
        }
        //echo $data;
        $myresult = array('searchresult' => $data);
        echo json_encode($myresult);
        //die;
    }

    public function GetByKeyword() {
        $keyword = $this->input->post('keyword');
        $getKeyAlbum = $this->getKeyAlbum($keyword);
        $getKeyCategory = $this->getKeyCategory($keyword);
        $getKeyTracktype = $this->getKeyTracktype($keyword);
        $getKeyInterpreter = $this->getKeyInterpreter($keyword);

        $albumArray = array();
        foreach ($getKeyAlbum as $albvalue) {
            foreach ($albvalue as $avalue) {
                $albumArray[] = $avalue;
            }
        }
        $categoryArray = array();
        foreach ($getKeyCategory as $catvalue) {
            foreach ($catvalue as $cvalue) {
                $categoryArray[] = $cvalue;
            }
        }
        $tracktypeArray = array();
        foreach ($getKeyTracktype as $trackvalue) {
            foreach ($trackvalue as $tvalue) {
                $tracktypeArray[] = $tvalue;
            }
        }
        $interpreterArray = array();
        foreach ($getKeyInterpreter as $intervalue) {
            foreach ($intervalue as $ivalue) {
                $interpreterArray[] = $ivalue;
            }
        }
        $music = $this->home_model->GetRow($keyword, $albumArray, $categoryArray, $tracktypeArray, $interpreterArray);
        $data = '';
        foreach ($music as $value) {

            if (!empty($value->album_id)) {
                $trackArray = explode(',', $value->album_id);
                $prefix = $alblist = '';
                foreach ($trackArray as $track) {
                    $alblist .= $prefix . '' . namefromid($track, 'gm_album', 'album_name') . '';
                    $prefix = ', ';
                }
                $alblist = $alblist;
            } else {
                $alblist = 'No';
            }

            if (!empty($value->interpreter_id)) {
                $itrackArray = explode(',', $value->interpreter_id);
                $prefix = $intlist = '';
                foreach ($itrackArray as $track) {
                    $intlist .= $prefix . '' . namefromid($track, 'gm_interpreter', 'interpreter_description') . '';
                    $prefix = ', ';
                }
                $intlist = $intlist;
            } else {
                $intlist = 'No';
            }

            if (!empty($value->category_id)) {
                $ctrackArray = explode(',', $value->category_id);
                $prefix = $catlist = '';
                foreach ($ctrackArray as $track) {
                    $catlist .= $prefix . '' . namefromid($track, 'gm_category', 'category_name') . '';
                    $prefix = ', ';
                }
                $catlist = $catlist;
            } else {
                $catlist = 'No';
            }
            $data .= '<li><div class="col-md-12">';
            $data .= "<div class='col-md-2'><a href = '" . base_url() . "home/albumDetails/" . namefromAlbumId($value->album_id) . "'><img class='search_img' src='" . base_url() . "uploads/category_img/$value->album_image'/></a></div>";
            $data .= '<div class="col-md-8"><h4><a href="' . base_url() . 'home/albumDetails/' . namefromMusicId($value->album_id) . '" >' . $value->track_name . '</a></h4>';
            $data .= '<span><span>' . lang('interpreter') . ': </span><a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($value->album_id) . '" >' . $intlist . '</a></span> &nbsp;<span><span>' . lang('category') . ': </span><a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($value->album_id) . '" >' . $catlist . '</a></span> &nbsp;<span><span>' . lang('year') . ': </span><a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($value->album_id) . '" >' . $value->year . '</a></span>';
            $data .= '<p><span>' . lang('album') . ': </span><a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($value->album_id) . '" >' . $alblist . '</a></p>';
            $data .= '</div></div></li>';
        }
        $myresult = array('datas' => $data);
        echo json_encode($myresult);
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

    public function index() {
//        $data['Error'] = $this->GetSession('Error', "flash");
//        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "GOODMUSIC.ONLINE-Good Music";
        $data['albums'] = $this->getAlbum();
        $data['homedetail'] = $this->getPageDetails(1);
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

    public function getPageDetails($Id) {
        $TableName = 'gm_page';
        $Selectdata = '*';
        $WhereData = array('page_id' => $Id);
        $orderby = 'page_id desc';
        return $this->home_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function tracks() {
//        $data['Error'] = $this->GetSession('Error', "flash");
//        $data['Success'] = $this->GetSession('Success', "flash");
        $data['title'] = "Tracks - GoodMusic.ONLINE";
        $data['tracks'] = $this->getTracks();
        $trackid = $this->getPopupTrackId();
        $tid = $trackid->track_id;
        $data['popupDetail'] = $this->getPopupDetail($tid);
        // echo $this->db->last_query();die;
        // print_r( $data['popupDetail']);die;
        $data['albums'] = $this->getAlbum();
        $data['categories'] = $this->getCategory();
        $data['interpreters'] = $this->getInterpreter();
        $data['tracktypes'] = $this->getTracktype();
        $this->load->view('header', $data);
        $this->load->view('track', $data);
        //   $this->load->view('footer');
    }

    function getPopupTrackId() {
        $TableName = "gm_popup";
        $Selectdata = "track_id";
        $WhereData = array();
        $orderby = "popup_id desc";
        return $this->home_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function getPopupDetail($tid) {
        $TableName = 'gm_album';
        $Selectdata = '*';
        $WhereData = array('album_id' => $tid);
        $orderby = 'album_id desc';
        return $this->home_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function albumDetails() {
        $Id = idFromAlbumName($this->uri->segment(3));
        //  $Id = $this->input->post('alb_id');
        $albumtitle = namefromid($Id, 'gm_album', 'album_name');
        $data['title'] = $albumtitle . '- GOODMUSIC.ONLINE';
        $data['albumdetail'] = $this->getAlbumDetails($Id);
        $data['albumtracks'] = $this->getAlbumTracks($Id);
        $this->load->view('header', $data);
        $this->load->view('albumdetail', $data);
    }

    public function getAlbumDetails($Id) {
        $TableName = 'gm_album';
        $Selectdata = '*';
        $WhereData = array('album_id' => $Id);
        $orderby = 'album_id ASC';
        return $this->home_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    public function getAlbumTracks($Id) {
        $TableName = 'gm_music';
        $Selectdata = '*';
        //   $WhereData = array('album_id' => $Id);
        //$this->db->where_in('id', $ids); 
        $Find = $Id;
        $Inset = 'album_id';
        $orderby = 'album_track_number ASC';
        return $this->home_model->FindRecord($TableName, $Selectdata, $Find, $Inset, $orderby);
    }

    public function trackDetails() {
        $track_slug = urldecode($this->uri->segment(3));
        //echo urldecode ($track_slug);  die;
        $resu = $this->get_data('gm_music', array('track_slug' => $track_slug));
        // echo $this->db->last_query(); die;
        $num_rows = $resu->num_rows();
        $data['title'] = $resu->row()->track_name;
        $data['trackdetail'] = $this->getTrackDetails($resu->row()->music_id);
        $this->load->view('header', $data);
        $this->load->view('trackdetail', $data);
    }

//      public function albumDetails() {
//        $Id = idFromAlbumName($this->uri->segment(3));
//        //  $Id = $this->input->post('alb_id');
//        $albumtitle = namefromid($Id, 'gm_album', 'album_name');
//        $data['title'] = $albumtitle . '- GOODMUSIC.ONLINE';
//        $data['albumdetail'] = $this->getAlbumDetails($Id);
//        $data['albumtracks'] = $this->getAlbumTracks($Id);
//        $this->load->view('header', $data);
//        $this->load->view('albumdetail', $data);
//    }


    public function getTrackDetails($Id) {
        $TableName = 'gm_music';
        $Selectdata = '*';
        $WhereData = array('music_id' => $Id);
        $orderby = 'music_id ASC';
        return $this->home_model->SelectSingleRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getTracks() {
        $TableName = "gm_music";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "music_id ASC";
        return $this->home_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getAlbum() {
        $TableName = "gm_album";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "album_id ASC";
        return $this->home_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getKeyAlbum($keyword) {
        $TableName = "gm_album";
        $Selectdata = "album_id";
        $WhereData = $keyword;
        $column = "album_name";
        $column1 = "album_description";
        $orderby = "album_id ASC";
        return $this->home_model->SelectLikeRecord($TableName, $Selectdata, $column, $column1, $WhereData, $orderby);
    }

    function getCategory() {
        $TableName = "gm_category";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "category_id ASC";
        return $this->home_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getKeyCategory($keyword) {
        $TableName = "gm_category";
        $Selectdata = "category_id";
        $WhereData = $keyword;
        $column = "category_name";
        $column1 = "category_description";
        $orderby = "category_id ASC";
        return $this->home_model->SelectLikeRecord($TableName, $Selectdata, $column, $column1, $WhereData, $orderby);
    }

    function getTracktype() {
        $TableName = "gm_tracktype";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "tracktype_id ASC";
        return $this->home_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getKeyTracktype($keyword) {
        $TableName = "gm_tracktype";
        $Selectdata = "tracktype_id";
        $WhereData = $keyword;
        $column = "tracktype_name";
        $column1 = "tracktype_description";
        $orderby = "tracktype_id ASC";
        return $this->home_model->SelectLikeRecord($TableName, $Selectdata, $column, $column1, $WhereData, $orderby);
    }

    function getInterpreter() {
        $TableName = "gm_interpreter";
        $Selectdata = "*";
        $WhereData = array();
        $orderby = "interpreter_id ASC";
        return $this->home_model->SelectRecord($TableName, $Selectdata, $WhereData, $orderby);
    }

    function getKeyInterpreter($keyword) {
        $TableName = "gm_interpreter";
        $Selectdata = "interpreter_id";
        $WhereData = $keyword;
        $column = "interpreter_name";
        $column1 = "interpreter_description";
        $orderby = "interpreter_id DESC";
        return $this->home_model->SelectLikeRecord($TableName, $Selectdata, $column, $column1, $WhereData, $orderby);
    }

    function searchcount() {
        $filter = array(
            'tracks' => $this->input->post('tracks'),
            'interpreter' => $this->input->post('inter'),
            'album' => $this->input->post('album'),
            'category' => $this->input->post('category')
                // 'yearafter' => $this->input->post('yearafter'),
                // 'yearbefore' => $this->input->post('yearbefore')
        );

        // print_r($filter);die;
        $music = $this->home_model->getSearchCount($filter);
        echo '<pre>';
        print_r($music);
        die;
        $data = '';

        foreach ($music as $value) {
            if (!empty($value->album_interpret)) {
                $trackArray = explode(',', $value->album_interpret);
                $prefix = $intlist = '';
                foreach ($trackArray as $track) {
                    $intlist .= $prefix . '' . namefromid($track, 'gm_interpreter', 'interpreter_description') . '';
                    $prefix = ', ';
                }
                $intlist = $intlist;
            } else {
                $intlist = '';
            }

            // echo $value->track_name;die;
            //print_r($value);die;
            $data .= '<div class="col-md-4"><div class="heightdiv">';
            $data .= "<a href = '" . base_url() . "home/albumDetails/" . namefromAlbumId($value->album_id) . "'><img src='" . base_url() . "uploads/category_img/$value->album_image' height='150' width='150'/></a>";
            $data .= '<h4>' . $value->album_name . '</h4>';
            $data .= '<p>' . $intlist . '</p>';
            $data .= '</div></div>';
        }
        echo $data;
        // echo json_encode($data);
    }

    function newSearchResult() {
        $mySerachTypess = $this->input->post('mySerachTypess');
        $tracktypes_ids = $this->input->post('tracktypes_ids');
        $interpret_ids = $this->input->post('interpret_ids');
        $album_ids = $this->input->post('album_ids');
        $category_ids = $this->input->post('category_ids');
        $serachTypess = explode(",", $mySerachTypess);

        $amounts = $this->input->post('amounts');
        $amount = explode("-", $amounts);

        $where = '';
        $where = 'music_status = 1 ';
        $where_c = 'music_status = 1 ';
        if ($tracktypes_ids == '' && $interpret_ids == '' && $album_ids == '' && $category_ids == '') {
            //$result_m = $this->db->query('SELECT * FROM gm_music where music_status = "1"  ORDER by `music_id`')->result();
            $result_m = $this->db->query('SELECT * FROM gm_music where music_status = "1" AND `year` >= ' . $amount[0] . ' AND `year` <= ' . $amount[1] . ' ORDER by `music_id`')->result();
            $myhtml = '';
            // $all_album_ids_all = array();
            //  foreach ($result as  $value) {
            //     if (!in_array($value->album_id, $all_album_ids_all)){
            //          array_push($all_album_ids_all,$value->album_id); 
            //     } 
            //  }

            $all_album_ids = array();
            foreach ($result_m as $value_m) {
                $m = explode(',', $value_m->album_id);
                foreach ($m as $value_m) {
                    if (!in_array($value_m, $all_album_ids)) {
                        array_push($all_album_ids, $value_m);
                    }
                }
            }
            $album_info_all = $this->get_data_where_in('gm_album', 'album_id', $all_album_ids)->result();
            foreach ($album_info_all as $album_value_all) {
                if ($album_value_all->album_image == '') {
                    $imgss = 'no-photo.jpg';
                } else {
                    $imgss = $album_value_all->album_image;
                }
                $myhtml .= '<div class="col-md-4 loadcol"><div class="heightdiv">
                                    <a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($album_value_all->album_id) . '">
                                        <img height="150" width="150" src="' . base_url() . 'uploads/category_img/' . $imgss . '" ></a>
                                    <h4>' . $album_value_all->album_name . '</h4>
                                    <span>' . namefromid($album_value_all->album_interpret, 'gm_interpreter', 'interpreter_description') . '</span>
                                </div></div>';
            }
            $getresult = array('myresult' => $myhtml, 'mySerachTypess' => $mySerachTypess);
            //echo $myhtml; die;  
            echo json_encode($getresult);
            die;
        } else {
            $where .= ' AND `year` >= ' . $amount[0] . ' AND `year` <= ' . $amount[1] . ' ';
            foreach ($serachTypess as $type) {
                if ($type == 'tracktypes' && $tracktypes_ids != '') {
                    $tracktypes_id_arr = explode('|', $tracktypes_ids);
                    $where .= 'AND CONCAT(",", `tracktype_id`, ",") REGEXP ",(' . $tracktypes_ids . '),"';
                }

                if ($type == 'interpret' && $interpret_ids != '') {
                    $where .= 'AND  CONCAT(",", `interpreter_id`, ",") REGEXP ",(' . $interpret_ids . '),"';
                }

                if ($type == 'album' && $album_ids != '') {
                    $where .= 'AND  CONCAT(",", `album_id`, ",") REGEXP ",(' . $album_ids . '),"';
                }

                if ($type == 'category' && $category_ids != '') {
                    $where .= 'AND  CONCAT(",", `category_id`, ",") REGEXP ",(' . $category_ids . '),"';
                }
            }
            // $where  .= ' GROUP BY album_id ORDER BY music_id DESC;';
            $result_m = $this->db->query('SELECT * FROM gm_music where ' . $where . '')->result();
            //   echo $this->db->last_query();
            //    die;
            $num_rows = $this->db->query('SELECT * FROM gm_music where ' . $where . '')->num_rows();
            if ($num_rows == '0') {
                $myhtml = '';
                $getresult = array('myresult' => $myhtml, 'mySerachTypess' => $mySerachTypess);
            } else {
                //=======================================
                $myhtml = '';
                $all_album_ids = array();
                foreach ($result_m as $value_m) {
                    $m = explode(',', $value_m->album_id);
                    foreach ($m as $value_m) {
                        if (!in_array($value_m, $all_album_ids)) {
                            array_push($all_album_ids, $value_m);
                        }
                    }
                }
                // fm code 
                $master_select = explode('|', $album_ids);
                $common_val = array_intersect($master_select, $all_album_ids);
                // print_r($all_album_ids);
                // print_r($master_select);
                // print_r($common_val);die;

                if (!empty($common_val)) {
                    $album_info = $this->get_data_where_in('gm_album', 'album_id', $common_val)->result();
                    foreach ($album_info as $album_value) {
                        if ($album_value->album_image == '') {
                            $imgss = 'no-photo.jpg';
                        } else {
                            $imgss = $album_value->album_image;
                        }
                        $myhtml .= '<div class="col-md-4 loadcol"><div class="heightdiv">
                                            <a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($album_value->album_id) . '">
                                                <img height="150" width="150" src="' . base_url() . 'uploads/category_img/' . $imgss . '" ></a>
                                            <h4>' . $album_value->album_name . '</h4>
                                             <span>' . namefromid($album_value->album_interpret, 'gm_interpreter', 'interpreter_description') . '</span>
                                        </div></div>';
                    }
                } else {
                    $album_info = $this->get_data_where_in('gm_album', 'album_id', $all_album_ids)->result();
                    foreach ($album_info as $album_value) {
                        if ($album_value->album_image == '') {
                            $imgss = 'no-photo.jpg';
                        } else {
                            $imgss = $album_value->album_image;
                        }
                        $myhtml .= '<div class="col-md-4 loadcol"><div class="heightdiv">
                                            <a href="' . base_url() . 'home/albumDetails/' . namefromAlbumId($album_value->album_id) . '">
                                                <img height="150" width="150" src="' . base_url() . 'uploads/category_img/' . $imgss . '" ></a>
                                            <h4>' . $album_value->album_name . '</h4>
                                            <span>' . namefromid($album_value->album_interpret, 'gm_interpreter', 'interpreter_description') . '</span>
                                       </div></div>';
                    }
                }

                $getresult = array('myresult' => $myhtml, 'mySerachTypess' => $mySerachTypess);
                //==============================
            }
            //echo $myhtml; die;  
            echo json_encode($getresult);
            die;
        }
        //Close Else
    }

    public function GetByKeywordNew() {
        $data = '';
        $keyword = $this->input->post('keyword');
        //Search In Album Table
        $result_alb = $this->db->select('*')->from('gm_album')->where("album_name LIKE '%$keyword%'")->get();
        $result_alb_rest = $result_alb->result();
        $result_alb_cout = $result_alb->num_rows();
        if ($result_alb_cout > 0) {
            foreach ($result_alb_rest as $row_alb) {
                $result_mus = $this->get_data_find_in_set('gm_music', $row_alb->album_id, 'album_id')->result();
                foreach ($result_mus as $row_m_alb) {
                    $interpreter_m_id = explode(',', $row_m_alb->interpreter_id);
                    $interpreter_res = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_m_id[0]))->row();
                    $num_rows_int = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_m_id[0]))->num_rows();
                    if ($num_rows_int > 0) {
                        $interpreter_name_a = $interpreter_res->interpreter_description;
                    } else {
                        $interpreter_name_a = 'N/A';
                    }
                    $category_id_a = explode(',', $row_m_alb->category_id);
                    $category_res_a = $this->get_data('gm_category', array('category_id' => $category_id_a[0]))->row();
                    $num_rows_cat_a = $this->get_data('gm_category', array('category_id' => $category_id_a[0]))->num_rows();
                    if ($num_rows_cat_a > 0) {
                        $category_name_a = $category_res_a->category_name;
                    } else {
                        $category_name_a = 'N/A';
                    }
                    $data .= '<li >';
                    $data .= '<a href ="' . base_url() . 'home/trackDetails/' . namefromMusicId($row_m_alb->music_id) . '">';
                    $data .= '<div class="col-md-12" style="border-bottom: 1px solid #ddd; ">';
                    $data .= "<div class='col-md-2'><img class='search_img' src='" . base_url() . "uploads/category_img/$row_alb->album_image'/></div>";
                    $data .= '<div class="col-md-8"><h4>' . $row_m_alb->track_name . '</h4>';
                    $data .= '<span><span>' . lang('interpreter') . ': </span>' . $interpreter_name_a . '</span> &nbsp;<span><span>' . lang('category') . ': </span>' . $category_name_a . '</span> &nbsp;<span><span>' . lang('year') . ': </span>' . $row_m_alb->year . '</span>';
                    $data .= '<p><span>' . lang('album') . ':</span>' . $row_alb->album_name . '</p>';
                    $data .= '</div></div></a></li>';
                }
            }
        }
        //Search In Category Table
        $result_cat = $this->db->select('*')->from('gm_category')->where("category_name LIKE '%$keyword%'")->get();
        $result_cat_count = $result_cat->num_rows();
        $result_cat_rst = $result_cat->result();
        if ($result_cat_count > 0) {
            foreach ($result_cat_rst as $row_cat) {
                $result_mus_c = $this->get_data_find_in_set('gm_music', $row_cat->category_id, 'category_id')->result();
                foreach ($result_mus_c as $row_m_cat) {
                    $album_mc_id = explode(',', $row_m_cat->album_id);
                    foreach ($album_mc_id as $mc_id) {
                        $album_mc_res = $this->get_data('gm_album', array('album_id' => $mc_id))->row();
                        $interpreter_mc_id = explode(',', $row_m_cat->interpreter_id);
                        $interpreter_mc_res = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_mc_id[0]))->row();
                        $num_rows_mc_int = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_mc_id[0]))->num_rows();
                        if ($num_rows_mc_int > 0) {
                            $interpreter_name_mc = $interpreter_mc_res->interpreter_description;
                        } else {
                            $interpreter_name_mc = 'N/A';
                        }

                        $data .= '<li >';
                        $data .= '<a href ="' . base_url() . 'home/trackDetails/' . namefromMusicId($row_m_cat->music_id) . '">';
                        $data .= '<div class="col-md-12" style="border-bottom: 1px solid #ddd; ">';
                        $data .= "<div class='col-md-2'><img class='search_img' src='" . base_url() . "uploads/category_img/$album_mc_res->album_image'/></div>";
                        $data .= '<div class="col-md-8"><h4>' . $row_m_cat->track_name . '</h4>';
                        $data .= '<span><span>' . lang('interpreter') . ':</span>' . $interpreter_name_mc . '</span> &nbsp;<span><span>' . lang('category') . ':</span>' . $row_cat->category_name . '</span> &nbsp;<span><span>' . lang('year') . ':</span>' . $row_m_cat->year . '</span>';
                        $data .= '<p><span>' . lang('album') . ':</span>' . $album_mc_res->album_name . '</p>';
                        $data .= '</div></div></a></li>';
                    }
                }
            }
        }

        //Search In Interpreter Table
        $result_intr = $this->db->select('*')->from('gm_interpreter')->where("interpreter_name LIKE '%$keyword%'")->get();
        $result_intr_count = $result_intr->num_rows();
        $result_intr_rst = $result_intr->result();
        if ($result_intr_count > 0) {
            foreach ($result_intr_rst as $row_intr) {
                $result_mus_intr = $this->get_data_find_in_set('gm_music', $row_intr->interpreter_id, 'interpreter_id')->result();
                foreach ($result_mus_intr as $row_m_intr) {
                    $category_id_int = explode(',', $row_m_intr->category_id);
                    $category_res_int = $this->get_data('gm_category', array('category_id' => $category_id_int[0]))->row();
                    $num_rows_cat_int = $this->get_data('gm_category', array('category_id' => $category_id_int[0]))->num_rows();
                    if ($num_rows_cat_int > 0) {
                        $category_name_int = $category_res_int->category_name;
                    } else {
                        $category_name_int = 'N/A';
                    }
                    $album_mi_id = explode(',', $row_m_intr->album_id);
                    foreach ($album_mi_id as $mi_id) {
                        $album_mi_res = $this->get_data('gm_album', array('album_id' => $mi_id))->row();

                        $data .= '<li >';
                        $data .= '<a href ="' . base_url() . 'home/trackDetails/' . namefromMusicId($row_m_intr->music_id) . '">';
                        $data .= '<div class="col-md-12" style="border-bottom: 1px solid #ddd; ">';
                        $data .= "<div class='col-md-2'><img class='search_img' src='" . base_url() . "uploads/category_img/$album_mi_res->album_image'/></div>";
                        $data .= '<div class="col-md-8"><h4>' . $row_m_intr->track_name . '</h4>';
                        $data .= '<span><span>' . lang('interpreter') . ':</span>' . $row_intr->interpreter_description . '</span> &nbsp;<span><span>' . lang('category') . ':</span>' . $category_name_int . '</span> &nbsp;<span><span>' . lang('year') . ':</span>' . $row_m_intr->year . '</span>';
                        $data .= '<p><span>' . lang('album') . ':</span>' . $album_mi_res->album_name . '</p>';
                        $data .= '</div></div></a></li>';
                    }
                }
            }
        }

        // Search In Music Table
        //    $result_mus = $this->db->select('*')->from('gm_music')->where("track_name LIKE '%$keyword%'")->get();
        $result_mus = $this->db->select('*')->from('gm_music')->where("track_name LIKE '%$keyword%' OR arranger LIKE '%$keyword%' 
        OR producer LIKE '%$keyword%' OR year LIKE '%$keyword%'  OR isrc LIKE '%$keyword%'  OR publishing_company LIKE '%$keyword%' 
          OR authors LIKE '%$keyword%'    OR duration LIKE '%$keyword%' OR language LIKE '%$keyword%'  ")->get();
        // echo $this->db->last_query(); die;
        $result_mus_count = $result_mus->num_rows();
        $result_mus_rst = $result_mus->result();
        if ($result_mus_count > 0) {
            foreach ($result_mus_rst as $row_mus) {
                $interpreter_mus_id = explode(',', $row_mus->interpreter_id);
                $interpreter_mus_res = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_mus_id[0]))->row();
                $num_rows_mus_int = $this->get_data('gm_interpreter', array('interpreter_id' => $interpreter_mus_id[0]))->num_rows();
                if ($num_rows_mus_int > 0) {
                    $interpreter_name_mus = $interpreter_mus_res->interpreter_description;
                } else {
                    $interpreter_name_mus = 'N/A';
                }
                $category_id_mus = explode(',', $row_mus->category_id);
                $category_res_mus = $this->get_data('gm_category', array('category_id' => $category_id_mus[0]))->row();
                $num_rows_cat_mus = $this->get_data('gm_category', array('category_id' => $category_id_mus[0]))->num_rows();
                if ($num_rows_cat_mus > 0) {
                    $category_name_mus = $category_res_mus->category_name;
                } else {
                    $category_name_mus = 'N/A';
                }

                $album_mus_id = explode(',', $row_mus->album_id);
                foreach ($album_mus_id as $mus_id) {
                    $album_mus_res = $this->get_data('gm_album', array('album_id' => $mus_id))->row();
                    // echo   $this->db->last_query(); die;

                    $data .= '<li >';
                    $data .= '<a href ="' . base_url() . 'home/trackDetails/' . namefromMusicId($row_mus->music_id) . '">';
                    $data .= '<div class="col-md-12" style="border-bottom: 1px solid #ddd; ">';
                    $data .= "<div class='col-md-2'><img class='search_img' src='" . base_url() . "uploads/category_img/$album_mus_res->album_image'/></div>";
                    $data .= '<div class="col-md-8"><h4>' . $row_mus->track_name . '</h4>';
                    $data .= '<span><span>' . lang('interpreter') . ':</span>' . $interpreter_name_mus . '</span> &nbsp;<span><span>' . lang('category') . ':</span>' . $category_name_mus . '</span> &nbsp;<span><span>' . lang('year') . ':</span>' . $row_mus->year . '</span>';
                    $data .= '<p><span>' . lang('album') . ':</span>' . $album_mus_res->album_name . '</p>';
                    $data .= '</div></div></a></li>';
                }
            }
        }

        $myresult = array('datas' => $data);
        echo json_encode($myresult);
        die;
    }

    public function get_data_where_in($table, $where_in, $data) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in($where_in, $data);
        $query = $this->db->get();
        return $query;
    }

    public function get_data_find_in_set($table, $value, $colum) {
        $where = "FIND_IN_SET('" . $value . "', " . $colum . ")";
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    public function get_data($table, $where) {
        $query = $this->db->get_where($table, $where);
        return $query;
    }

}
