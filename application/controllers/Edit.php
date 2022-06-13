<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_user');
    }

    
	public function profile()
	{
		$data['setting'] = $this->Model_common->all_setting();
        $data['sent'] = $this->Model_common->getsent();
		$data['totalnotifications'] = $this->Model_common->gettotalnotification();
		$data['notifications'] = $this->Model_common->getnotification();

		$username = $this->session->userdata('username');
        $data['userdetail'] = $this->Model_user->dynamic_user($username);

		$this->load->view('view_header',$data);
		$this->load->view('view_user_edit',$data);
		$this->load->view('view_footer',$data);

	}

	

}