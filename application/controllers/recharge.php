<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* recharge控制器
* 处理用户充值相关逻辑
*/
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
	 
	 
	/**
	* 默认函数
	* 默认调用此函数
	*/
	public function index()
	{
		$this->load->model('userpermissionmodule','permission');	//初始化，载入用户权限model
		$this->load->helper(array('form', 'url'));	//载入表单与url处理相关辅助函数
  		$this->load->library(array('form_validation', 'usermanager'));	//载入表单验证类库（框架自带类库）与用户类库（自定义类库）
			
		if (!($id = $this->usermanager->if_login())){ //调用自定义类库中的登录判断函数，判断用户是否已经登录
			$this->load->view("html_header");	//未登录时载入登陆页面
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {	//用户已登录
			$type = $this->input->post('submit', TRUE); 
			if ($type == FALSE){	//无相关post数据，第一次载入页面
			//	$message = $this->users->get_user($id);
				$this->load->view("html_header");	//显示充值页面
				$this->load->view("header/user_header");
				$this->load->view("recharge/main");
				$this->load->view("html_footer");
			} else {	//用户提交表单
				$phone = $this->input->post('phone', TRUE);
				$this->form_validation->set_rules('phone', '手机号', 'required|min_length[11]|max_length[11]|numeric');
				if ($this->form_validation->run() == FALSE){//表单验证失败，信息存在问题
					$this->load->view("html_header");
					$this->load->view("header/user_header");
					$this->load->view("recharge/main");	//显示错误提示
					$this->load->view("html_footer");
				} else {	//表单验证成功
					$this->permission->add($id,30,$phone);	//调用用户权限model中的函数，进行充值相关的数据操作
					$data['words'] = "充值成功";
					$this->load->view("html_header");
					$this->load->view("header/user_header");
					$this->load->view("user/success",$data);
					$this->load->view("html_footer");
				}
			}
		}		
	}
	
	/**
	* log函数
	* 显示用户充值记录
	*/
	public function log()	
	{
		$this->load->model('userpermissionmodule','permission');
		$this->load->library('usermanager');
		if (!($id = $this->usermanager->if_login())){ //通过自定义类库中的if_log函数判断用户是否登录
			$this->load->view("html_header");	//未登录则显示用户登陆界面
			$this->load->view("header/visiter_header");
			$this->load->view("user/login");
			$this->load->view("html_footer");
		}else {	//已登录
			$res = $this->permission->get_log($id);//从用户权限model中获取用户相关充值记录
			$data['log'] = $res; //储存数据
			$this->load->view("html_header");
			$this->load->view("header/user_header");
			$this->load->view("recharge/log",$data);//显示界面
			$this->load->view("html_footer");
			
		}		
	}


	
	
}

/* End of file recharge.php */
/* Location: ./application/controllers/recharge.php */