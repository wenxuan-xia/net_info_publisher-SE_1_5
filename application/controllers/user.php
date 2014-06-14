<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		//$this->load->view('welcome_message');
		$this->login();
	}

	public function login()
	{
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);
		$pw = $this->input->post('password', TRUE);
		
		$this->load->view("html_header");
			
		if (($name == FALSE) && ($pw == FALSE)) {
			if (!$this->usermanager->if_login()){
				$this->load->view("header/visiter_header");
				$this->load->view("user/login");
			}else { //用户此前已登录且未退出
				$this->users->keeplink();
				$this->load->view("header/user_header");
				$this->load->view("main/main");
			}
		} else { //登陆信息提交
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]|alpha_dash');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/false");
			} else {//验证无误
				$res=$this->users->login($name,$pw);
				if ($res == FALSE) {
					$this->load->view("header/visiter_header");
					$this->load->view("user/fail");
				} else {
					$this->load->view("header/user_header");
					$this->load->view("user/login_success");
				}
			}
		}
		
		$this->load->view("html_footer");
		
	}
	public function register(){
	
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);
		$pw = $this->input->post('password', TRUE);
		$repw = $pw = $this->input->post('repassword', TRUE);	
		$email = $this->input->post('email', TRUE);	
		
		$this->load->view("html_header");
	
		if (($name == FALSE) && ($pw == FALSE)) {
			$this->load->view("header/visiter_header");
			$this->load->view("user/register");
			$this->load->view("html_footer");
		} else { //注册信息提交
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('email', 'Eassword', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/fail");
			} else {//验证无误
				$res=$this->users->insert_user($name,$pw,$email);
				if ($res!=FALSE){
					$this->load->view("header/user_header");
					$this->load->view("user/success");
				} else{
					$this->load->view("header/visiter_header");
					$this->load->view("user/insertfailed");
				}

			}
		}
		$this->load->view("html_footer");
	}
	public function passwordforget(){
	
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);
		$email = $this->input->post('email', TRUE);	
		
		$this->load->view("html_header");
	
		if (($name == FALSE) && ($email == FALSE)) {
			$this->load->view("header/visiter_header");
			$this->load->view("user/password_forget");
			$this->load->view("html_footer");
		} else { //注册信息提交
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('email', 'Eassword', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/checkfail");
			} else {//验证无误
					$res=$this->users->reset_password_by_email($name,$email);
				if ($res!=FALSE){
					$this->load->view("header/user_header");
					$this->load->view("user/$res");
				} else{
					$this->load->view($name);
					$this->load->view($email);
				}

			}
		}
		$this->load->view("html_footer");
	}
	public function reset(){
	
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$token = $this->input->get('token', TRUE);
		
		$this->load->view("html_header");
		$this->load->view("header/visiter_header");
		if ($token != FALSE){
			$res=$this->users->reset_password($token);
			if ($res != FALSE){
				$this->load->view("header/reset/".$res);
			} else {
				$this->load->view("header/invalid");
			}
		} else {
			$this->load->view("header/invalid");
		}
		$this->load->view("html_footer");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */