<div class="linear-activity">
      <div class="indeterminate"></div>
   </div>
   <header>
      <div class="container">
         <div class="header-container">
            <div class="header-logo-wrap">
               <a href="#" onclick="rckymcdo.openviewupload('#nav-home')"><img
                     src="<?php echo base_url(); ?>public/assets/img/rockymountain-logo.png" alt="" title="" /></a>
               <a href="#" onclick="rckymcdo.openviewupload('#nav-home')"><img
                     src="<?php echo base_url(); ?>public/assets/img/mcdo-logo.png" alt="" title="" /></a>
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
                              <li><a href="javascript:void(0)" class="searchuser">
                                    <div class="searchimg-wrap"><img
                                          src="assets/img/users/user5.png" alt=""></div>
                                    <div class="search-text-wrap">
                                       <span>Jamesmth</span>
                                       <span>James Smith</span>
                                    </div>
                                 </a>
                              </li>
                              <li><a href="javascript:void(0)" class="searchuser">
                                    <div class="searchimg-wrap"><img
                                          src="assets/img/users/user6.png" alt=""></div>
                                    <div class="search-text-wrap">
                                       <span>Jwoods</span>
                                       <span>Judy Woods</span>
                                    </div>
                                 </a>
                              </li>
                              <li><a href="javascript:void(0)" class="searchuser">
                                    <div class="searchimg-wrap"><img
                                          src="assets/img/users/user7.png" alt=""></div>
                                    <div class="search-text-wrap">
                                       <span>MOliva</span>
                                       <span>Olivia Mullins</span>
                                    </div>
                                 </a>
                              </li>
                              <li><a href="javascript:void(0)" class="searchuser">
                                    <div class="searchimg-wrap"><img
                                          src="assets/img/users/user8.png" alt=""></div>
                                    <div class="search-text-wrap">
                                       <span>IamCarla</span>
                                       <span>Carla Rogers</span>
                                    </div>
                                 </a>
                              </li>
                              <li><a href="javascript:void(0)" class="viewall">View all result for
                                    "<span class="search-resulttxt"></span>"</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header-button-wrap">
               <div class="header-button-area">
                  <a href="#" class="btn btn-primary-outline" data-bs-toggle="modal"
                     data-bs-target="#loginModal">Upload</a>
                  <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                     data-bs-target="#loginModal">Login</a>
               </div>
               <div class="header-auth-area">
                  <div class="header-auth-wrap">
                     <ul>
                        <li><a href="#" onclick="rckymcdo.openviewupload('#nav-upload')"
                              title="upload"><img src="assets/img/svg/header-upload.svg"
                                 alt="" /></a>
                        </li>


                        <li class="mobile-me"><a href="#" title="notification"
                              onclick="rckymcdo.shownotification(this)"><img
                                 src="assets/img/svg/header-notification.svg" alt="" /></a>
                           <div class="notification-wrapper">
                              <div class="notification-title">Notifications</div>
                              <div class="notification-menu">
                                 <ul class="nav">
                                    <li><a href="#" class="nav-link active"
                                          onclick="rckymcdo.opennotiftab('#notifcontent-all',this)">All</a>
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
                                    <li><a href="#" class="nav-link "
                                          onclick="rckymcdo.opennotiftab('#notifcontent-follow',this)">Followers</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="tab-content notification-activity">
                                 <div class="tab-pane fade show active" id="notifcontent-all">
                                    <div class="notif-placeholder">
                                       <h3>All activity</h3>
                                       <p>Notifications about your account will appear here.</p>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </li>
                     </ul>
                     <div class="header-auth-profile-img"><a href="#"><img
                              src="uploads/header-profile.png" alt="" /></a>
                        <div class="header-auth-profile-menu">
                           <ul>
                              <li><a href="javscript:void(0)">@Jtnsmth</a></li>
                              <li><a href="javscript:void(0)">Edit Profile</a></li>
                              <li><a href="javscript:void(0)">Settings</a></li>
                              <li class="spacing"></li>
                              <li><a href="#" onclick="rckymcdo.logout()">Logout</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <section class="tab-pane fade show active rmc--main-content" id="nav-home">
         <div class="container">
            <div class="rmc--leftpane optiscroll">
               <div class="rmc--leftpane-mainwrap">
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
                  <div class="rmc--auth-mainleftpane">
                     <div class="rmc--auth-profile">
                        <div class="rmc--auth-profile-img">
                           <a href="#"><img src="uploads/mainprofile.png" alt="" /></a>
                        </div>
                        <div class="rmc--auth-profile-username">
                           <span>Jtnsmth</span> <span><img src="assets/img/svg/user-check.svg"
                                 alt="" /></span>
                        </div>
                        <div class="rmc--auth-profile-fullname">
                           Justin Smith
                        </div>
                        <div class="rmc--auth-profile-desc">
                           Nature really hit different 🍃
                        </div>

                        <div class="rmc--auth-profile-block">
                           <div><span>200</span> Following</div>
                           <div><span>401</span> Followers</div>
                           <div><span>3M</span> Likes</div>
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
                  <div class="rmc--leftpane-widget-wrap">
                     <p class="rmc-leftpane-widget-mt">Suggested accounts</p>
                     <ul class="rmc--leftpane-widget">
                        <li>
                           <a href="#" title="">
                              <div class="rmc--leftpane-widget-box">
                                 <img src="assets/img/users/user1.png" alt="" />
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
                                 <img src="assets/img/users/user2.png" alt="" />
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
                                 <img src="assets/img/users/user3.png" alt="" />
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
                                 <img src="assets/img/users/user4.png" alt="" />
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
                                 <img src="assets/img/users/user5.png" alt="" />
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
                                 <img src="assets/img/users/user6.png" alt="" />
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
                                 <img src="assets/img/users/user7.png" alt="" />
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
                                 <img src="assets/img/users/user8.png" alt="" />
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
               <!-- Video 1 -->
               <div class="rmc--video-card">
                  <div class="rmc--profile">
                     <div><a href="#"><img src="uploads/profile1.png" alt=""></a></div>
                     <div>
                        <div class="rmc--profile-photo">
                           <div><a href="#"><img src="uploads/profile1.png"
                                    class="rmc--profile-userimg" alt=""></a></div>
                        </div>
                        <div class="rmc--profile-username" title="Jamesmth 2022-11-12"><a
                              href="#">Jamesmth</a></div>
                        <div class="rmc--profile-title">Nature really hit different 🍃 </div>
                        <div class="rmc--video-timeline">
                           <div>
                              <div class="rmc--video-wrap" data-filetype="video">
                                 <div class="loader">
                                    <div class="loader-wheel"></div>
                                 </div>
                                 <video class="rmc--video" id="rmc-video-1" loop="" muted="muted"
                                    onmouseover="mouseover('rmc-video-1')"
                                    onmouseout="mouseout('rmc-video-1')" data-bs-toggle="modal"
                                    data-bs-target="#videoshowModal"
                                    data-source="uploads/video1.mp4"
                                    data-preview="uploads/video1-preview.png">
                                    <source src="uploads/video1.mp4" type="video/mp4" playsinline>
                                 </video>
                                 <div class="rmc--video-tool">

                                    <div class="video-total-view">
                                       <i class="fas fa-play"></i> 5
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="rmc--profile-snippet">
                              <div><a href="#" class="btn btn-primary">Follow</a></div>
                              <div class="rmc--snippet-tool">
                                 <ul>
                                    <li><a href="javascript:void(0)" class="btnlike"><span
                                             class="rmc--snippet-icon like"></span>
                                          <span class="rmc--snippet-text total-like">117K</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><span
                                             class="rmc--snippet-icon comment"></span>
                                          <span
                                             class="rmc--snippet-text total-comment">2320</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"
                                          onclick="rckymcdo.share(this)"><span
                                             class="rmc--snippet-icon share"></span>
                                          <span
                                             class="rmc--snippet-text total-share">8993</span></a>
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
               <!-- Video 2 -->
               <div class="rmc--video-card">
                  <div class="rmc--profile">
                     <div><a href="#"><img src="uploads/profile2.png" alt=""></a></div>
                     <div>
                        <div class="rmc--profile-photo">
                           <div><a href="#"><img src="uploads/profile2.png"
                                    class="rmc--profile-userimg" alt=""></a></div>
                        </div>
                        <div class="rmc--profile-username" title="Mark Bustin"><a
                              href="#">IamBustin</a></div>
                        <div class="rmc--profile-title">Foodtripin #mcdo #foodlover #fyp 🍟🍟</div>
                        <div class="rmc--video-timeline">
                           <div>
                              <div class="rmc--video-wrap" data-filetype="video">
                                 <div class="loader">
                                    <div class="loader-wheel"></div>
                                 </div>
                                 <video class="rmc--video" id="rmc-video-2" loop="" muted="muted"
                                    onmouseover="mouseover('rmc-video-2')"
                                    onmouseout="mouseout('rmc-video-2')" data-bs-toggle="modal"
                                    data-bs-target="#videoshowModal"
                                    data-source="uploads/video3.mp4">
                                    <source src="uploads/video3.mp4" type="video/mp4" playsinline>
                                 </video>
                                 <div class="rmc--video-tool">

                                    <div class="video-total-view">
                                       <i class="fas fa-play"></i> 12
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="rmc--profile-snippet">
                              <div><a href="#" class="btn btn-primary">Follow</a></div>
                              <div class="rmc--snippet-tool">
                                 <ul>
                                    <li><a href="javascript:void(0)" class="btnlike"><span
                                             class="rmc--snippet-icon like"></span>
                                          <span class="rmc--snippet-text total-like">117K</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><span
                                             class="rmc--snippet-icon comment"></span>
                                          <span
                                             class="rmc--snippet-text total-comment">2320</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"
                                          onclick="rckymcdo.share(this)"><span
                                             class="rmc--snippet-icon share"></span>
                                          <span
                                             class="rmc--snippet-text total-share">8993</span></a>
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
               <!-- Photo 3 -->
               <div class="rmc--video-card">
                  <div class="rmc--profile">
                     <div><a href="#"><img src="uploads/profile3.png" alt=""></a></div>
                     <div>
                        <div class="rmc--profile-photo">
                           <div><a href="#"><img src="uploads/profile3.png"
                                    class="rmc--profile-userimg" alt=""></a></div>
                        </div>
                        <div class="rmc--profile-username" title="Olivia Mullins"><a
                              href="#">MOliva</a></div>
                        <div class="rmc--profile-title">Todays hike was amazing…</div>
                        <div class="rmc--video-timeline">
                           <div>
                              <div class="rmc--video-wrap" data-filetype="image">
                                 <img src="uploads/photo1.png" alt="" data-bs-toggle="modal"
                                    data-bs-target="#videoshowModal"
                                    data-source="uploads/photo1.png" />
                                 <div class="rmc--video-tool">
                                    &nbsp;
                                 </div>
                              </div>
                           </div>
                           <div class="rmc--profile-snippet">
                              <div><a href="#" class="btn btn-primary">Follow</a></div>
                              <div class="rmc--snippet-tool">
                                 <ul>
                                    <li><a href="javascript:void(0)" class="btnlike"><span
                                             class="rmc--snippet-icon like"></span>
                                          <span class="rmc--snippet-text total-like">117K</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><span
                                             class="rmc--snippet-icon comment"></span>
                                          <span
                                             class="rmc--snippet-text total-comment">2320</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"
                                          onclick="rckymcdo.share(this)"><span
                                             class="rmc--snippet-icon share"></span>
                                          <span
                                             class="rmc--snippet-text total-share">8993</span></a>
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
               <!-- Photo 4 -->
               <div class="rmc--video-card">
                  <div class="rmc--profile">
                     <div><a href="#"><img src="uploads/profile4.png" alt=""></a></div>
                     <div>
                        <div class="rmc--profile-photo">
                           <div><a href="#"><img src="uploads/profile4.png"
                                    class="rmc--profile-userimg" alt=""></a></div>
                        </div>
                        <div class="rmc--profile-username" title="Carla Rogers"><a
                              href="#">IamCarla</a></div>
                        <div class="rmc--profile-title">love these!! #nike #nike #foryoupage </div>
                        <div class="rmc--video-timeline">
                           <div>
                              <div class="rmc--video-wrap" data-filetype="image">
                                 <img src="uploads/photo2.png" alt="" data-bs-toggle="modal"
                                    data-bs-target="#videoshowModal"
                                    data-source="uploads/photo2.png" />
                                 <div class="rmc--video-tool">
                                    &nbsp;
                                 </div>
                              </div>
                           </div>
                           <div class="rmc--profile-snippet">
                              <div><a href="#" class="btn btn-primary">Follow</a></div>
                              <div class="rmc--snippet-tool">
                                 <ul>
                                    <li><a href="javascript:void(0)" class="btnlike"><span
                                             class="rmc--snippet-icon like"></span>
                                          <span class="rmc--snippet-text total-like">117K</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><span
                                             class="rmc--snippet-icon comment"></span>
                                          <span
                                             class="rmc--snippet-text total-comment">2320</span></a>
                                    </li>
                                    <li><a href="javascript:void(0)"
                                          onclick="rckymcdo.share(this)"><span
                                             class="rmc--snippet-icon share"></span>
                                          <span
                                             class="rmc--snippet-text total-share">8993</span></a>
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
               <!-- end -->
            </div>
         </div>
      </section>
      <section class="tab-pane fade" id="nav-upload">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="video-upload-title">
                     <h2>Upload Video / Image</h2>
                     <p>Post a Video / Image to your account</p>
                  </div>
                  <div class="custom-form">
                     <div class="row">
                        <div class="col-lg-12">
                           <span class="msgoutput"></span>
                        </div>
                        <div class="col-lg-4">
                           <form action="" id="video_form" method="POST"
                              enctype="multipart/form-data">
                              <input type="hidden" class="videotype">
                              <div class="load-area">
                                 <div class="video-upload-input-area">
                                    <label class="text-center">
                                       <div class="info-star">
                                          <h5>Select Video / Image
                                             to upload</h5>
                                          <p>MP4 or WebM<br />
                                             720x1280 resolution or higher<br />
                                             Up to 10 minutes<br />
                                             Less than 2 GB</p>
                                          <div><button type="button" class="btn btn-primary"
                                                onclick="rckymcdo.triggerupload(this)"> Select
                                                File</button></div>
                                       </div>
                                    </label>
                                    <input type="file" name="files" class="d-none" id="video_upload"
                                       multiple>
                                 </div>
                              </div>

                              <div class="preview-area">
                                 <div class="preview-area-video">
                                    <video id="previewvideo" controls></video>
                                 </div>
                                 <div class="videopreview-info">
                                    <div class="videopreview-title"></div>
                                    <div class="videopreview-changevideo"><a href="#"
                                          data-bs-toggle="modal"
                                          data-bs-target="#alertreplaceModal">Change
                                          video</a></div>
                                 </div>
                              </div>

                              <div class="photopreview-area">
                                 <div id="carouselRmxmcdo" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-indicators">

                                    </div>
                                    <div class="carousel-inner">

                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                       data-bs-target="#carouselRmxmcdo" data-bs-slide="prev">
                                       <span class="carousel-control-prev-icon"
                                          aria-hidden="true"></span>
                                       <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                       data-bs-target="#carouselRmxmcdo" data-bs-slide="next">
                                       <span class="carousel-control-next-icon"
                                          aria-hidden="true"></span>
                                       <span class="visually-hidden">Next</span>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="col-lg-8">
                           <form action="" method="POST" id="submit_post">
                              <div class="form-group">
                                 <label for="caption">Caption</label>
                                 <input type="text" name="caption"
                                    class="form-control txtcaption" />
                              </div>
                              <div class="form-group">
                                 <label>Who can view this video</label>
                                 <select class="form-select">
                                    <option selected value="public">Public</option>
                                    <option value="private">Private</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Allow users to:</label>
                                 <div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox"
                                          id="chk_comment" checked>
                                       <label class="form-check-label"
                                          for="chk_comment">Comment</label>
                                    </div>

                                 </div>
                              </div>
                              <div class="form-group videocopytext">
                                 <label>Run a copyright check</label>
                                 <p>We'll check your video for potential copyright infringements on
                                    used sounds. If infringements are found, you can edit the video
                                    before posting.</p>
                              </div>
                              <div class="submit-post-action f-right">
                                 <button type="button" class="btn btn-gray-outline btndiscardvideo"
                                    data-bs-toggle="modal"
                                    data-bs-target="#alertModal">Discard</button>
                                 <button type="button" class="btn btn-primary btnpostvideo"
                                    disabled><span>Post</span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>