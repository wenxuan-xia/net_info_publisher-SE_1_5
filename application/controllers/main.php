<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->library(array('form_validation', 'usermanager'));
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->load->view("html_header");
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {
			$this->load->model('userpermissionmodule','permission');
			$permission = $this->permission->check($id);
			$data['permission'] = $permission;
			$this->load->view("html_header", $data);
			$this->load->view("header/user_header");
			$this->load->view("main/main_display");
			$this->load->view("html_footer");
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */