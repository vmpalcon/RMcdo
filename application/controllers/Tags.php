<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
    }

	public function index($tag)
	{
		$data['setting'] = $this->Model_common->all_setting();
      date_default_timezone_set($data['setting']['timezone']);
      $data['sent'] = $this->Model_common->getsent();

      $data['totalnotifications'] = $this->Model_common->gettotalnotification();
      $data['notifications'] = $this->Model_common->getnotification();

      
      $this->load->view('view_header',$data);
      $this->load->view('view_posttag',$data);
      $this->load->view('view_footer',$data);
   }

   
	
}
