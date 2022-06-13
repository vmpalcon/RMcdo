<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_user');
    }

    public function index($username)
	{
		$data['setting'] = $this->Model_common->all_setting();
		date_default_timezone_set($data['setting']['timezone']);
        $data['sent'] = $this->Model_common->getsent();
		$data['totalnotifications'] = $this->Model_common->gettotalnotification();
		$data['notifications'] = $this->Model_common->getnotification();

        $data['userdetail'] = $this->Model_user->dynamic_user($username);


		if($data['userdetail']){
			$data['totalpost'] = $this->Model_user->totalpost($data['userdetail']['id']);
			$this->load->view('view_header',$data);
			$this->load->view('view_user',$data);
			$this->load->view('view_footer',$data);

		} else {
			$this->load->view('view_header',$data);
			$this->load->view('view_user_notfound',$data);
			$this->load->view('view_footer',$data);
		}
		
	}



	

}