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
                     <a href="#"><?php if($this->session->userdata('photo') == ''): ?>
									<img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg" alt="user photo">
								<?php else: ?>
									<img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>" alt="user photo">
								<?php endif; ?></a>
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
            <div class="rmc--leftpane-widget-wrap">
               <p class="rmc-leftpane-widget-mt">Suggested accounts</p>
               <ul class="rmc--leftpane-widget">
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user1.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">Nike</span>
                           <span class="rmc--subtxt">Nike</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user2.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">Decathlon</span>
                           <span class="rmc--subtxt">Decathlon</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user3.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">Mcdonalds</span>
                           <span class="rmc--subtxt">Mcdonalds</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user4.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">The North Face</span>
                           <span class="rmc--subtxt">The North Face</span>
                        </div>
                     </a>
                  </li>
               </ul>
               <div class="rmc--leftpane-alltxt"><a href="#" title="">See All</a></div>
            </div>

            <div class="rmc--leftpane-widget-wrap lastwidget">
               <p class="rmc-leftpane-widget-mt">Following accounts</p>
               <ul class="rmc--leftpane-widget">
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user5.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">Jamesmth</span>
                           <span class="rmc--subtxt">James Smith</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user6.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">Jwoods</span>
                           <span class="rmc--subtxt">Judy Woods</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user7.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">MOliva</span>
                           <span class="rmc--subtxt">Olivia Mullins</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" title="">
                        <div class="rmc--leftpane-widget-box">
                           <img src="<?php echo base_url(); ?>public/assets/img/users/user8.png"
                              alt="" />
                        </div>
                        <div class="rmc--leftpane-widget-text">
                           <span class="rmc--title">IamCarla</span>
                           <span class="rmc--subtxt">Carla Rogers</span>
                        </div>
                     </a>
                  </li>
               </ul>
               <div class="rmc--leftpane-alltxt"><a href="#" title="">See more</a></div>
            </div>
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
         <div class="main-timeline">

         </div>
         <div class="timeline-preloader">
            <div class="spinner"></div>
         </div>

         <!-- end -->
      </div>
   </div>
</section>