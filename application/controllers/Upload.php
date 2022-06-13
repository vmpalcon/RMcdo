<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';
use Vimeo\Vimeo;

class Upload extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
    }

    public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		date_default_timezone_set($data['setting']['timezone']);
		$data['sent'] = $this->Model_common->getsent();
		$data['totalnotifications'] = $this->Model_common->gettotalnotification();
		$data['notifications'] = $this->Model_common->getnotification();
		$form1 = $this->input->post('form1',true);
		
		

		if(isset($form1)) {
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$un = $this->Model_home->check_email($username);
			if(!$un) {
                $msg = 'Invalid Username / Email';
     
			   $array = array(
				'error' => true,
				'message' => $msg
				);
				echo json_encode($array);
			} else {
				$pw = $this->Model_home->check_password($username,$password);

                if(!$pw) {
                    $msg = 'Invalid Account Password!';
                    $array = array(
						'error' => true,
						'message' => $msg
						);
					echo json_encode($array);
                } else {
					$array = array(
                        'id' => $pw['id'],
                        'email' => $pw['email'],
                        'username' => $pw['username'],
                        'firstname' => $pw['firstname'],
                        'lastname' => $pw['lastname'],
                        'photo' => $pw['photo'],
                        'countrycode' => $pw['countrycode'],
                        'phoneno' => $pw['phoneno'],
                        'role' => $pw['role'],
                        'status' => $pw['status'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($array);
					$msg = "You have successfully login";
                    $array = array(
						'error' => false,
						'message' => $msg
						);
					echo json_encode($array);
				}
			}
		} else {
			$this->load->view('view_header',$data);
			$this->load->view('view_upload',$data);
			$this->load->view('view_footer',$data);
		}

		
	}

	function process() {
		$data['setting'] = $this->Model_common->all_setting();

		$videoform = $this->input->post('postvideoform',true);
		$error = '';
		$success = '';

		if(isset($videoform)) {
			$title = $this->input->post('title',true);
			$tags = $this->input->post('tags',true);
			$isvideoimg = $this->input->post('isvideoimg',true);
			$privacytype = $this->input->post('privacytype',true);
			$allowcomment = $this->input->post('allowcomment',true);
			$status = $this->input->post('status',true);
			$userid = $this->session->userdata('id');

			
		
			if(!$title != ''){
				$newtitle = "my-video";
			} else {
				$newtitle = $title;
			}
				$temp_string = strtolower($newtitle);
				$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
			

			$tot_slug = $this->Model_home->slug_duplication_check($slug);
			$uniqid = uniqid();
			if($tot_slug) {
				$slug = $slug.'-'.$userid.'-'.$uniqid;
			}

			if($isvideoimg == 'video') {
				
			$client = new Vimeo("6fcf4423afd5ed4e8bb3a24cecba4f4994f54f16", "8s4ZU+FkIitVWMk8ZZoVGCs6yzzV+c98gzWk2Bf5nlQiL4kWH68DbgCrNmKlN7ansc5wDsR54mYBN22/H3DJKs6IBI+mqrUYwDL4L+WDhfb7dKRntXoJp5u4ngkXFRV0", "45a160291ecf9e0ce7c78455219c5b5d");

			$videoService = $_FILES["videofile"]["tmp_name"];

	
				if($data['setting']['file_size_limit'] == '1MB'){
					$filesize = 1048576;
				} else if($data['setting']['file_size_limit'] == '5MB'){
					$filesize = 5242880;	
				} else if($data['setting']['file_size_limit'] == '10MB'){
					$filesize = 10485760;
				} else if($data['setting']['file_size_limit'] == '30MB'){
					$filesize = 31457280;
				} else if($data['setting']['file_size_limit'] == '50MB'){
					$filesize = 52428800;
				} else if($data['setting']['file_size_limit'] == '100MB'){
					$filesize = 104857600;
				} else if($data['setting']['file_size_limit'] == '200MB'){
					$filesize = 209715200;
				} else if($data['setting']['file_size_limit'] == '500MB'){
					$filesize = 524288000;
				} 
			if($_FILES['videofile']['size'] > $filesize) { // 10mb
				$result = array(
					"error" => true,
					"message" => 'File is too big please make sure to upload atleast: ' . $data['setting']['file_size_limit']
				);

			} else {
				// File within size restrictions
				$uri = $client->upload($videoService, array(
					"name" => "RockyMountain Video - ".$uniqid,
					"description" => $title
					));
					$videourl = $client->request($uri, array(), 'GET');
					
					$form_data = array(
						'userid' => $userid,
						'title'      => $title,
						'slug'       => $slug,
						'photovideo'  => $videourl['body']['player_embed_url'],
						'vimeourl' => $uri,
						'posttype'   => $isvideoimg,
						'allowcomment' => $allowcomment,
						'privacy' 	 => $privacytype,
						'status' 	 => $status,
					);

					$datasave = $this->Model_home->addpost($form_data);

					$newtags = array_column(json_decode($tags), 'value');
			
			foreach($newtags as $row){
				$dupetags = $this->Model_home->duplicate_tags($row);
				if($dupetags){
				
					$newtagdata = array(
						'post_id' => $datasave,
						'tag_id' => $dupetags[0]['tag_id']
					);
					$this->Model_home->addtagpost($newtagdata);
				} else {
					
					$tagdata = array(
						'tag_title' => $row
					);
					$newtagid = $this->Model_home->addtag($tagdata);

					$newtagdata = array(
						'post_id' => $datasave,
						'tag_id' => $newtagid
					);
					$this->Model_home->addtagpost($newtagdata);
				}
			}

					if($status=='Pending'){
						$msg1 = 'Your post has been submitted. This post is subject for approval and will informed you once approved.';
					} else {
						$msg1 = 'Your post has been submitted.';
					}
					$result = array(
						"result" => $datasave,
						"error" => false,
						"vimeo" => $videourl,
						"message" => $msg1
					);
			}

			} else if($isvideoimg == 'image') {
				$total = count($_FILES['files']['name']);
				$imgarr = array();
				for( $i=0 ; $i < $total ; $i++ ) {

					$path = $_FILES['files']['name'][$i];
					$tmpFilePath = $_FILES['files']['tmp_name'][$i];

					if ($tmpFilePath != ""){
						$ext = pathinfo( $path, PATHINFO_EXTENSION );
						$uniqid = uniqid();
					$next_id = $this->Model_home->get_auto_post_increment_id();
					foreach ($next_id as $row) {
						$ai_id = $row['Auto_increment'];
					}
					$newfilename = "RMcdo-photo-".$uniqid."-".$ai_id.'-'.$i.'.'.$ext;
					$newFilePath = "./public/uploads/" . $newfilename;
				
					//Upload the file into the temp dir
					move_uploaded_file($tmpFilePath, $newFilePath);
					$imgarr[] = $newfilename;  
					}
				}
				$myfilestoupload = serialize($imgarr);

			
				$form_data = array(
					'userid' => $userid,
					'title'      => $title,
					'slug'       => $slug,
					'photovideo'  => $myfilestoupload,
					'posttype'   => $isvideoimg,
					'allowcomment' => $allowcomment,
					'privacy' 	 => $privacytype,
					'status' 	 => $status,
				);

				
				$datasave = $this->Model_home->addpost($form_data);

			
			$newtags = array_column(json_decode($tags), 'value');
			
			foreach($newtags as $row){
				$dupetags = $this->Model_home->duplicate_tags($row);
				if($dupetags){
				
					$newtagdata = array(
						'post_id' => $datasave,
						'tag_id' => $dupetags[0]['tag_id']
					);
					$this->Model_home->addtagpost($newtagdata);
				} else {
					
					$tagdata = array(
						'tag_title' => $row
					);
					$newtagid = $this->Model_home->addtag($tagdata);

					$newtagdata = array(
						'post_id' => $datasave,
						'tag_id' => $newtagid
					);
					$this->Model_home->addtagpost($newtagdata);
				}
			}

				if($status=='Pending'){
					$msg1 = 'Your post has been submitted. This post is subject for approval and will informed you once approved.';
				} else {
					$msg1 = 'Your post has been submitted.';
				}

		      
				$result = array(
					"result" => $datasave,
					"error" => false,
					"message" => $msg1
				);
				

			} else {
				$result = array(
					"error" => true,
					"message" => 'Unknown file type'
				);
			}

			

			
			echo json_encode($result);
		/*	if($isvideoimg == 'image') {
				$total = count($_FILES['files']['name']);
				$imgarr = array();
				for( $i=0 ; $i < $total ; $i++ ) {

					$path = $_FILES['files']['name'][$i];
					$tmpFilePath = $_FILES['files']['tmp_name'][$i];

					if ($tmpFilePath != ""){
						$ext = pathinfo( $path, PATHINFO_EXTENSION );
						$uniqid = uniqid();
					$next_id = $this->Model_home->get_auto_post_increment_id();
					foreach ($next_id as $row) {
						$ai_id = $row['Auto_increment'];
					}
					$newfilename = "RMcdo-photo-".$uniqid."-".$ai_id.'-'.$i.'.'.$ext;
					$newFilePath = "./public/uploads/" . $newfilename;
				
					//Upload the file into the temp dir
					move_uploaded_file($tmpFilePath, $newFilePath);
					$imgarr[] = $newfilename;  
					}
				}
				$myfilestoupload = serialize($imgarr);
			} else if($isvideoimg == 'video') {
				$path = $_FILES['files']['name'][0];
				$tmpFilePath = $_FILES['files']['tmp_name'][0];
				
				if ($tmpFilePath != ""){
					$ext = pathinfo( $path, PATHINFO_EXTENSION );
					$uniqid = uniqid();
					$next_id = $this->Model_home->get_auto_post_increment_id();
					foreach ($next_id as $row) {
						$ai_id = $row['Auto_increment'];
					}
				$newfilename = "RMcdo-video-".$uniqid."-".$ai_id.'.'.$ext;
				$newFilePath = "./public/uploads/" . $newfilename;
			
				
				move_uploaded_file($tmpFilePath, $newFilePath);
		
				}
				
				$myfilestoupload = $newfilename;
			} else {
				$result = array(
					"error" => true,
					"message" => 'Invalid data format'
				);
				echo json_encode($result);
				return;
			}

				if(!$title != ''){
					$newtitle = "my-rmcdo-video";
				} else {
					$newtitle = $title;
				}
					$temp_string = strtolower($newtitle);
					$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
				

				$tot_slug = $this->Model_home->slug_duplication_check($slug);
				$uniqid = uniqid();
				if($tot_slug) {
					$slug = $slug.'-'.$userid.'-'.$uniqid;
				}

				$form_data = array(
					'userid' => $userid,
					'title'      => $title,
					'slug'       => $slug,
					'photovideo'  => $myfilestoupload,
					'posttype'   => $isvideoimg,
					'privacy' 	 => $privacytype,
					'status' 	 => 'Pending',
				);

				
				$datasave = $this->Model_home->addpost($form_data);

		      
				$result = array(
					"result" => $datasave,
					"error" => false,
					"message" => 'Your post has been submitted!'
				);
				echo json_encode($result);
			

			
*/
		
		}
	}

	function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

	function register() {
		$form2 = $this->input->post('form2',true);
		$error = '';
		$success = '';

		if(isset($form2)) {
			$email = $this->input->post('email',true);
			$password = $this->input->post('password',true);
			$month = $this->input->post('month',true);
			$day = $this->input->post('day',true);
			$year = $this->input->post('year',true);

			$un = $this->Model_home->check_email($email);

			$valid = 1;

			$this->form_validation->set_rules('email', 'Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if($month == 'month'){
				$valid = 0;
				$error .= "<p>The Month field is required.</p>";
			}
			if($day == 'day'){
				$valid = 0;
				$error .= "<p>The Day field is required.</p>";
			}
			if($year == 'year'){
				$valid = 0;
				$error .= "<p>The Year field is required.</p>";
			}
			if(strlen($password) <= 5){
				$valid = 0;
				$error .= "<p>Password must have a minimum of 6 characters or more.</p>";
				$array = array(
					'count' => strlen($password),
					'error' => true,
					'message' => $error
					);
				echo json_encode($array);
			}

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
				$array = array(
					'count' => strlen($password),
					'error' => true,
					'message' => $error
					);
				echo json_encode($array);
            }
			if($valid == 1) 
		    {
			if($un==null) {
				
			

				$birthdate_ts=strtotime("$year-$month-$day");
				$birthdate=date("Y-m-d",$birthdate_ts);
				$form_data = array(
					'email'     => $email,
					'password'  => md5($password),
					'birthday'  => $birthdate,
					'role' => "User",
					'status' => "Active"
				);
	            $this->Model_home->add($form_data);

		        $msg = 'Successfully registered!';

				$array = array(
					'error' => false,
					'message' => $msg
					);
				echo json_encode($array);
			} else {
				$msg = "Email account already exist";
				$array = array(
					'error' => true,
					'message' => $msg
					);
				echo json_encode($array);
			}
		}
			
		}
	}

}