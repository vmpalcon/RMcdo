<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_post');
        $this->load->model('Model_home');
        $this->load->helper('url');
    }

    public function index($slug)
	{
       
       
        $data['setting'] = $this->Model_common->all_setting();
        date_default_timezone_set($data['setting']['timezone']);
        $data['sent'] = $this->Model_common->getsent();
		$data['totalnotifications'] = $this->Model_common->gettotalnotification();
		$data['notifications'] = $this->Model_common->getnotification();

        $data['post_nd'] = $this->Model_post->dynamic_post_by_slug($slug);


        $data = $this->Model_home->getdata($data['post_nd']['id']);
      
        if($data['posttype']=='image'){
           $mypostvid = unserialize($data['photovideo']);
        } else {
           $mypostvid = $data['photovideo'];
        }
        $newdata = array(
           'isreact' => $data['isreact'],
           'totalreact' => $data['totalreact'],
           'id' => $data['id'],
           'userid' => $data['userid'],
           'title' => $data['title'],
           'slug' => $data['slug'],
           'photovideo' => $mypostvid,
           'vimeourl' => $data['vimeourl'],
           'vimeophoto' => $data['id'],
           'posttype' => $data['posttype'],
           'privacy' => $data['privacy'],
           'status' => $data['status'],
           'allowcomment' => $data['allowcomment'],
           'view' => $data['view'],
           'message' => $data['message'],
           'created_at' => $data['created_at'],
           'updated_at' => $data['updated_at'],
           'photo' => $data['photo'],
           'username' => $data['username'],
           'firstname' => $data['firstname'],
           'lastname' => $data['lastname'],
           'isverified' => $data['isverified']
        );
     
        $data['post_details'] = $newdata;


        $this->load->view('view_header',$data);
        $this->load->view('view_post',$data);
        $this->load->view('view_footer',$data);
       
    }

}
?>