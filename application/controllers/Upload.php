<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$videoform = $this->input->post('postvideoform',true);
		$error = '';
		$success = '';

		if(isset($videoform)) {
			$title = $this->input->post('title',true);
			$isvideoimg = $this->input->post('isvideoimg',true);
			$privacytype = $this->input->post('privacytype',true);
			$userid = $this->session->userdata('id');
			
			if($isvideoimg == 'image') {
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
			

			

		   /* if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for banner<br>';
		    }


		    if($valid == 1) 
		    {
				$next_id = $this->Model_pages->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($slug == '') {
		    		$temp_string = strtolower($name);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_pages->slug_duplication_check($slug);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		        $final_name = 'page-dynamic-banner-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'name'             => $name,
					'slug'             => $slug,
					'content'          => $content,
					'banner'           => $final_name,
					'meta_title'       => $meta_title,
					'meta_description' => $meta_description,
					'lang_id'          => $lang_id
	            );
	            $this->Model_pages->add($form_data);

		        $success = 'Dynamic Page is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/pages');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/pages/add');
		    }*/
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