<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$error_message = '';
$success_message = '';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
   <!-- Meta Tags -->
   <meta name="viewport" content="width=device-width,initial-scale=1.0" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
   <?php
    $CI =& get_instance();
    $CI->load->model('Model_common');
    $all_setting = $CI->Model_common->all_setting();
    $class_name = '';
    $segment_2 = 0;
    $segment_3 = 0;
    $class_name = $this->router->fetch_class();
    $segment_2 = $this->uri->segment('2');
    $segment_3 = $this->uri->segment('3');
    function time_elapsed_string($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);
  
      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;
  
      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }
  
      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
    if($class_name == 'home')
    {
        echo '<meta name="description" content="desc">';
        echo '<meta name="keywords" content="keywords">';
        echo '<title>RockyMountains x McDo</title>';
    }
   
    ?>

   <!-- Favicon -->
   <link rel="icon" type="image/png"
      href="<?php echo base_url(); ?>public/uploads/<?php echo $setting['favicon']; ?>">
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/styles.min.css">

</head>

<body class="bd-init">
   <div class="linear-activity">
      <div class="indeterminate"></div>
   </div>
   <header>
      <div class="container">
         <div class="header-container">
            <div class="header-logo-wrap">
               <a href="<?php echo base_url(); ?>"><img
                     src="<?php echo base_url(); ?>public/assets/img/rmcdo-logo.png" alt=""
                     title="" /></a>

            </div>
            <div class="header-search-wrap">
               <div class="header-search-area">
                  <div>
                     <div class="searchwrap-box">
                        <input type="text" placeholder="Search for posts and accounts" id="search"
                           autocomplete="off">
                        <div class="searchloading"></div>
                        <div class="searchresult optiscroll" id="searchresult">
                           <ul>
                              <span class="searchlikeresult">
                              </span>


                              <li><span class="title">Accounts</span></li>
                              <span class="searchuserlist">
                              
   </span>
                              <li><a href="javascript:void(0)" class="viewall">View all result for
                                    "<span class="search-resulttxt"></span>"</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header-button-wrap">

               <?php if($this->session->userdata('id')== null) { ?>
               <div class="header-button-area">
                  <a href="#" class="btn btn-primary-outline" data-bs-toggle="modal"
                     data-bs-target="#loginModal"
                     data-src="<?php echo base_url(); ?>upload">Upload</a>
                  <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                     data-bs-target="#loginModal">Login</a>
               </div>
               <?php } ?>
               <?php if($this->session->userdata('id') != null ) { ?>
               <div class="header-auth-area">
                  <div class="header-auth-wrap">
                     <ul>
                        <li><a href="<?php echo base_url(); ?>upload" title="upload"><img
                                 src="<?php echo base_url(); ?>public/assets/img/svg/header-upload.svg"
                                 alt="" /></a>
                        </li>


                        <li class="mobile-me"><a href="#" title="notification"
                              onclick="rckymcdo.shownotification(this)" class="notificationbtn"
                              data-sent="<?php echo $sent[0]['id']; ?>"><img
                                 src="<?php echo base_url(); ?>public/assets/img/svg/header-notification.svg"
                                 alt="" />

                              <span class="notification-holder"
                                 data-current="<?php echo count($totalnotifications); ?>">

                              </span>

                           </a>
                           <div class="notification-wrapper">
                              <div class="notification-title">Notifications <span>clear all</span>
                              </div>
                              <div class="notification-menu">
                                 <ul class="nav">
                                    <li><a href="#" class="nav-link active"
                                          onclick="rckymcdo.opennotiftab('#notifcontent-all',this)">All</a>
                                    </li>
                                    <li><a href="#" class="nav-link "
                                          onclick="rckymcdo.opennotiftab('#notifcontent-follow',this)">General</a>
                                    </li>
                                    <li><a href="#" class="nav-link "
                                          onclick="rckymcdo.opennotiftab('#notifcontent-likes',this)">Likes</a>
                                    </li>
                                    <li><a href="#" class="nav-link "
                                          onclick="rckymcdo.opennotiftab('#notifcontent-comment',this)">Comments</a>
                                    </li>
                                    <li><a href="#" class="nav-link "
                                          onclick="rckymcdo.opennotiftab('#notifcontent-mention',this)">Mentions</a>
                                    </li>

                                 </ul>
                              </div>
                              <div class="tab-content notification-activity">
                                 <div class="tab-pane fade show active" id="notifcontent-all">
                                    <div class="notif-placeholder">
                                       <ul class="notification-list">

                                       </ul>
                                      
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </li>
                     </ul>
                     <div class="header-auth-profile-img"><a href="#">
                           <?php if($this->session->userdata('photo') == ''): ?>
                           <img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                              alt="user photo">
                           <?php else: ?>
                           <img
                              src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>"
                              alt="user photo">
                           <?php endif; ?>
                        </a>
                        <div class="header-auth-profile-menu">
                           <ul>

                              <li><a href="javscript:void(0)">
                                    <?php if($this->session->userdata('username')!==''){ ?>@
                                    <?php echo $this->session->userdata('username'); } else { echo $this->session->userdata('email'); } ?>
                                 </a></li>
                              <li><a href="javscript:void(0)">Edit Profile</a></li>
                              <li><a href="javscript:void(0)">Settings</a></li>
                              <li class="spacing"></li>
                              <?php if($this->session->userdata('role')=='Admin'){?>
                              <li><a href="<?php echo base_url(); ?>admin">Admin Panel</a></li>
                              <li class="spacing"></li>
                              <?php } ?>
                              <li><a href="<?php echo base_url(); ?>home/logout">Logout</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <!-- end auth area -->
            </div>
         </div>
      </div>
   </header>