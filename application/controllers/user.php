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
			//	$this->load->view("main/main");
			}
		} else { //登陆信息提交
			$this->form_validation->set_rules('username', '用户名', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/login");
			} else {//验证无误
				$res=$this->users->login($name,$pw);
				if ($res == FALSE) {
					$data['words'] = "用户名密码错误！";
					$data['url'] = "/index.php/login";
					$data['returnstr'] = "重新登陆";
					$this->load->view("header/visiter_header");
					$this->load->view("user/fail",$data);
				} else {
					$data['words'] = "登陆成功！";
					$this->load->view("header/user_header");
					$this->load->view("user/success",$data);
				}
			}
		}
		
		$this->load->view("html_footer");
	}
	
	public function logout()
	{
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);
		$pw = $this->input->post('password', TRUE);
		
		$this->load->view("html_header");
			
		if (($id = $this->usermanager->if_login())!=FALSE){
			$this->users->logout($id);	
		}
		$this->load->view("header/visiter_header");
		$this->load->view("user/login");		
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
			$this->form_validation->set_rules('username', '用户名', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[repassword]');
			$this->form_validation->set_rules('repassword', '密码确认', 'required');
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/register");
			} else {//验证无误
				$res=$this->users->insert_user($name,$pw,$email);
				if ($res!=FALSE){
					$data['words'] = "注册成功！";
					$this->load->view("header/user_header");
					$this->load->view("user/success",$data);
				} else{
					$data['words'] = "注册失败，该用户名已存在";
					$data['url'] = "/index.php/register";
					$data['returnstr'] = "重新注册";
					$this->load->view("header/visiter_header");
					$this->load->view("user/fail",$data);
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
		} else { //忘记密码信息提交
			$this->form_validation->set_rules('username', '用户名', 'required|min_length[6]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/password_forget");
			} else {//验证无误
					$res=$this->users->reset_password_by_email($name,$email);
				if ($res!=FALSE){
					$data['words'] = "邮件已发送到邮箱，请查收！";
					$this->load->view("header/visiter_header");
					$this->load->view("user/success",$data);
				} else{
					$this->load->view("html_header");
					$this->load->view("header/user_header");
					$data['words'] = "用户名/邮箱错误！";
					$data['url'] = "/index.php/user/passwordforget";
					$data['returnstr'] = "返回";
					$this->load->view("header/user_header");
					$this->load->view("user/fail",$data);
				}
			}
		}
		$this->load->view("html_footer");
	}
	
	public function reset(){
	
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$type = $this->input->post('submit', TRUE);
		if ($type != FALSE){
			$password = $this->input->post('password', TRUE);
				$token = $this->input->post('token', TRUE);
				$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[repassword]');
				$this->form_validation->set_rules('repassword', '密码确认', 'required');
				if ($this->form_validation->run() == FALSE){//信息存在问题
					$this->load->view("html_header");
					$this->load->view("header/visiter_header");
					$data['token']=$token;
					$this->load->view("user/reset",$data);
					$this->load->view("html_footer");
				} else {
					$id = $this->users->reset_password_by_token($token);
					$this->load->view("html_header");
					$this->load->view("header/visiter_header");
					if ($id==FALSE){
						$this->load->view("user/invalid");
					} else {
						$this->users->reset_password($id,$password,$token);
						$data['words'] = "重置密码成功！";
						$this->load->view("user/success",$data);
					}
					$this->load->view("html_footer");
				}
			return TRUE;
		}
		
		$token = $this->input->get('token', TRUE);
		$this->load->view("html_header");
		$this->load->view("header/visiter_header");
		if (($token != FALSE) && ($this->users->reset_password_by_token($token) != FALSE)){
			$data['token']=$token;
			$this->load->view("user/reset",$data);
		} else {
			$this->load->view("user/invalid");
		}
		$this->load->view("html_footer");
	}
	
	public function message(){
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
			
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->login();
		}else {
			$type = $this->input->post('submit', TRUE);
			if ($type == FALSE){
				$message = $this->users->get_user($id);
				$data['email'] = $message->email;
  				$data['realname'] = $message->realname;
				$data['permission'] = $message->permission;
				$this->load->view("html_header");
				$this->load->view("header/user_header");
				$this->load->view("user/message",$data);
				$this->load->view("html_footer");
			} else {
				$pw = $this->input->post('password', TRUE);
				$newpw = $this->input->post('newpassword', TRUE);
				$renewpw = $this->input->post('renewpassword', TRUE);
				$email = $this->input->post('email', TRUE);
				$realname = $this->input->post('name');
				if (($newpw!=FALSE) && ($newpw!="")){
					$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash');
					$this->form_validation->set_rules('newpassword', '新密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[renewpassword]');
					$this->form_validation->set_rules('renewpassword', '新密码确认', 'required');
					if ($this->form_validation->run() == FALSE){//信息存在问题
						$this->load->view("html_header");
						$this->load->view("header/user_header");
						$message = $this->users->get_user($id);
						$data['email'] =$email;
  						$data['realname'] = $realname;
						$data['permission'] = $message->permission;
						$this->load->view("user/message",$data);
						$this->load->view("html_footer");
					} else {
						if ($this->users->reset_password_check($id,$pw,$newpw)===TRUE){
							$data['words'] = "重置密码成功";
							$this->load->view("html_header");
							$this->load->view("header/user_header");
							$this->load->view("user/success",$data);
							$this->load->view("html_footer");
						} else {
							$this->load->view("html_header");
							$this->load->view("header/user_header");
							$data['words'] = "密码错误！";
							$data['url'] = "/index.php/user/message";
							$data['returnstr'] = "返回";
							$this->load->view("header/user_header");
							$this->load->view("user/fail",$data);
							$this->load->view("html_footer");
						}
					}
					return TRUE;
				}
				$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
				if ($this->form_validation->run() == FALSE){
					$this->load->view("html_header");
					$this->load->view("header/user_header");
					$message = $this->users->get_user($id);
					$data['email'] =$email;
  					$data['realname'] = $realname;
					$data['permission'] = $message->permission;
					$this->load->view("user/message",$data);
					$this->load->view("html_footer");
				} else {
					if ($this->users->update_user($id, $email, $realname)===TRUE){
						$data['words'] = "保存信息成功";
						$this->load->view("html_header");
						$this->load->view("header/user_header");
						$this->load->view("user/success",$data);
						$this->load->view("html_footer");
						//$this->load->view("header/ok,id:".$id.",email:".$email.",realname:".$realname);
					} else {
						$this->load->view("html_header");
						$this->load->view("header/user_header");
						$data['words'] = "密码错误！";
						$data['url'] = "/index.php/user/message";
						$data['returnstr'] = "返回";
						$this->load->view("header/user_header");
						$this->load->view("user/fail",$data);
						$this->load->view("html_footer");
					}
				}
			}
		}		
	}
	

	public function add_search_log() {
		$info = $this->input->get();
		$this->load->model('usermodule', '', TRUE);
		$this->usermodule->add_search_log($info['uid'], $info['stock_id'], $info['stock_name']);
	}

	public function load_search_logs() {
		$info = $this->input->get();
		$this->load->model('usermodule', '', TRUE);
		$result = $this->usermodule->load_search_logs($info['uid']);
		echo json_encode($result);
	}

	public function searchlog()
	{
		$this->showlogs("search");
	}
	
	public function storelog()
	{
		$this->showlogs("store");
	}
	
	private function showlogs($type){
		$this->load->model('usermodule','users');
		$this->load->library('usermanager');
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->load->view("html_header");
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {
			$this->load->view("html_header");
			$this->load->view("header/user_header");
			if ($type == "search"){
				$res = $this->users->get_log($id);
				$data['log'] = $res;
				$this->load->view("user/searchlog",$data);
			} else if ($type == "store"){
				$res = $this->users->get_store($id);
				$data['log'] = $res;
				$this->load->view("user/storelog",$data);
			}
			
			$this->load->view("html_footer");	
		}		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */