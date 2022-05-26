<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_dashboard');
    }
	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		//$data['total_category'] = $this->Model_dashboard->show_total_category();
		$data['total_users'] = $this->Model_dashboard->show_total_users();
		$data['total_pending'] = $this->Model_dashboard->show_total_pendingpost();
		$data['total_pages'] = $this->Model_dashboard->show_total_pages();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_dashboard',$data);
		$this->load->view('admin/view_footer');
	}
}
