<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';
use Vimeo\Vimeo;

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
		date_default_timezone_set($data['setting']['timezone']);
		$data['post_dynamic'] = $this->Model_post->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_post',$data);
		$this->load->view('admin/view_footer');
	}

	public function pending()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['pendingpost_dynamic'] = $this->Model_post->pending();
		$client = new Vimeo("6fcf4423afd5ed4e8bb3a24cecba4f4994f54f16", "8s4ZU+FkIitVWMk8ZZoVGCs6yzzV+c98gzWk2Bf5nlQiL4kWH68DbgCrNmKlN7ansc5wDsR54mYBN22/H3DJKs6IBI+mqrUYwDL4L+WDhfb7dKRntXoJp5u4ngkXFRV0", "45a160291ecf9e0ce7c78455219c5b5d");
		
	

        foreach ($data['pendingpost_dynamic'] as $row) {
			
			if($row['vimeophoto']=='none'){
				$photourl = $client->request($row['vimeourl'], array(), 'GET');
				if($photourl['body']['pictures']['active']==true){
					
					$formsent = array(
						'vimeophoto' => $photourl['body']['pictures']['base_link'],
					);
	
					$this->Model_post->update($row['id'],$formsent);
				} 
			}
	
		}
		

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_pendingpost',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_post_add',$data);
		$this->load->view('admin/view_footer');
		

		/* $client = new Vimeo("6fcf4423afd5ed4e8bb3a24cecba4f4994f54f16", "8s4ZU+FkIitVWMk8ZZoVGCs6yzzV+c98gzWk2Bf5nlQiL4kWH68DbgCrNmKlN7ansc5wDsR54mYBN22/H3DJKs6IBI+mqrUYwDL4L+WDhfb7dKRntXoJp5u4ngkXFRV0", "62442fc761e43f2691ee43e043ad644f");

		$response = $client->request('/tutorial', array(), 'GET');
		print_r($response); */
	}

	public function deletetag(){
		$post_id = $this->input->post('post_id', true);
		$tag_id = $this->input->post('tag_id', true);
		if(isset($_POST['formremovetag'])) 
		{
			

			$tagdata = $this->Model_post->deletetagpost($post_id,$tag_id);
			
			$msg = 'Successfully untagged post.';
			$this->session->set_flashdata('success',$msg);

					$outputtag = array(
						'error' => false,
						'message' => $msg
						
					);
					echo json_encode($outputtag);
		}
	}

	public function review($id)
	{
    	// If there is no post in this id, then redirect
    	$tot = $this->Model_post->post_dynamic_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/post');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';
			
		
			if(isset($_POST['formapprove'])) 
		{
			$photovideoid = $this->input->post('photovideoid', true);
			$statusoption = $this->input->post('statusoption', true);
			$notifymessage = $this->input->post('notifymessage', true);
	
			if($statusoption == "1" || $statusoption == 1){
				$status = "Active";
			} else {
				$status = "Decline";
			}
			if(isset($photovideoid)){
				if(isset($notifymessage)){
				$form_data = array(
					'message' => $notifymessage,
					'status'          => $status
				);
			} else {
				$form_data = array(
					'status'          => $status
				);
			}

				$this->Model_post->update($photovideoid,$form_data);

				$mypost = $this->Model_post->getData($photovideoid);
				
				$msg = '';
				if($statusoption=="1" || $statusoption==1){
					$msg = 'Successfully approved the post.';
					$this->session->set_flashdata('success',$msg);

					$form_notification = array(
						'userid' => $mypost['userid'],
						'by_userid' => $this->session->userdata('id'),
						'type' => 'general',
						'title' => 'Your post has been approved.',
						'link' => 'post/'.$mypost['slug']
					);
				} else {
					$msg = 'You have successfully decline this post. Your message will sent to user.';
					$this->session->set_flashdata('error',$msg);
					$form_notification = array(
						'userid' => $mypost['userid'],
						'by_userid' => $this->session->userdata('id'),
						'type' => 'general',
						'title' => 'Your post has been declined. please check your email for info.',
						'link' => '#'
					);
					
				}
				$formsent = array(
					'userid' => $mypost['userid'],
					'from_userid' => $this->session->userdata('id')
				);

				$this->Model_post->addnotification($form_notification);
				$this->Model_post->addsent($formsent);
				
				
				$array = array(
					'notification' => $form_notification,
					'error' => false,
					'status' => $status,
					'message' => $msg
					);
				echo json_encode($array);
			} else {
				$msg .= 'Invalid post id';
				$this->session->set_flashdata('error',$msg);
				$array = array(
					'error' => false,
					'message' => $msg
					);
					echo json_encode($array);
			}

		} else {
			$data['post_review'] = $this->Model_post->getData($id);

			$data['tags_list'] = $this->Model_post->gettagData($id);

            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_post_review',$data);
			$this->load->view('admin/view_footer');
		}
	}

	
}