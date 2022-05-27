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
				$msg = '';
				if($statusoption=="1" || $statusoption==1){
					$msg = 'Successfully approved the post.';
					$this->session->set_flashdata('success',$msg);
				} else {
					$msg = 'You have successfully decline this post. Your message will sent to user.';
					$this->session->set_flashdata('error',$msg);
					
				}
			
				
				$array = array(
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
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_post_review',$data);
			$this->load->view('admin/view_footer');
		}
	}

	
}