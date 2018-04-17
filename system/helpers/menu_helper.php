<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------


if ( ! function_exists('admin_sidebar_menu'))
{
	function AdminSidebarMenu()
	{
		$CI =& get_instance();
		$CI->db->select('menuID,location,menu_name');
		$CI->db->from($CI->config->item('menu_table'));	
		$CI->db->where('status','1');
		$CI->db->where('parent','0');
		$CI->db->where('menuID != ','1');
		$CI->db->where('display','1');
		$CI->db->order_by("order_no", "ASC"); 
		$Query = $CI->db->get();
		$Result = $Query->result();
		$MainMenu = '<div class="menu-main">';
		foreach($Result as $MenuLink)
		{
			$CntSubMenu = CountAdminSubMenu($MenuLink->menuID);
			
			if($CntSubMenu>0) { $Class="sub-menu";$Href=''; } 
			else { $Class="mt";$Href=$MenuLink->location;}
			
			$MainMenu .= '<div>'.anchor($Href,$MenuLink->menu_name);
			if($Class=="sub-menu")
			{
				$MainMenu .= AdminSidebarSubMenu($MenuLink->menuID); //INCLUDE SUB MENU
			}
			
		$MainMenu .= '</div>';	
		}
		$MainMenu .= '</div>';
		return $MainMenu;
	}
	
}
if ( ! function_exists('AdminSidebarSubMenu'))
{
	function AdminSidebarSubMenu($menuID)
	{
		
		$CI =& get_instance();
		$CI->db->select('menuID,location,menu_name,parent');
		$CI->db->from($CI->config->item('menu_table'));	
		$CI->db->where('status','1');
		$CI->db->where('parent',$menuID);
		$CI->db->where('display','1');
		$CI->db->order_by("order_no", "ASC"); 
		$Query = $CI->db->get();
		$Result = $Query->result();
		
		$SubMenu = '<div class="menu-sub">';
		foreach($Result as $MenuLink)
		{
			$SubMenu .= '<div>'.anchor($MenuLink->location,$MenuLink->menu_name).'</div>';
		}
		$SubMenu .= '</div>';
		return $SubMenu;
	}
	
}
if ( ! function_exists('CountAdminSubMenu'))
{
	function CountAdminSubMenu($menuID)
	{
		
		$CI =& get_instance();
		$CI->db->select('menuID');
		$CI->db->from($CI->config->item('menu_table'));	
		$CI->db->where('status','1');
		$CI->db->where('parent',$menuID); 
		$Query = $CI->db->get();
		$Count = $Query->num_rows();
		return $Count;
	}
	
}




/* End of file menu_helper.php */
/* Location: ./system/helpers/url_helper.php */