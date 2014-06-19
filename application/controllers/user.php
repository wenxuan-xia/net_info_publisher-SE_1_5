<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* user控制器
* 处理和用户部分相关的界面
*/
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
	 
	 /**
	 * 默认函数
	 * 直接调用登陆函数，进入登陆界面
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->login();
	}

	/**
	 * 登陆函数
	 * 若已登录，直接进入主界面；未登录则进入登陆界面
	 */
	public function login()
	{
		$this->load->model('usermodule','users');	//载入usermodule，别名为usres
		$this->load->helper(array('form', 'url'));  //会使用到form与url辅助函数
  		$this->load->library(array('form_validation', 'usermanager')); //会使用到表单验证类库（框架自带）与用户管理类库（自定义）
  		
		$name = $this->input->post('username', TRUE); //获取post信息，之后使用
		$pw = $this->input->post('password', TRUE);
		
		$this->load->view("html_header");	//载入划分的html页面头
			
		if (($name == FALSE) && ($pw == FALSE)) {	//判断页面是否为post提交表单状态
			if (!$this->usermanager->if_login()){	//非post表单提交时，调用自定义类库中的登录判断函数，判断用户是否已经登录
				$this->load->view("header/visiter_header");	//未登录则显示visiter顶部导航
				$this->load->view("user/login");	//登录界面
			}else { //用户此前已登录且未退出
				$this->users->keeplink();	//刷新数据库token状态，保持连接
				$this->load->view("header/user_header");	//载入user顶部导航
			//	$this->load->view("main/main");
			}
		} else { //登陆信息提交
			$this->form_validation->set_rules('username', '用户名', 'required|min_length[6]|max_length[32]|alpha_dash');	//表单验证
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header"); //重新显示登录页面，并输出错误信息
				$this->load->view("user/login");
			} else {//验证无误
				$res=$this->users->login($name,$pw);	//登录，调用model中的登录函数，进行相关数据库操作
				if ($res == FALSE) {	//登录失败
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
		
		$this->load->view("html_footer");	//载入html尾部，补全html结构
	}
	
	/**
	 * 登出函数
	 * 用户登出
	 */
	public function logout()
	{
		$this->load->model('usermodule','users');	//相关初始化
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);
		$pw = $this->input->post('password', TRUE);
		
		$this->load->view("html_header");
			
		if (($id = $this->usermanager->if_login())!=FALSE){	//判断是否登录
			$this->users->logout($id);		//若当前为登录状态，则登出。调用model的登出函数，进行数据库相关操作
		}
		$this->load->view("header/visiter_header");
		$this->load->view("user/login");	//重新进入登陆页面
		$this->load->view("html_footer");
	}
	
	public function register(){
	
		$this->load->model('usermodule','users');	//相关初始化
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$name = $this->input->post('username', TRUE);	//获取post&get信息
		$pw = $this->input->post('password', TRUE);
		$repw = $pw = $this->input->post('repassword', TRUE);	
		$email = $this->input->post('email', TRUE);	
		
		$this->load->view("html_header");
	
		if (($name == FALSE) && ($pw == FALSE)) {	//若为初次打开页面（普通的get方法）
			$this->load->view("header/visiter_header");
			$this->load->view("user/register");	//正常注册页面
			$this->load->view("html_footer");
		} else { //注册信息提交
			$this->form_validation->set_rules('username', '用户名', 'required|min_length[6]|max_length[32]|alpha_dash');	//表单验证规则设置
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[repassword]');
			$this->form_validation->set_rules('repassword', '密码确认', 'required');
			$this->form_validation->set_rules('email', '邮箱', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("header/visiter_header");
				$this->load->view("user/register");	//显示错误信息
			} else {//验证无误
				$res=$this->users->insert_user($name,$pw,$email);	//调用model中的登录函数，将用户信息尝试写入数据库中
				if ($res!=FALSE){	//判断返回结果
					$data['words'] = "注册成功！";
					$this->load->view("header/user_header");
					$this->load->view("user/success",$data);
				} else{
					$data['words'] = "注册失败，该用户名已存在";	//设置错误页面
					$data['url'] = "/index.php/register";
					$data['returnstr'] = "重新注册";
					$this->load->view("header/visiter_header");
					$this->load->view("user/fail",$data);
				}

			}
		}
		$this->load->view("html_footer"); //补全html结构
	}
	
	/**
	 * 忘记密码函数
	 * 处理用户忘记密码时的相关操作与页面
	 */
	public function passwordforget(){
	
		$this->load->model('usermodule','users');	//初始化
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
				$this->load->view("user/password_forget"); //输出错误信息
			} else {//验证无误
					$res=$this->users->reset_password_by_email($name,$email); //调用model中的相关函数，进行相关数据操作
				if ($res!=FALSE){
					if ($res === "wrong"){	//若发送邮件失败
						$this->load->view("html_header");
						$this->load->view("header/user_header");
						$data['words'] = "发送失败,请重试";	//设置错误页面
						$data['url'] = "/index.php/user/passwordforget";
						$data['returnstr'] = "返回";
						$this->load->view("header/user_header");
						$this->load->view("user/fail",$data);
					} else {
						$data['words'] = "邮件已发送到邮箱，请查收！";	//成功页面
						$this->load->view("header/visiter_header");
						$this->load->view("user/success",$data);
					}
				} else{	//用户提交信息有误
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
	
	/**
	 * 密码重置函数
	 * 处理用户重置密码的相关请求
	 */
	public function reset(){
	
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
  		
		$type = $this->input->post('submit', TRUE);	//获取post数据
		if ($type != FALSE){	//若存在相关post数据，表明是提交重置密码表单
			$password = $this->input->post('password', TRUE);	
			$token = $this->input->post('token', TRUE);
			$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[repassword]');
			$this->form_validation->set_rules('repassword', '密码确认', 'required');
			if ($this->form_validation->run() == FALSE){//信息存在问题
				$this->load->view("html_header");
				$this->load->view("header/visiter_header"); //输出错误信息
				$data['token']=$token;
				$this->load->view("user/reset",$data);
				$this->load->view("html_footer");
			} else {
				$id = $this->users->reset_password_by_token($token);	//表单数据无误，调用model中相关函数重置密码
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
			return TRUE; //结束页面处理逻辑
		}
		
		$token = $this->input->get('token', TRUE);	//若是第一次登陆该页面，获取携带的token
		$this->load->view("html_header");
		$this->load->view("header/visiter_header");
		if (($token != FALSE) && ($this->users->reset_password_by_token($token) != FALSE)){ //检验token
			$data['token']=$token;	//若token有效，显示重置密码页面
			$this->load->view("user/reset",$data);
		} else {	//若token无效（过期或不存在）
			$this->load->view("user/invalid");	//显示链接失效提示页面
		}
		$this->load->view("html_footer");
	}
	
	/**
	 * 显示信息函数
	 * 显示用户个人信息，并允许用户修改
	 */
	public function message(){
		$this->load->model('usermodule','users');
		$this->load->helper(array('form', 'url'));
  		$this->load->library(array('form_validation', 'usermanager'));
			
		if (!($id = $this->usermanager->if_login())){ //需要先登录，若未登录则跳转到登陆函数
			$this->login();
		}else {
			$type = $this->input->post('submit', TRUE);
			if ($type == FALSE){	//若为初次打开页面（普通的get方法）
				$message = $this->users->get_user($id);	//从model中获取当前用户个人
				$data['email'] = $message->email;
  				$data['realname'] = $message->realname;
				$data['permission'] = $message->permission;
				$this->load->view("html_header");
				$this->load->view("header/user_header");
				$this->load->view("user/message",$data);	//显示用户信息界面
				$this->load->view("html_footer");
			} else {
				$pw = $this->input->post('password', TRUE);	//获取提交的表单数据
				$newpw = $this->input->post('newpassword', TRUE);
				$renewpw = $this->input->post('renewpassword', TRUE);
				$email = $this->input->post('email', TRUE);
				$realname = $this->input->post('name');
				if (($newpw!=FALSE) && ($newpw!="")){	//若提交了新的密码，进入密码重置逻辑
					$this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[32]|alpha_dash'); //表单验证
					$this->form_validation->set_rules('newpassword', '新密码', 'required|min_length[6]|max_length[32]|alpha_dash|matches[renewpassword]');
					$this->form_validation->set_rules('renewpassword', '新密码确认', 'required');
					if ($this->form_validation->run() == FALSE){//信息存在问题
						$this->load->view("html_header");
						$this->load->view("header/user_header");
						$message = $this->users->get_user($id);
						$data['email'] =$email;	//数据恢复
  						$data['realname'] = $realname;
						$data['permission'] = $message->permission;
						$this->load->view("user/message",$data); //提示错误信息
						$this->load->view("html_footer");
					} else {
						if ($this->users->reset_password_check($id,$pw,$newpw)===TRUE){	//若数据无误，重置密码
							$data['words'] = "重置密码成功";
							$this->load->view("html_header");
							$this->load->view("header/user_header");
							$this->load->view("user/success",$data);
							$this->load->view("html_footer");
						} else {
							$this->load->view("html_header");	//重置密码失败，输出提示信息
							$this->load->view("header/user_header");
							$data['words'] = "密码错误！";
							$data['url'] = "/index.php/user/message";
							$data['returnstr'] = "返回";
							$this->load->view("header/user_header");
							$this->load->view("user/fail",$data);
							$this->load->view("html_footer");
						}
					}
					return TRUE;	//结束密码重置逻辑
				}
				$this->form_validation->set_rules('email', '邮箱', 'required|valid_email'); //检验邮箱格式
				if ($this->form_validation->run() == FALSE){
					$this->load->view("html_header");	//表单信息有误，输出错误提示
					$this->load->view("header/user_header");
					$message = $this->users->get_user($id);
					$data['email'] =$email;
  					$data['realname'] = $realname;
					$data['permission'] = $message->permission;
					$this->load->view("user/message",$data);
					$this->load->view("html_footer");
				} else {
					if ($this->users->update_user($id, $email, $realname)===TRUE){ //表单信息无误，保存用户新填入数据信息
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
	
	/**
	 * 添加搜索记录函数
	 * 添加新的搜索记录
	 */
	public function add_search_log() {	//添加新的搜索记录
		$info = $this->input->get();
		$this->load->model('usermodule', '', TRUE);
		$this->usermodule->add_search_log($info['uid'], $info['stock_id'], $info['stock_name']); //调用model相关函数
	}

	/**
	 * 获取搜索记录的api函数
	 * 返回json格式的结果
	 */
	public function load_search_logs() {	
		$info = $this->input->get();
		$this->load->model('usermodule', '', TRUE);
		$result = $this->usermodule->load_search_logs($info['uid']);
		echo json_encode($result);
	}

	/**
	 * 显示搜索记录函数
	 * 
	 */
	public function searchlog()
	{
		$this->showlogs("search");
	}
	
	/**
	 * 显示收藏记录函数
	 * 以列表形式显示收藏记录
	 */
	public function storelog()
	{
		$this->showlogs("store");
	}
	
	/**
	 * 显示记录函数
	 * 显示各类记录
	 */
	private function showlogs($type){
		$this->load->model('usermodule','users');	//初始化载入相关模块
		$this->load->library('usermanager');
		if (!($id = $this->usermanager->if_login())){ //未登录
			$this->login();
		}else {
			$this->load->view("html_header");
			$this->load->view("header/user_header");
			if ($type == "search"){	//显示搜索记录
				$res = $this->users->get_log($id);
				$data['log'] = $res;
				$this->load->view("user/searchlog",$data);
			} else if ($type == "store"){ //显示收藏记录
				$res = $this->users->get_store($id);
				$data['log'] = $res;
				$this->load->view("user/storelog",$data);
			}
			
			$this->load->view("html_footer");
		}		
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */