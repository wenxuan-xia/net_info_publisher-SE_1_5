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
	
	public function line_day()
	{
		$jQuery = [[1182124800000,17.87],
		[1182211200000,17.67],
		[1182211300000,17.36],
		[1182211400000,17.70],
		[1182211500000,17.57],
		[1182211600000,17.48],
		[1182211700000,17.09],
		[1182211800000,17.41],
		[1182211900000,17.22],
		[1182212000000,17.43]];
		echo json_encode($jQuery);
	}
	
	public function line_month()
	{
		$jQuery = [[1182124800000,13.87],
		[1182211200000,17.67],
		[1182211300000,13.36],
		[1182211400000,17.70],
		[1182211500000,13.57],
		[1182211600000,17.48],
		[1182211700000,13.09],
		[1182211800000,17.41],
		[1182211900000,13.22],
		[1182212000000,17.43]];
		echo json_encode($jQuery);
	}

	public function line_year()
	{
		$jQuery = [[1182124800000,13.87],
		[1182211200000,17.67],
		[1182211300000,13.36],
		[1182211400000,9.70],
		[1182211500000,13.57],
		[1182211600000,17.48],
		[1182211700000,13.09],
		[1182211800000,17.41],
		[1182211900000,13.22],
		[1182212000000,9.43]];
		echo json_encode($jQuery);
	}
}
