<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {
    //主要功能：模拟外接口的信息传递
    public function  __construct()
    {
        parent::__construct();
    }
    
    public function search_id($stock_id) {
        //用stock_id获取股票metadata
        $this->db->like("stock_id", $stock_id);
        $query = $this->db->get("stock_meta");
        echo json_encode($query->result());
    }

    public function search_name($stock_name) {
        //用stock_name获取股票metadata
        $this->db->like("stock_name", $stock_name);
        $query = $this->db->get("stock_meta");
        echo json_encode($query->result());
    }
}

?>