<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_post');
        $this->load->helper('url');
    }

    public function index($slug)
	{
       
       
        $data['setting'] = $this->Model_common->all_setting();
        $data['sent'] = $this->Model_common->getsent();
		$data['totalnotifications'] = $this->Model_common->gettotalnotification();
		$data['notifications'] = $this->Model_common->getnotification();

        $data['post_details'] = $this->Model_post->dynamic_post_by_slug($slug);
        $this->load->view('view_header',$data);
        $this->load->view('view_post',$data);
        $this->load->view('view_footer',$data);
       
    }

}
?>