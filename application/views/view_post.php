<section class="rmc--main-content">
 
   <div class="modal-body">
               <div class="rmc--photovideo-wrap static">
                  <div class="rmc--photovideo-leftpane">
                     <div class="rmc--photovideo-blurbg" style="background: url(&quot;uploads/video1-preview.png&quot;);"></div>
                     <div class="rmc--photovideo-tool">
                      
                     <div><img src="<?php echo base_url(); ?>public/assets/img/grouplogo.png" alt="" /></div>
                     </div>

                     <div class="rmc--photovideo-object">
                        <div class="rmc--photovideo-source">
                        <?php if($post_details['posttype']=='video'): ?>   
                        <video id="popupvideoplayer" loop="" autoplay="" controls="">
                        <source src="<?php echo base_url(); ?>public/uploads/<?php echo $post_details['photovideo']; ?>" type="video/mp4" playsinline="">
                     </video>
                        <?php else: ?>
                           image
                           <?php endif; ?>
   </div>
                     </div>

                  </div>
                  <div class="rmc--photovideo-rightpane">
                     <div class="rmc-pv-btn-top"><a href="#" class="btn btn-primary-outline">Follow</a></div>
                     <div class="rmc--photovideo-profile">
                        <div class="rmc--profile-photo">
                           <div><a href="#"><img src="uploads/profile1.png" class="rmcpop-img" alt="">
                        
                           <?php if($post_details['photo'] == ''): ?>
                           <img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                              alt="user photo">
                           <?php else: ?>
                           <img
                              src="<?php echo base_url(); ?>public/uploads/<?php echo $post_details['photo']; ?>"
                              alt="user photo" onError="this.onerror=null;this.src='<?php echo base_url();?>public/assets/img/no-photo.jpg'">
                           <?php endif; ?>
                        </a></div>
                        </div>
                        <div>
                           <div class="rmc--profile-username rmcpop-user"><?php echo $post_details['username']; ?></div>
                           <div class="rmc--profile-title rmcpop-title"><?php echo $post_details['firstname'].' '.$post_details['lastname']; ?></div>
                        </div>
                     </div>
                     <div class="rmc--photovideo-contentvw">
                        <div class="rmc--pv-text rmcpop-message"> <?php echo $post_details['title']; ?></div>
                        <div class="rmc--pv-wraptool">
                           <div class="sharelike-wrap">
                              <div><a href="#" class="likebtn"> 0</a></div>
                              <div><a href="#" class="sharebtn"> 0</a></div>
                           </div>
                           <div class="sharelink-wrap">
                              <ul>
                                 <li><a href="#" class="sm-embedlink"></a></li>
                                 <li><a href="#" class="sm-emaillink"></a></li>
                                 <li><a href="#" class="sm-copylink"></a></li>
                                 <li><a href="#" class="sm-facebook"></a></li>
                                 <li><a href="#" class="sm-linkedin"></a></li>
                                 <li><a href="#" class="sm-twitter"></a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="rmc--pv-linktool">
                           <input type="text" placeholder="Link URL" value="<?php echo base_url().'post/'.$post_details['slug'];?>">
                           <button type="button" class="btn btn-gray-outline" onclick="rckymcdo.copylink(this)">Copy Link</button>
                        </div>
                     </div>
                     <div class="rmc--photovideo-commentvw">
                        <ul>
                           <li>
                              <div class="rmc--pvcomment-header">
                                 <div>
                                    <div class="rmc--profile-img"><a href="#"><img src="uploads/profile5.png" alt=""></a>
                                    </div>
                                 </div>
                                 <div>
                                    <div class="rmc--profile-username"><a href="#">Jwoods</a>
                                    </div>
                                    <div class="rmc--profile-title">Judy Woods</div>
                                 </div>
                                 <div>
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M5.5 2C3.5673 2 2 3.49112 2 5.33081C2 6.81587 2.6125 10.3405 8.6416 13.9034C8.7496 13.9666 8.87358 14 9 14C9.12642 14 9.2504 13.9666 9.3584 13.9034C15.3875 10.3405 16 6.81587 16 5.33081C16 3.49112 14.4327 2 12.5 2C10.5673 2 9 4.01867 9 4.01867C9 4.01867 7.4327 2 5.5 2Z" stroke="#8E8E8E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg><br>
                                       0
                                    

                                 </div>
                              </div>
                              <div class="rmc--pvcomment-content">
                                 someone is living my dream ❤️ gonna fulfill soon
                              </div>
                           </li>
                           <li>
                              <div class="rmc--pvcomment-header">
                                 <div>
                                    <div class="rmc--profile-img"><a href="#"><img src="uploads/profile6.png" alt=""></a>
                                    </div>
                                 </div>
                                 <div>
                                    <div class="rmc--profile-username"><a href="#">Ford123</a>
                                    </div>
                                    <div class="rmc--profile-title">Ford Cooke</div>
                                 </div>
                                 <div>
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M5.5 2C3.5673 2 2 3.49112 2 5.33081C2 6.81587 2.6125 10.3405 8.6416 13.9034C8.7496 13.9666 8.87358 14 9 14C9.12642 14 9.2504 13.9666 9.3584 13.9034C15.3875 10.3405 16 6.81587 16 5.33081C16 3.49112 14.4327 2 12.5 2C10.5673 2 9 4.01867 9 4.01867C9 4.01867 7.4327 2 5.5 2Z" stroke="#8E8E8E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg><br>
                                       0
                                    

                                 </div>
                              </div>
                              <div class="rmc--pvcomment-content">
                                 someone is living my dream &lt;33 gonna fulfill soon </div>
                           </li>
                           <li>
                              <div class="rmc--pvcomment-header">
                                 <div>
                                    <div class="rmc--profile-img"><a href="#"><img src="uploads/profile7.png" alt=""></a>
                                    </div>
                                 </div>
                                 <div>
                                    <div class="rmc--profile-username"><a href="#">Shepard021</a>
                                    </div>
                                    <div class="rmc--profile-title">Grayson Shepard</div>
                                 </div>
                                 <div>
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M5.5 2C3.5673 2 2 3.49112 2 5.33081C2 6.81587 2.6125 10.3405 8.6416 13.9034C8.7496 13.9666 8.87358 14 9 14C9.12642 14 9.2504 13.9666 9.3584 13.9034C15.3875 10.3405 16 6.81587 16 5.33081C16 3.49112 14.4327 2 12.5 2C10.5673 2 9 4.01867 9 4.01867C9 4.01867 7.4327 2 5.5 2Z" stroke="#8E8E8E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg><br>
                                       0
                                    

                                 </div>
                              </div>
                              <div class="rmc--pvcomment-content">
                                 buddy you're living my dream..
                                 I hope I can experience this someday
                              </div>
                           </li>
                        </ul>
                     </div>
                     <div class="rmc--photovideo-msgtool">
                        <input type="text" placeholder="Add comments">
                        <button type="button" class="btn btn-primary-outline">Post</button>
                     </div>
                  </div>
               </div>
            </div>

</section>