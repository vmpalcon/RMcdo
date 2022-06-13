<section class="rmc--main-content" id="nav-home">
   <div class="container">
      <div class="rmc--leftpane optiscroll">
         <div class="rmc--leftpane-mainwrap">
            <?php if($this->session->userdata('id')== null) { ?>
            <ul class="rmc--leftpane-menu">
               <li>
                  <a href="#" title="" class="active">
                     <span class="rmc--leftpane-icon rmc--icon1"></span>
                     <span class="rmc--leftpane-text">For You</span>
                  </a>
               </li>
               <li>
                  <a href="#" title="">
                     <span class="rmc--leftpane-icon rmc--icon2"></span>
                     <span class="rmc--leftpane-text">Following</span>
                  </a>
               </li>
            </ul>

            <div class="rmc--login-widget">
               <p>Log in to follow creators, like videos, and view comments.</p>
               <a href="#" class="btn btn-primary-outline" data-bs-toggle="modal"
                  data-bs-target="#loginModal">Log In</a>
            </div>
            <?php } ?>
            <?php if($this->session->userdata('id') != null ) { ?>
            <div class="rmc--auth-mainleftpane">
               <div class="rmc--auth-profile">
                  <div class="rmc--auth-profile-img">
                     <a
                        href="<?php echo base_url(); ?>user/<?php echo $this->session->userdata('username'); ?>">
                        <?php if($this->session->userdata('photo') == ''): ?>
                        <img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                           alt="user photo">
                        <?php else: ?>
                        <img
                           src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>"
                           alt="user photo">
                        <?php endif; ?>
                     </a>
                  </div>
                  <div class="rmc--auth-profile-username">
                     <?php if($this->session->userdata('username') != ""){ ?>
                     <span>
                        <?php echo $this->session->userdata('username'); ?>
                     </span>
                     <?php } else {?>
                     <span>
                        <?php echo $this->session->userdata('email'); ?>
                     </span>
                     <?php } ?>
                     <?php if($this->session->userdata('isverified') == 1){ ?>
                     <span><img src="<?php echo base_url(); ?>public/assets/img/svg/user-check.svg"
                           alt="" /></span>
                     <?php } ?>
                  </div>
                  <div class="rmc--auth-profile-fullname">
                     <?php echo $this->session->userdata('firstname').' '.$this->session->userdata('lastname') ?>
                  </div>
                  <!--<div class="rmc--auth-profile-desc">
                     Nature really hit different 🍃
                  </div>-->

                  <div class="rmc--auth-profile-block">
                     <div><span>0</span> Following</div>
                     <div><span>0</span> Followers</div>

                  </div>
               </div>
               <ul class="rmc--auth-leftpane-menu">
                  <li>
                     <a href="#" title="" class="active">
                        <span class="rmc--leftpane-icon rmc--icon1"></span>
                        <span class="rmc--leftpane-text">For You</span>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <span class="rmc--leftpane-icon rmc--icon2"></span>
                        <span class="rmc--leftpane-text">Following</span>
                     </a>
                  </li>
               </ul>
            </div>
            <?php } ?>


            <div class="rmc--leftpane-discover">
               <p class="rmc-leftpane-widget-mt">Discover</p>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#seagames31</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#mcdonalds2022</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#rockymountains</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#hiking</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#fyp</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#foodlover</div>
               </a>
               <a href="#" class="chip chip-outline">
                  <div class="chip-label">#nature</div>
               </a>
            </div>
            <div class="footer-menu">
               <ul>
                  <li><a href="#">About</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="#">Developer</a></li>
                  <li><a href="#">Help</a></li>
                  <li><a href="#">Safety</a></li>
                  <li><a href="#">Terms And Condition</a></li>
                  <li><a href="#">Community Guidelines</a></li>
               </ul>
            </div>
            <div class="footer-copyright">
               <p>&copy; 2022 RockMountains x McDo</p>
            </div>
         </div>
      </div>
      <div class="rmc--rightpane timeline">
         <?php 
         $urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
         $segments = explode('/', $urlArray);
         $numSegments = count($segments); 
         $currentSegment = $segments[$numSegments - 1];  ?>
         <div class="tag-timelinetitle" data-title="<?php echo $currentSegment; ?>"><b>
               <?php
         echo '#'.$currentSegment;
         ?>
            </b></div>
         <div class="tag-timeline">

         </div>
         <div class="timeline-preloader">
            <div class="spinner"></div>
         </div>

         <!-- end -->
      </div>
   </div>
</section>