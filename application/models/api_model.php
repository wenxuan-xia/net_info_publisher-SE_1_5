<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function  __construct()
    {
        parent::__construct();
    }
    
    public function search_id($stock_id) {
        $this->db->like("stock_id", $stock_id);
        $query = $this->db->get("stock_meta");

        echo json_encode($query->result());
    }
}

?>