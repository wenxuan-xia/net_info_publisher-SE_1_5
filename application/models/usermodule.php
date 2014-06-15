<?php 

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

    function get_user($id){
    	$query = $this->db->get_where('users', array('id' => $id));
    	if ($query->num_rows()>0){
    		$res = $query->result();
    		return $res[0];
    	}
    	return FALSE;
    }
    
    function login($name,$password){
    	$this->db->select('id')->from('users')->where('name', $name)->where('password', $password);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		$this->load->helper('string');
    		$res = $query->result();
    		$id = $res[0]->id;
    		$token = random_string('alnum',32);
    		$data = array(
               'id' => $id ,
               'token' => $token ,
            );
        	$query =  $this->db->insert('userlogin', $data);
        	$sesdata = array('token' => $token);
        	$this->session->set_userdata($sesdata);
        	return $token;
    	}
    	return FALSE;
    }
    
    function insert_user($name,$password,$email) //返回插入的信息数组
    {
    	$query = $this->db->get_where('users', array('name' => $name));
    	if ($query->num_rows()>0)
    		return FALSE;
 
		$data = array(
               'name' => $name ,
               'password' => $password ,
               'email' => $email
            );
        $query =  $this->db->insert('users', $data);
        return $this->login($name,$password);
    }
    
    
    function reset_password_by_email($name,$email){
    	$this->db->select('id')->from('users')->where('name', $name)->where('email', $email);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		$this->load->library('email');
    	
    		$res = $query->result();
    		$id = $res[0]->id;
    		$valid_time = date("Y-m-d H:i:s",strtotime("+1 day"));
    		$url_token = random_string('alnum',32);
            $this->db->set('id', $id); 
            $this->db->set('urltoken', $url_token); 
            $this->db->set('validtime', $valid_time); 
       	 	$query =  $this->db->insert('reset_url');
       	 	if ($this->db->affected_rows()==0){
            	$this->db->set('urltoken', $url_token); 
            	$this->db->set('validtime', $valid_time);
				$this->db->where('id', $id);
       	 		$this->db->update('reset_url');
       	 	}
       	 	$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp.126.com';  
			$config['smtp_user'] = 'wujinning_c';  
			$config['smtp_pass'] = '*******';  
			$config['smtp_port'] = '25';  
			$config['charset'] = 'utf-8';  
			$config['wordwrap'] = TRUE;		
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			
       	 	$this->email->from('wujinning_c@126.com', 'Jennings Wu');
			$this->email->to($email);
			$this->email->subject('密码重置');
			$msg="你好,\n你请求重置你在se_1_5网站账户的密码.\n\n如果你没有发过该请求，请忽视本邮件。请勿回复本邮件。\n\n如果你确实发过该请求，请点击以下链接重置密码\nhttp://127.0.0.1/index.php/user/reset?token=".$url_token;
			$send_msg = str_replace("\"", "", $msg);
			$this->email->message($send_msg);
			$this->email->send();
    		return $email;
    	}
    	return FALSE;
    }
    
	function reset_password($id,$password,$newpassword){
    	$this->db->select('id')->from('users')->where('id', $id)->where('password', $password);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		$this->db->set('password',$newpassword); 
    		$this->db->where('id', $id);
    		$this->db->update('users');
     		if ($this->db->affected_rows()==0)
     			return FALSE;
     		else return TRUE;
    	}
    	return FALSE;
    }
    
    function keeplink(){
    	$this->load->library('usermanager');
    	$this->usermanager->keeplink();
    }
    
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

}?>