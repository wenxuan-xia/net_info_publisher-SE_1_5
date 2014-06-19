<?php 

/**
* user permission MODLE
* 处理和用户权限（充值）部分相关的数据操作
*/
class UserPermissionmodule extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

	/**
	 * add函数
	 * 参数：用户ID，天数（金额），充值所用手机号
	 * 返回值：TRUE
	 * 作用：用户充值后修改用户权限，添加充值记录
	 */
    function add($id,$day,$phone){
		$this->db->select('id')->from('users')->where('permission > ', date("Y-m-d H:i:s",time()))->where('id' , $id);
    	$query = $this->db->get(); //检测该用户是否已是会员
    	if ($query->num_rows()>0){ //若已经是会员
    		$sql = "update users set permission = ADDDATE(permission,interval ? day)  where id = ?"; //增加用户余额
    	} else {
			$sql = "update users set permission = ADDDATE(CURRENT_TIMESTAMP,interval ? day)  where id = ?"; //若之前不是付费用户，则以充值时间起为用户计算剩余金额（时间）
		}
		$this->db->query($sql, array($day, $id)); 
        $this->db->set('userid', $id); 
        $this->db->set('amount', $day); 
        $this->db->set('phone', $phone); 
       	$query =  $this->db->insert('rechargelog'); // 添加充值记录
       	return TRUE;
    }
	
	/**
	 * check函数
	 * 参数：用户ID
	 * 返回值：TRUE/FALSE
	 * 作用：检查某用户是否有高级权限
	 */
	function check($id){ 
		$this->db->select('id')->from('users')->where('permission > ', date("Y-m-d H:i:s",time()))->where('id',$id);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		return TRUE;
    	}
    	return FALSE;
    }
    
	/**
	 * get_log函数
	 * 参数：用户ID
	 * 返回值：log数据
	 * 作用：查询用户充值记录
	 */
    function get_log($id){
    	$query = $this->db->get_where('rechargelog', array('userid' => $id));
    	$res = $query->result();
    	return $res;
    }

}?>