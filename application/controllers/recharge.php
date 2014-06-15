<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recharge extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('userpermissionmodule','permission');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
			
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->load->view("html_header");
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {
			$type = $this->input->post('submit', TRUE);
			if ($type == FALSE){
			//	$message = $this->users->get_user($id);
				$this->load->view("html_header");
				$this->load->view("header/user_header");
				$this->load->view("recharge/main");
				$this->load->view("html_footer");
			} else {
				$phone = $this->input->post('phone', TRUE);
				$this->form_validation->set_rules('phone', 'Phone', 'required|min_length[11]|max_length[11]|numeric');
				if ($this->form_validation->run() == FALSE){//信息存在问题
					$this->load->view("wrong message");
				} else {
					
					$this->load->view($this->permission->add($id,30,$phone));
					/*	if ($this->users->reset_password($id,$pw,$newpw)===TRUE){
							$this->load->view("reset success");
						} else {
							$this->load->view("reset failed");
						}*/
				}
			}
		}		
	}
	
	public function log()
	{
		$this->load->model('userpermissionmodule','permission');
		$this->load->library('usermanager');
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->load->view("html_header");
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {
			$res = $this->permission->get_log($id);
			$data['log'] = $res;
			$this->load->view("html_header");
			$this->load->view("header/user_header");
			$this->load->view("recharge/log",$data);
			$this->load->view("html_footer");
			
		}		
	}


	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */