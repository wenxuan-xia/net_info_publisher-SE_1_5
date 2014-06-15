<?php 

class UserPermissionmodule extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    function add($id,$day,$phone){
		$this->db->select('id')->from('users')->where('permission > ', date("Y-m-d H:i:s",time()))->where('id' , $id);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		$sql = "update users set permission = ADDDATE(permission,interval ? day)  where id = ?";
    	} else {
			$sql = "update users set permission = ADDDATE(CURRENT_TIMESTAMP,interval ? day)  where id = ?";
		}
		$this->db->query($sql, array($day, $id)); 
        $this->db->set('userid', $id); 
        $this->db->set('amount', $day); 
        $this->db->set('phone', $phone); 
       	$query =  $this->db->insert('rechargelog');
       	return TRUE;
    }
	
	function check($id){
		$this->db->select('id')->from('users')->where('permission > ', date("Y-m-d H:i:s",time()))->where('id',$id);
    	$query = $this->db->get();
    	if ($query->num_rows()>0){
    		return TRUE;
    	}
    	return FALSE;
    }
    
    function get_log($id){
    	$query = $this->db->get_where('rechargelog', array('userid' => $id));
    	$res = $query->result();
    	return $res;
    }

}?>