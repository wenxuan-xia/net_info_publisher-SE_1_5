<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
		//it is for fun	
	}

	public function code_get_name()
	{
		$info = $this->input->get();
		$stock_id = $info['stock_id'];
		$this->load->model('api_model', '', TRUE);
		$res = $this->api_model->search_id($stock_id);

		return json_encode($res);
	}
}
