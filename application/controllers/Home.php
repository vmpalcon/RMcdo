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
      date_default_timezone_set($data['setting']['timezone']);
      $data['sent'] = $this->Model_common->getsent();

      $data['totalnotifications'] = $this->Model_common->gettotalnotification();
      $data['notifications'] = $this->Model_common->getnotification();

		$form1 = $this->input->post('form1',true);
		
      $formnotification = $this->input->post('formnotification',true);

      $notificationstatus = $this->input->post('notificationstatus',true);
      $notificationstatusid = $this->input->post('notificationid',true);

      if(isset($notificationstatus)) {
         $notymydata = array(
            'status' => $notificationstatus
            );
        $nty = $this->Model_common->updatenotification($notificationstatusid,$notymydata);

         $array = array(
       'error' => false,
       'notifylist' => $nty
       );
    echo json_encode($array);
         return;
      }

      if(isset($formnotification)) {
         $nty = $this->Model_common->getnotification();

         $array = array(
       'error' => false,
       'notifylist' => $nty
       );
    echo json_encode($array);
         return;
      }
		

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

   function react(){
      $reactpost = $this->input->post('reactpost',true);
      if(isset($reactpost)) {
         if($this->session->userdata('id')== null) {
            $array = array(
               'error' => true,
               'login' => false,
               'message' => "Please login to react to this post."
               );
        
            echo json_encode($array);
               return;
         } else {

         $userid = $this->session->userdata('id');
         $postid = $this->input->post('postid',true);

         $form_data = array(
            'userid' => $userid,
            'postid' => $postid
         );
         $existreact = $this->Model_home->react_duplication_check($userid,$postid);
        
         if($existreact){
            $output = $this->Model_home->deletereact($userid,$postid);
         } else {
            $output = $this->Model_home->reactpost($form_data);
         }
         if($output!=null){
            $output = 1;
         }
         $array = array(
            'error' => false,
            'message' => "You have successfully react to the video",
            'data' => $output
            );
         echo json_encode($array);
            return;
         }
      }
   }

   function searchresult() {
      $searchresult = $this->input->post('searchresult',true);
      if(isset($searchresult)) {
        // echo $searchresult;
         $tags = $this->Model_home->getsearch($searchresult);
         $users = $this->Model_home->getuser($searchresult);

         $array = array(
				'tags' => $tags,
				'users' => $users
				);
     
      echo json_encode($array);
         return;
      }
   }

	function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function showpost() {
      $iscomment = $this->input->post('iscomment',true);
      $postid = $this->input->post('postid',true);
      if(isset($iscomment)) {
         $data = $this->Model_home->getdata($postid);
      
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
         $array = array(
            'error' => false,
				'data' => $newdata
				);
     
      echo json_encode($array);
         return;
      }
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

      if(($this->session->userdata('id'))) {
         $likeid = 'id="likecheckbox'.$row->id.'"';
      } else {
         $likeid = '';
      }
      
      if($row->posttype == "video"){
        

         /*$myimgvideo = '<div class="loader">
         <div class="loader-wheel"></div>
      </div>
      <video playsinline autoplay class="rmc--video" id="rmc-video-'.$row->id.'" loop="" muted="muted"
         onmouseover="mouseover(\'rmc-video-'.$row->id.'\')"
         onmouseout="mouseout(\'rmc-video-'.$row->id.'\')" data-bs-toggle="modal"
         data-bs-target="#videoshowModal" data-filetype="' .$row->posttype.
         '"
         data-source="'  .base_url().'public/uploads/'.$row->photovideo.
'">
         <source src="'  .base_url().'public/uploads/'.$row->photovideo.
'" type="video/mp4" playsinline>
      </video>';
      $vidtool = '<div class="video-total-view">
      <i class="fas fa-play"></i> 0
   </div>';*/
   $myimgvideo = '<div class="loader"> <div class="loader-wheel"></div> </div><iframe src="'.$row->photovideo.'&autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=1?playsinline=0" frameborder="0" allow="autoplay;fullscreen;" allowfullscreen="" muted="" playsinline=""> </iframe>';
   $isvideotype = 'data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal" data-bs-target="#videoshowModal"';
   $isvideotypeclass = 'isactive';
      } else {
         $isvideotype = '';
         $isvideotypeclass = '';
         $vidtool = '&nbsp;';
         $listimg =  unserialize($row->photovideo);
         $total = count($listimg);
         $returnbtn = '';
         $returnimg = '';
         for( $i=0 ; $i < $total ; $i++ ) {
            if($i==0){
               $isactive = 'active';
            } else {
               $isactive = '';
            }
            if($total==1){
               $returnbtn .= '';
               $returnimg .= '<div class="carousel-item active" data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal"
               data-bs-target="#videoshowModal" data-filetype="' .$row->posttype. '"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
               $returnslider = '';
            } else {
               $returnbtn .= '<button type="button" class="'.$isactive.'" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" aria-current="true"></button>';
               $returnimg .= '<div class="carousel-item '.$isactive.'" data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal"
               data-bs-target="#videoshowModal" data-filetype="' .$row->posttype. '"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
               $returnslider = '<button class="carousel-control-prev" '.$isshowbtn.' type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" '.$isshowbtn.' type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>';
            }
            
        }
         
      
         $myimgvideo = '<div id="carouselRmxmcdo'.$row->id.'" class="carousel slide" data-bs-ride="carousel" >
         <div class="carousel-indicators">
         '.$returnbtn.'
         </div>
         <div class="carousel-inner">
    '.$returnimg.'
         </div>
         '.$returnslider .'
      </div>';
      }
      if($row->isreact == 0) {
         $ischecked = "";
      } else {
         $ischecked = "checked";
      }
	$output .= '
      <div class="rmc--video-card">
      <div class="rmc--profile">
         <div><a href="'.base_url().'user/'.$row->username.'"><img src="' .$photo.
          '" alt=""></a></div>
         <div>
            <div class="rmc--profile-photo">
               <div><a href="'.base_url().'user/'.$row->username.'"><img src="' .$photo.
          '"
                        class="rmc--profile-userimg" alt=""></a></div>
            </div>
            <div class="rmc--profile-username" title="'.$row->firstname.' '.$row->lastname.'"><a
                  href="'.base_url().'user/'.$row->username.'">'.$gtusername.' '.$gtverified.
          '</a></div>
            <div class="rmc--profile-title">' .$row->title.
          '</div>
            <div class="rmc--video-timeline">
               <div>
                  <div class="rmc--video-wrap '.$isvideotypeclass.'" '.$isvideotype.'>
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
<label class="likecheckbox" data-post="'.$row->id.'">
    <div class="label">
      <input type="checkbox" '.$likeid.' '.$ischecked.'>
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
    <span class="rmc--snippet-text total-like">'.$row->totalreact.'</span>
  </label>
                              
                        </li>
                        <li><a href="javascript:void(0)" class="rmcbtncomment" data-id="'.$row->id.'" data-focus="true" data-bs-toggle="modal"data-bs-target="#videoshowModal"><span
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
                                 <li>
                                 <input type="hidden" name="posturl" value="'.base_url(). 'post/' .$row->slug.'" />
                                 <a href="javascript:void(0)" class="copylink"
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

function fetchpost()
 {
  $output = '';

  $getidbyusername = $this->Model_home->getdatabyusername($this->input->post('username'));
  
  $data = $this->Model_home->fetch_databyuser($this->input->post('limit'), $this->input->post('start'), $getidbyusername[0]['id']);
 
  if($data->num_rows() > 0)
  {

   foreach($data->result() as $row)
   {
      if($row->posttype == "video"){
         $output .= '<div class="image-wrapper"><div class="videoframe"> <div class="loader"> <div class="loader-wheel"></div> </div><iframe src="'.$row->photovideo.'&autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=1?playsinline=0" frameborder="0" allow="autoplay;fullscreen;" allowfullscreen="" muted="" playsinline=""> </iframe> </div></div>';
      } else if($row->posttype == "image"){
         $listimg =  unserialize($row->photovideo);
         $output .= '<div class="image-wrapper"><img class="image"
               src="'.base_url().'public/uploads/'.$listimg[0].'"
               alt="" /></div>';
      }
   }
  }
  echo $output;
  
 }

 function fetchtags()
 {
  $output = '';
  $postag = $this->Model_home->getalltags($this->input->post('tag_title'));
  $list = implode(', ', array_column($postag, 'post_id'));

if($list == ''){
   echo ''; 
   return;
}
  $data = $this->Model_home->fetch_datatags($this->input->post('limit'), $this->input->post('start'), $list);

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

      if(($this->session->userdata('id'))) {
         $likeid = 'id="likecheckbox'.$row->id.'"';
      } else {
         $likeid = '';
      }
      
      if($row->posttype == "video"){
        

   $myimgvideo = '<div class="loader"> <div class="loader-wheel"></div> </div><iframe src="'.$row->photovideo.'&autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=1?playsinline=0" frameborder="0" allow="autoplay;fullscreen;" allowfullscreen="" muted="" playsinline=""> </iframe>';
   $isvideotype = 'data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal" data-bs-target="#videoshowModal"';
   $isvideotypeclass = 'isactive';
      } else {
         $isvideotype = '';
         $isvideotypeclass = '';
         $vidtool = '&nbsp;';
         $listimg =  unserialize($row->photovideo);
         $total = count($listimg);
         $returnbtn = '';
         $returnimg = '';
         for( $i=0 ; $i < $total ; $i++ ) {
            if($i==0){
               $isactive = 'active';
            } else {
               $isactive = '';
            }
            if($total==1){
               $returnbtn .= '';
               $returnimg .= '<div class="carousel-item active" data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal"
               data-bs-target="#videoshowModal" data-filetype="' .$row->posttype. '"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
               $returnslider = '';
            } else {
               $returnbtn .= '<button type="button" class="'.$isactive.'" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" aria-current="true"></button>';
               $returnimg .= '<div class="carousel-item '.$isactive.'" data-id="' .$row->id. '" data-bs-interval="10000" data-bs-toggle="modal"
               data-bs-target="#videoshowModal" data-filetype="' .$row->posttype. '"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
               $returnslider = '<button class="carousel-control-prev" '.$isshowbtn.' type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" '.$isshowbtn.' type="button" data-bs-target="#carouselRmxmcdo'.$row->id.'" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>';
            }
            
        }
         
      
         $myimgvideo = '<div id="carouselRmxmcdo'.$row->id.'" class="carousel slide" data-bs-ride="carousel" >
         <div class="carousel-indicators">
         '.$returnbtn.'
         </div>
         <div class="carousel-inner">
    '.$returnimg.'
         </div>
         '.$returnslider .'
      </div>';
      }
      if($row->isreact == 0) {
         $ischecked = "";
      } else {
         $ischecked = "checked";
      }
	$output .= '
      <div class="rmc--video-card">
      <div class="rmc--profile">
         <div><a href="'.base_url().'user/'.$row->username.'"><img src="' .$photo.
          '" alt=""></a></div>
         <div>
            <div class="rmc--profile-photo">
               <div><a href="'.base_url().'user/'.$row->username.'"><img src="' .$photo.
          '"
                        class="rmc--profile-userimg" alt=""></a></div>
            </div>
            <div class="rmc--profile-username" title="'.$row->firstname.' '.$row->lastname.'"><a
                  href="'.base_url().'user/'.$row->username.'">'.$gtusername.' '.$gtverified.
          '</a></div>
            <div class="rmc--profile-title">' .$row->title.
          '</div>
            <div class="rmc--video-timeline">
               <div>
                  <div class="rmc--video-wrap '.$isvideotypeclass.'" '.$isvideotype.'>
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
<label class="likecheckbox" data-post="'.$row->id.'">
    <div class="label">
      <input type="checkbox" '.$likeid.' '.$ischecked.'>
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
    <span class="rmc--snippet-text total-like">'.$row->totalreact.'</span>
  </label>
                              
                        </li>
                        <li><a href="javascript:void(0)" class="rmcbtncomment" data-id="'.$row->id.'" data-focus="true" data-bs-toggle="modal"data-bs-target="#videoshowModal"><span
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
                                 <li>
                                 <input type="hidden" name="posturl" value="'.base_url(). 'post/' .$row->slug.'" />
                                 <a href="javascript:void(0)" class="copylink"
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
   
   }
  }
  echo $output;
 }

	function register() {
		$form2 = $this->input->post('form2',true);
		$error = '';
		$success = '';

		if(isset($form2)) {
         $firstname = $this->input->post('firstname',true);
         $lastname = $this->input->post('lastname',true);
         $username = $this->input->post('username',true);
			$email = $this->input->post('email',true);
			$password = $this->input->post('password',true);
         $confirmpassword = $this->input->post('confirmpassword',true);
         $agreeterms = $this->input->post('agreeterms',true);
			/*$month = $this->input->post('month',true);
			$day = $this->input->post('day',true);
			$year = $this->input->post('year',true);*/

			$un = $this->Model_home->check_onlyemail($email);
         $usercheck = $this->Model_home->check_username($username);

			$valid = 1;

			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
         $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
         $this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
         $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required');
        
			/*if($month == 'month'){
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
			} */
         if(!$agreeterms){
            $valid = 0;
				$error .= "<p>You must agree to RockyMountains x Mcdo terms of use and privacy policy to register to this site.</p>";
				$array = array(
					'error' => true,
					'message' => $error
					);
				echo json_encode($array);
         }
         if($password != $confirmpassword){
            $valid = 0;
				$error .= "<p>Passwords do not match.</p>";
				$array = array(
					'error' => true,
					'message' => $error
					);
				echo json_encode($array);
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
			if($usercheck==null) {
            if($un==null){
            
				/*$birthdate_ts=strtotime("$year-$month-$day");
				$birthdate=date("Y-m-d",$birthdate_ts);*/
				$form_data = array(
               'firstname' => $firstname,
               'lastname' => $lastname,
               'username' => $username,
					'email'     => $email,
					'password'  => md5($password),
					'birthday'  => '',
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
			} else {
            $msg = "Username already exist";
            $array = array(
               'error' => true,
               'message' => $msg
               );
            echo json_encode($array);
				
			}
		}
			
		}
	}
	
   public function notification_data() {
		header("Content-Type: text/event-stream");
		header("Cache-Control: no-cache");
		header("Connection: keep-alive");

      // Check user session validity
if(!($this->session->userdata('id'))) {
	$sse_response = "data: " . json_encode(array('error' => 1, 'error_message' => 'User Authentication Failed')) . PHP_EOL . PHP_EOL;
	echo $sse_response;
	exit();
}

      while(1) {
         // Get the last post_id that was shown to the user
        
         $sse_response = count($this->Model_common->gettotalnotification());
         $notyd = $this->Model_common->getsent();
         $sse_data = $this->Model_common->getnotification();

         $output = "data: " . json_encode(array('totalnotification' => $sse_response, 'sent' => $notyd[0]['id'], 'notification' => $sse_data[0], 'error' => 0)) . PHP_EOL . PHP_EOL;

         echo $output;
      
         ob_flush();
         flush();	

         if(connection_aborted()) {
				break;
			}
         
         // Check every 10 seconds
         session_write_close();
         sleep(5);
      }
   }

   function addcomment() {
      $commentform = $this->input->post('commentform',true);
      $postid = $this->input->post('postid',true);
      $comment = $this->input->post('comment',true);
      if(isset($commentform)) {
         if($this->session->userdata('id')== null) {
            $array = array(
               'error' => true,
               'login' => false,
               'message' => "Please login to comment to this post."
               );
        
            echo json_encode($array);
               return;
         } else {
            $form_data = array(
               'userid' => $this->session->userdata('id'),
               'postid' => $postid,
               'comment' => $comment
				);
            $add = $this->Model_home->postcomment($form_data);

            $msg = 'Successfully add comment!';

          $array = array(
             'error' => false,
             'data' => $add,
             'message' => $msg
             );
          echo json_encode($array);
         }
   }

	
}

function getcomment() {
   $output = '';
   if($this->input->post('postid')== null) {
      echo $output;  
   } else {
  $data = $this->Model_home->fetch_comment($this->input->post('limit'), $this->input->post('start'), $this->input->post('postid'));
  
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


	   if($row->isverified== 1){
		$gtverified = ' <span><img src="'.base_url().'public/assets/img/svg/user-check.svg" alt=""></span>';
   		}
      $output .= '<li> <div class="rmc--pvcomment-header"> <div> <div class="rmc--profile-img"><a href="#"><img src="'.$photo.'" alt=""></a> </div> </div> <div> <div class="rmc--profile-username"><a href="'.base_url().'user/'.$row->username.'">'.$row->username.'</a> '.$gtverified.'</div> <div class="rmc--profile-title">'.$row->firstname.' '.$row->lastname.' &middot; '.$this->Model_common->time_elapsed_string($row->date_added).'</div> </div> </div> <div class="rmc--pvcomment-content"> '.$row->comment.' </div> </li>';
   }
   echo $output;   
}
   }

}



}
