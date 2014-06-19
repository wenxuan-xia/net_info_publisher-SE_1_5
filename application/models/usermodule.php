<?php 

/**
* user MODLE
* 处理和用户部分相关的数据操作
*/
class Usermodule extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	
    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }
	
	 /**
	 * get_user函数
	 * 参数：用户ID
	 * 返回值：用户数据/FALSE
	 */
    function get_user($id){
    	$query = $this->db->get_where('users', array('id' => $id)); //sql操作
    	if ($query->num_rows()>0){	//若取到了数据
    		$res = $query->result();
    		return $res[0];	//返回第一组记录（id为primary key，也只可能有一组记录）
    	}
    	return FALSE;
    }
    
	 /**
	 * login函数
	 * 参数：用户名，密码
	 * 返回值：登陆token（登陆成功）/FALSE（登录失败）
	 */
    function login($name,$password){
    	$this->db->select('id')->from('users')->where('name', $name)->where('password', md5($password)); //数据库操作,验证用户名密码是否成功
    	$query = $this->db->get();
    	if ($query->num_rows()>0){	//存在该用户名与密码
    		$this->load->helper('string');
    		$res = $query->result();
    		$id = $res[0]->id;
    		$token = random_string('alnum',32);	//随机生成32位token
    		$data = array(
               'id' => $id ,
               'token' => $token ,
            );
        	$query =  $this->db->insert('userlogin', $data); //将用户登录信息储存
        	$sesdata = array('token' => $token);
        	$this->session->set_userdata($sesdata); //设置用户登陆token的session
        	return $token;
    	}
    	return FALSE; //登录失败，返回FALSE
    }
    
	 /**
	 * logout函数
	 * 参数：用户ID
	 * 返回值：TRUE
	 */
    function logout($id){
    	$token = $this->session->userdata('token');
		$this->db->delete('userlogin', array('id' => $id,'token'=>$token)); //清除用户登陆时储存在数据库中的信息
    	$this->session->unset_userdata('token'); //销毁用户session
    	return TRUE;
    }
    
	 /**
	 * insert_user函数
	 * 参数：用户ID
	 * 返回值：用户登陆返回值/FALSE（用户名重名）
	 * 作用：用户注册相关的数据操作，注册后默认登陆
	 */
    function insert_user($name,$password,$email) //返回插入的信息数组
    {
    	$query = $this->db->get_where('users', array('name' => $name)); //检查数据库中是否有重名表
    	if ($query->num_rows()>0) //存在重名
    		return FALSE;
 
		$md5pw = md5($password); //密码md5加密
		$data = array(
               'name' => $name ,
               'password' => $md5pw ,
               'email' => $email
            );
        $query =  $this->db->insert('users', $data); //在数据库users表中插入用户信息
        return $this->login($name,$password); //自动登录
    }
    
    
	 /**
	 * reset_password_by_email函数
	 * 参数：用户名，邮箱
	 * 返回值：TRUE（成功）/FALSE（失败）/"wrong"（用户名邮箱错误）
	 * 作用：用户注册相关的数据操作
	 */
    function reset_password_by_email($name,$email){
    	$this->db->select('id')->from('users')->where('name', $name)->where('email', $email);
    	$query = $this->db->get(); //获取对应用户名与邮箱的用户
    	if ($query->num_rows()>0){ //判断该用户是否存在
    		$this->load->library('email');	//载入email类库
    	
    		$res = $query->result();
    		$id = $res[0]->id; //获取用户ID
    		$valid_time = date("Y-m-d H:i:s",strtotime("+1 day")); //设置密码重置token有效期
    		$url_token = random_string('alnum',32); //随机生成32位token
			$this->db->select('id')->from('reset_url')->where('id', $id); //检测是否已有该用户的密码重置信息
			$query = $this->db->get();
			if ($query->num_rows()>0){ //若已经存在
				$this->db->set('urltoken', $url_token); 
            	$this->db->set('validtime', $valid_time);
				$this->db->where('id', $id);
       	 		$this->db->update('reset_url'); //更新用户密码重置记录（token覆盖）
			} else {
				$this->db->set('id', $id);  //若不存在
				$this->db->set('urltoken', $url_token); 
				$this->db->set('validtime', $valid_time); 
				$query =  $this->db->insert('reset_url'); //插入记录
			}
       	 	$config['protocol'] = 'smtp'; //初始化邮箱相关配置。使用126邮箱
			$config['smtp_host'] = 'smtp.126.com';  
			$config['smtp_user'] = 'se_1_5';  
			$config['smtp_pass'] = 'net_info';  
			$config['smtp_port'] = '25';  
			$config['charset'] = 'utf-8';  
			$config['wordwrap'] = TRUE;		
			$config['mailtype'] = 'html';
			$res = $this->email->initialize($config);
       	 	$this->email->from('se_1_5@126.com', 'se_1_5');
			$this->email->to($email);
			$this->email->subject('密码重置');
			$msg = "<p>你好</p><p>你请求重置你在se_1_5网站账户的密码。</p><p>如果你没有发过该请求，请忽视本邮件。请勿回复本邮件。</p><p>如果你确实发过该请求，请点击以下链接重置密码</p> <p><a href='http://127.0.0.1/index.php/user/reset?token=".$url_token."'>密码重置</a></p><p>或将下面的链接手动复制到浏览器地址栏中</p><p>http://127.0.0.1/index.php/user/reset?token=".$url_token."</p>";
			$send_msg = str_replace("\"", "", $msg);
			$this->email->message($send_msg);
    		return $this->email->send();
    	} else { //用户不存在，表明用户名、邮箱错误，返回"wrong"
			return "wrong";
		}

    }
    
	 /**
	 * reset_password_check函数
	 * 参数：用户ID，原密码，新密码
	 * 返回值：TRUE（成功）/FALSE（失败）
	 * 作用：用户注册相关的数据操作
	 */
	function reset_password_check($id,$password,$newpassword){
    	$this->db->select('id')->from('users')->where('id', $id)->where('password',  md5($password)); //检查用户输入密码是否正确
    	$query = $this->db->get();
    	if ($query->num_rows()>0){ //若密码正确，更新密码为新密码
    		$this->db->set('password',md5($newpassword)); 
    		$this->db->where('id', $id);
    		$this->db->update('users');
     		if ($this->db->affected_rows()==0) //判断是否更新失败
     			return FALSE;
     		else return TRUE;
    	}
    	return FALSE;
    }
    
	/**
	 * reset_password函数
	 * 参数：用户ID，新密码，重置密码token
	 * 返回值：TRUE
	 * 作用：用户忘记密码通过邮箱重置时的数据操作函数
	 */
	function reset_password($id,$password,$token){ 
    	$this->db->set('password', md5($password)); //重置密码
    	$this->db->where('id', $id);
    	$this->db->update('users');
    	$this->db->delete('reset_url', array('id' => $id,'urltoken'=>$token));  //删除已使用token
    	return TRUE;
    }
    
	/**
	 * reset_password_by_token函数
	 * 参数：重置密码token
	 * 返回值：用户ID（成功）/FALSE（失败）
	 * 作用：查询是否存在对应该token的用户
	 */
	function reset_password_by_token($token){ 
    	$this->db->select('id')->from('reset_url')->where('urltoken', $token); //数据库查询
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		$res = $query->result();
     		return $res[0]->id;
    	}
    	return FALSE;
    }
    
	/**
	 * keeplink函数
	 * 参数：无
	 * 返回值：无
	 * 作用：刷新用户当前登录token的时间
	 */
    function keeplink(){ //保持连接
    	$this->load->library('usermanager'); 
    	$this->usermanager->keeplink(); //调用自定义类库中的保持链接函数
    }
    
	/**
	 * update_user函数
	 * 参数：用户ID，邮箱，真名
	 * 返回值：TRUE
	 * 作用：更新对应用户数据
	 */
    function update_user($id,$email,$realname){
      	$this->db->set('email',$email); 
    	$this->db->set('realname', $realname);
		$this->db->where('id', $id);
     	$this->db->update('users');
     //	if ($this->db->affected_rows()==0)
     //		return FALSE;
     //	else 
     	return TRUE;
    }
    
	/**
	 * get_log函数
	 * 参数：用户ID
	 * 返回值：数据
	 * 作用：查询该用户的搜索记录
	 */
    function get_log($id){
    	$query = $this->db->get_where('searchlog', array('userid' => $id));
    	$res = $query->result();
    	return $res;
    }
    
	/**
	 * get_log函数
	 * 参数：用户ID
	 * 返回值：数据
	 * 作用：查询该用户的收藏记录
	 * ！！！ 未完成
	 */
	function get_store($id){
    	$query = $this->db->get_where('searchlog', array('userid' => $id));
    	$res = $query->result();
    	return $res;
    }

	/**
	 * add_search_log函数
	 * 参数：用户ID，股票ID，股票名称
	 * 返回值：无
	 * 作用：添加搜索记录
	 */
    function add_search_log($uid, $stock_id, $stock_name) {
        if ($stock_name == "") return; //若股票名为空，函数返回。
        $this->db->where("userid", $uid);
        $this->db->where("code", $stock_id);
        $this->db->where("name", $stock_name);
        $query = $this->db->get("searchlog"); //检测是否已存在相同内容的搜索记录

        if ($query->num_rows() == 0) {
            $this->db->set("userid", $uid);
            $this->db->set("code", $stock_id);
            $this->db->set("name", $stock_name);
            $this->db->insert("searchlog");
        } else {
            $this->db->where("userid", $uid);
            $this->db->where("code", $stock_id);
            $this->db->where("name", $stock_name);
            $this->db->delete("searchlog");
            $this->db->set("userid", $uid);
            $this->db->set("code", $stock_id);
            $this->db->set("name", $stock_name);
            $this->db->insert("searchlog");
        }
    }

	/**
	 * load_search_logs函数
	 * 参数：用户ID
	 * 返回值：数据
	 * 作用：返回该用户的搜索记录
	 */
    function load_search_logs($uid) {
        $query = $this->db->query(
            "SELECT searchlog.code, stock_meta.stock_name, searchlog.attime 
            FROM searchlog, stock_meta 
            WHERE searchlog.userid = " .$uid. " AND searchlog.code = stock_meta.stock_id  
            ORDER BY searchlog.attime DESC LIMIT 0,10"); //返回最新10条
        $result = $query->result();
        return $result;
    }
}?>