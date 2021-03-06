<div class="modal fade" id="loginModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="loginModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
         <div class="modal-header">
            <div>
               <a href="javascript:void(0)" class="btn-back" onclick="rckymcdo.backview(this)"><img
                     src="<?php echo base_url(); ?>public/assets/img/svg/close.svg" alt="" /></a>
            </div>

            <button type="button" class="btn-customclose" data-bs-dismiss="modal"
               aria-label="Close"></button>
         </div>
         <div class="modal-body rmc--loginmodal">
            <div class="rmc--login-view">
               <?php echo form_open(base_url()); ?>
               <h2>Log in</h2>
               <div class="mt-4">
                  <div class="loginmsgoutput"></div>

                  <div>
                     <div class="sendcode-input">
                        <input type="text" id="username" name="username" class="username-field"
                           placeholder="Username / Email" />
                     </div>
                     <div class="sendcode-input">
                        <div>
                           <input type="password" id="password" name="password"
                              placeholder="Password" />

                        </div>
                     </div>
                     <div class="login-textfield">
                        <p><a href="javascript:void(0)">Forgot Password</a></p>
                     </div>
                     <div class="login-btnfield">
                        <button type="submit" class="btn btn-primary submitloginbtn">Log
                           in</button>
                        <input type="hidden" name="form1" />
                     </div>
                  </div>
               </div>
               <div class="text-center mt-5 popsignupbtn">Don’t have an account? <a href="#">Sign
                     up</a></div>
               <?php echo form_close(); ?>
            </div>

            <div class="rmc--register-view">
               <?php echo form_open(base_url().'home/register'); ?>
               <h2>Register</h2>
               <div class="mt-4">
                  <div class="registermsgoutput"></div>
                  <div>
                     <div class="personal-input">
                        <div><input type="text" id="firstname" name="firstname"
                              class="firstname-field" placeholder="First Name" />
                        </div>
                        <div>
                           <input type="text" id="lastname" name="lastname" class="lastname-field"
                              placeholder="Last Name" />
                        </div>
                     </div>
                     <div class="textfield-input username-error-field">
                        <div><input type="text" id="username-field" name="username"
                              class="username-field" placeholder="Username" minlength="5" /></div>
                        
                     </div>
                     <!--<div class="birthdayfield">
                        <div><select id="month" name="month" onchange="change_month(this)"></select>
                        </div>
                        <div><select id="day" name="day"></select></div>
                        <div><select id="year" name="year" onchange="change_year(this)"></select>
                        </div>
                     </div>-->
                     <div class="textfield-input">
                        <input type="email" id="email" name="email" class="username-field"
                           placeholder="Email" />
                     </div>
                     <div class="textfield-input">
                        <div>
                           <input type="password" name="password" minlength="8"
                              placeholder="Password" />
                           <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                           <div id="popover-password">
                              <div class="progress">
                                 <div id="password-strength" class="progress-bar" role="progressbar"
                                    data-strength="0" aria-valuenow="40" aria-valuemin="0"
                                    aria-valuemax="100" style="width:0%">
                                 </div>
                              </div>
                              <ul class="list-unstyled">
                                 <li class="">
                                    <span class="low-upper-case">
                                       <i class="fas fa-circle" aria-hidden="true"></i>
                                       &nbsp;Lowercase &amp; Uppercase
                                    </span>
                                 </li>
                                 <li class="">
                                    <span class="one-number">
                                       <i class="fas fa-circle" aria-hidden="true"></i>
                                       &nbsp;Number (0-9)
                                    </span>
                                 </li>
                                 <li class="">
                                    <span class="one-special-char">
                                       <i class="fas fa-circle" aria-hidden="true"></i>
                                       &nbsp;Special Character (!@#$%^&*)
                                    </span>
                                 </li>
                                 <li class="">
                                    <span class="eight-character">
                                       <i class="fas fa-circle" aria-hidden="true"></i>
                                       &nbsp;Atleast 8 Character
                                    </span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="textfield-input">
                        <div>
                           <input type="password" name="confirmpassword"
                              placeholder="Confirm Password" minlength="8" />
                           <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                     </div>
                     <div class="form-check termsttxt">
                        <input class="form-check-input" type="checkbox" value="true"
                           name="agreeterms" id="agreeterms" checked>
                        <label class="form-check-label" for="agreeterms">
                           I agree to
                           RockyMountains x Mcdo <a href="#">Terms of Use</a> and <a
                              href="#">Privacy Policy</a>
                        </label>
                     </div>

                     <div class="login-btnfield">
                        <button type="submit"
                           class="btn btn-primary submitregisterbtn">Register</button>
                        <input type="hidden" name="form2" />
                     </div>
                  </div>
               </div>
               <div class="text-center mt-4 poploginbtn">Already have an account? <a href="#">Log
                     in</a></div>
               <?php echo form_close(); ?>
            </div>
         </div>

      </div>
   </div>
</div>
<!-- alert -->
<div class="modal fade" id="alertModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="alertModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <h2>Discard this post?</h2>
            <p>The video and all edits will be discarded.</p>
            <div class="btn-alert red" onclick="rckymcdo.resetupload(this)"><a href="#">Discard</a>
            </div>
            <div class="btn-alert"><a href="#" data-bs-dismiss="modal" aria-label="Close">Continue
                  editing</a></div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="alertreplaceModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="alertreplaceModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <h2>Replace this video?</h2>
            <p>Caption and video settings will still be saved.</p>
            <div class="btn-alert red" onclick="rckymcdo.replacevideo(this)"><a href="#">Replace</a>
            </div>
            <div class="btn-alert"><a href="#" data-bs-dismiss="modal" aria-label="Close">Continue
                  editing</a></div>
         </div>
      </div>
   </div>
</div>
<!-- Video Modal -->
<div class="modal fade" id="videoshowModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="videoshowModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-body">
            <div class="rmc--photovideo-wrap">
               <div class="rmc--photovideo-leftpane">
                  <div class="rmc--photovideo-blurbg"></div>
                  <div class="rmc--photovideo-tool">
                     <div><a href="#" class="video-close" data-bs-dismiss="modal" aria-label="Close"></a></div>
                     <div><img src="<?php echo base_url(); ?>public/assets/img/grouplogo.png" alt="" /></div>
                  </div>

                  <div class="rmc--photovideo-object">
                     <div class="rmc--photovideo-source">

                     </div>
                  </div>

               </div>
               <div class="rmc--photovideo-rightpane">
                  <div class="rmc-pv-btn-top"><a href="#" class="btn btn-primary-outline">Follow</a>
                  </div>
                  <div class="rmc--photovideo-profile">
                     <div class="rmc--profile-photo">
                        <div><a href="#"><img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg" class="rmcpop-img"
                                 alt=""></a></div>
                     </div>
                     <div>
                        <div class="rmc--profile-username rmcpop-user"></div>
                        <div class="rmc--profile-title rmcpop-title"></div>
                     </div>
                  </div>
                  <div class="rmc--photovideo-contentvw">
                     <div class="rmc--pv-text rmcpop-message">
                     </div>
                     <div class="rmc--pv-wraptool">
                        <div class="sharelike-wrap">
                           <div>
                              <label class="likecheckbox smallsvg" issublike="true" for="">
                                 <div class="label">
                                    <input type="checkbox" id="">
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
                           </div>
                           <div><a href="#" class="sharebtn total-comment"> 0</a></div>
                        </div>
                        <div class="sharelink-wrap">
                           <ul>
                              <li><a href="#" class="sm-embedlink"></a></li>
                              <li><a href="#" class="sm-emaillink"></a></li>

                              <li><a href="#" class="sm-facebook"></a></li>
                              <li><a href="#" class="sm-linkedin"></a></li>
                              <li><a href="#" class="sm-twitter"></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="rmc--pv-linktool">
                        <input type="text" placeholder="Link URL"
                           value="" />
                        <button type="button" class="btn btn-gray-outline"
                           onclick="rckymcdo.copylink(this)">Copy Link</button>
                     </div>
                  </div>
                  <div class="rmc--photovideo-commentvw">
                     <div class="rmc--commentarea">
                     <ul>

                     </ul>
                     </div>
                  <div class="loader"> <div class="loader-wheel"></div> </div>
                     <!--<ul>
                        <li>
                           <div class="rmc--pvcomment-header">
                              <div>
                                 <div class="rmc--profile-img"><a href="#"><img
                                          src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                                          alt=""></a>
                                 </div>
                              </div>
                              <div>
                                 <div class="rmc--profile-username"><a href="#">Jwoods</a>
                                 </div>
                                 <div class="rmc--profile-title">Judy Woods</div>
                              </div>
                              
                           </div>
                           <div class="rmc--pvcomment-content">
                              someone is living my dream ❤️ gonna fulfill soon
                           </div>
                        </li>
                        <li>
                           <div class="rmc--pvcomment-header">
                              <div>
                                 <div class="rmc--profile-img"><a href="#"><img
                                          src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                                          alt=""></a>
                                 </div>
                              </div>
                              <div>
                                 <div class="rmc--profile-username"><a href="#">Ford123</a>
                                 </div>
                                 <div class="rmc--profile-title">Ford Cooke</div>
                              </div>
                              
                           </div>
                           <div class="rmc--pvcomment-content">
                              someone is living my dream &lt;33 gonna fulfill soon </div>
                        </li>
                        <li>
                           <div class="rmc--pvcomment-header">
                              <div>
                                 <div class="rmc--profile-img"><a href="#"><img
                                          src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                                          alt=""></a>
                                 </div>
                              </div>
                              <div>
                                 <div class="rmc--profile-username"><a href="#">Shepard021</a>
                                 </div>
                                 <div class="rmc--profile-title">Grayson Shepard</div>
                              </div>
                              
                           </div>
                           <div class="rmc--pvcomment-content">
                              buddy you're living my dream..
                              I hope I can experience this someday
                           </div>
                        </li>
                     </ul>-->
                  </div>
                  <div class="rmc--photovideo-msgtool">
                     <?php if($this->session->userdata('id')) { ?>
                    <input type="text" name="comment" placeholder="Add comments" />
                     <button type="button" class="btn btn-primary-outline addcommentbtn">Post</button>
                     <?php } else { ?>
                        <div class="btnlogintocomment"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal">Please log in to comment</a></div>
                        <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Toast Alert -->
<div class="toast-container"></div>
<div class="newtoast-container"></div>
<!-- back to top -->
<a href="javascript:void(0)" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
<script>
   var baseurl = "<?php echo base_url(); ?>";
</script>
<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Server Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        There's an error while processing on the server, please try again later.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/vendor/bootstrap5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/vendor/optiscroll/optiscroll.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/vendor/tagify/jQuery.tagify.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/main.js"></script>
</body>

</html>