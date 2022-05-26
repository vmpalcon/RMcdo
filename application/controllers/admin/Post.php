<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_post');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['post_dynamic'] = $this->Model_post->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_post',$data);
		$this->load->view('admin/view_footer');
	}

	public function pending()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['pendingpost_dynamic'] = $this->Model_post->pending();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_pendingpost',$data);
		$this->load->view('admin/view_footer');
	}
}