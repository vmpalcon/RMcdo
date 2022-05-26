<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();

		$form1 = $this->input->post('form1',true);
		
		

		if(isset($form1)) {
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			$locationredirect = $this->input->post('location_redirect',true);

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
						'isverified' => $pw['isverified'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($array);
					$msg = "You have successfully login";
                    $array = array(
						'error' => false,
						'message' => $msg,
						'redirect' => $locationredirect
						);
					echo json_encode($array);
				}
			}
		} else {
			$this->load->view('view_header',$data);
			$this->load->view('view_home',$data);
			$this->load->view('view_footer',$data);
		}

		
	}

	function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

	function fetch()
 {
  $output = '';
  $data = $this->Model_home->fetch_data($this->input->post('limit'), $this->input->post('start'));
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $row)
   {
	   if($row->photo!= '' && (file_exists(FCPATH.'public/uploads/'.$row->photo))){
			$photo = base_url().'public/uploads/'.$row->photo;
	   } else {
		$photo = base_url().'public/assets/img/no-photo.jpg';
	   }
	   $gtverified = "";
	   $gtusername = "";

	   if($row->isverified== 1){
		$gtverified = ' <span><img src="'.base_url().'public/assets/img/svg/user-check.svg" alt=""></span>';
   		}
		
		if($row->username!= ""){
			$gtusername = $row->username;
		} else {
			$gtusername = $row->firstname.' '.$row->lastname;
		}
      if($row->posttype == "video"){
         $myimgvideo = '<div class="loader">
         <div class="loader-wheel"></div>
      </div>
      <video class="rmc--video" id="rmc-video-'.$row->id.'" loop="" muted="muted"
         onmouseover="mouseover(\'rmc-video-'.$row->id.'\')"
         onmouseout="mouseout(\'rmc-video-'.$row->id.'\')" data-bs-toggle="modal"
         data-bs-target="#videoshowModal"
         data-source="'  .base_url().'public/uploads/'.$row->photovideo.
'">
         <source src="'  .base_url().'public/uploads/'.$row->photovideo.
'" type="video/mp4" playsinline>
      </video>';
      $vidtool = '<div class="video-total-view">
      <i class="fas fa-play"></i> 0
   </div>';
      } else {
         $vidtool = '&nbsp;';
         $listimg =  unserialize($row->photovideo);
         $total = count($listimg);
         $returnbtn = '';
         $returnimg = '';
         for( $i=0 ; $i < $total ; $i++ ) {
            
            if($i==0){
               $returnbtn .= '<button type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" class="active" aria-current="true"></button>';
               $returnimg .= '<div class="carousel-item active" data-bs-interval="10000"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
            } else {
               $returnbtn .= '<button type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" aria-current="true"></button>';
               $returnimg .= '<div class="carousel-item" data-bs-interval="10000"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
            }
            
        }
         
       
         $myimgvideo = '<div id="carouselRmxmcdo'.$row->id.'" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
         '.$returnbtn.'
         </div>
         <div class="carousel-inner">
    '.$returnimg.'
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>';
      }
	$output .= '
      <div class="rmc--video-card">
      <div class="rmc--profile">
         <div><a href="#"><img src="' .$photo.
          '" alt=""></a></div>
         <div>
            <div class="rmc--profile-photo">
               <div><a href="#"><img src="' .$photo.
          '"
                        class="rmc--profile-userimg" alt=""></a></div>
            </div>
            <div class="rmc--profile-username" title="'.$row->firstname.' '.$row->lastname.'"><a
                  href="#">'.$gtusername.' '.$gtverified.
          '</a></div>
            <div class="rmc--profile-title">' .$row->title.
          '</div>
            <div class="rmc--video-timeline">
               <div>
                  <div class="rmc--video-wrap" data-filetype="' .$row->posttype.
          '">
                     '.$myimgvideo.'
                     <div class="rmc--video-tool">
      '. $vidtool.'
                        
                     </div>
                  </div>
               </div>
               <div class="rmc--profile-snippet">
                  <div><a href="#" class="btn btn-primary">Follow</a></div>
                  <div class="rmc--snippet-tool">
                     <ul>
                        <li>
<label class="likecheckbox" for="likecheckbox'.$row->id.'">
    <div class="label">
      <input type="checkbox" id="likecheckbox'.$row->id.'">
      <div class="heart">
        <svg viewBox="0 0 544.582 544.582">
          <path d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
		C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
		c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z">
        </svg>
        <svg viewBox="0 0 544.582 544.582">
          <path d="M448.069,57.839c-72.675-23.562-150.781,15.759-175.721,87.898C247.41,73.522,169.303,34.277,96.628,57.839
		C23.111,81.784-16.975,160.885,6.894,234.708c22.95,70.38,235.773,258.876,263.006,258.876
		c27.234,0,244.801-188.267,267.751-258.876C561.595,160.732,521.509,81.631,448.069,57.839z">
        </svg>
      </div>
    </div>
    <span class="rmc--snippet-text total-like">0</span>
  </label>
                              
                        </li>
                        <li><a href="javascript:void(0)"><span
                                 class="rmc--snippet-icon comment"></span>
                              <span
                                 class="rmc--snippet-text total-comment">0</span></a>
                        </li>
                        <li><a href="javascript:void(0)"
                              onclick="rckymcdo.share(this)"><span
                                 class="rmc--snippet-icon share"></span>
                              <span
                                 class="rmc--snippet-text total-share">0</span></a>
                           <div class="rmc--share">
                              <ul>
                                 <li><a href="javascript:void(0)"
                                       class="embed">Embed</a>
                                 </li>
                                 <li><a href="javascript:void(0)"
                                       class="sendtofriends">Send to friends</a></li>
                                 <li><a href="javascript:void(0)" class="copylink"
                                       onclick="rckymcdo.copylink(this)">Copy
                                       Link</a></li>
                                 <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftestblock.co%2Frmxmcdo&quote=Nature+really+hit+different"
                                       target="_blank" class="sharetofb"
                                       onclick="rckymcdo.closeshare(this)">Share
                                       to Facebook</a>
                                 </li>
                                 <li><a href="https://www.linkedin.com/sharing/share-offsite?url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetolinkedin"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       LinkedIn</a>
                                 <li><a href="https://www.twitter.com/share?text=Nature+really+hit+different&url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetotwitter"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       Twitter</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
      ';
    /*$output .= '
    <div class="post_data" style="padding-top: 50px;padding-bottom: 50px;">
     <h3 class="text-danger">'.$row->title.'</h3>
     <p>'.$row->privacy.'</p>
    </div>
    ';*/
   }
  }
  echo $output;
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
					'isverified' => 0,
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
