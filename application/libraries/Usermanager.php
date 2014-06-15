<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * 自定义类库 用户管理
// ------------------------------------------------------------------------

/**
 * CodeIgniter User Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Jennings Wu
 */

class Usermanager {

    public function __construct()
    {
        
    }
	
	public function if_login(){
		//return FALSE;
		
		$CI =& get_instance();
		$token = $CI->session->userdata('token');
		if ($token == FALSE) return false;
		$sql = "SELECT id FROM userlogin WHERE token = ?";
		$query = $CI->db->query($sql, array($token));
		if ($query->num_rows() > 0) {
			$CI->load->model('usermodule','users');
			$CI->users->keeplink();
			$res = $query->result();
			return $res[0]->id;
		} else 
		return FALSE;
	}
	
	public function keeplink(){
		$CI =& get_instance();
		$token = $CI->session->userdata('token');
		$sql = "UPDATE userlogin SET countnum = countnum + 1 WHERE token = ?";
		$query = $CI->db->query($sql, array($token));
		return TRUE;
	}
}

/* End of file cookie_helper.php */
/* Location: ./system/helpers/cookie_helper.php */