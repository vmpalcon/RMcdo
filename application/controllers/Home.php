<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		

		$this->load->view('view_header',$data);
		$this->load->view('view_home',$data);
		$this->load->view('view_footer',$data);
	}

	

	
}
