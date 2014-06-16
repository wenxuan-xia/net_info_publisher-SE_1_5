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

	public function code_get_name_c()
	{
		$info = $this->input->get();
		$stock_name = $info['stock_name'];
		$this->load->model('api_model', '', TRUE);
		$res = $this->api_model->search_name($stock_name);

		return json_encode($res);
	}
	
	public function data_spline()
	{
		$jQuery = [[1182124800000,17.87],
		[1182211200000,17.67],
		[1182297600000,17.36],
		[1182384000000,17.70],
		[1182470400000,17.57],
		[1182470400000,17.57],
		[1182729600000,17.48],
		[1182816000000,17.09],
		[1182902400000,17.41],
		[1182988800000,17.22],
		[1183075200000,17.43]];
		echo json_encode($jQuery);
	}
	
}
