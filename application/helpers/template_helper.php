<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Used for Meta Info
 *
 * @param none
 * @return array
 */
function template_head(){
	$CI =& get_instance();
	$CI->template->write('title', 'Course Directory');
	$data['metaKeywords'] = strip_tags('Meta Keywords goes here');
	$data['metaDescription'] = strip_tags('Meta Desc Goes here');
	return $data;
}

/**
 *
 * Include Header and Footer
 *
 * @param none
 * @return array
 */
function backend_includes_files(){
	$CI =& get_instance();
	$data['nav'] = 'admin';
	$data['header1'] = $CI->load->view('includes/backend/header',$data,TRUE);
	$data['footer1'] = $CI->load->view('includes/backend/footer','',TRUE);
	$data['front_style_script'] = $CI->load->view('includes/backend/admin_style_scripts','',TRUE);
	return $data;
}

?>