<section class="rmc--main-content pagepost-section" data-postid="<?php echo $post_details['id']; ?>">
 
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
                           <div class="loader"> <div class="loader-wheel"></div> </div><iframe src="<?php echo $post_details['photovideo']?>&autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=0?playsinline=0" frameborder="0" allow="autoplay;fullscreen;" allowfullscreen="" playsinline=""> </iframe>
                     </video>
                        <?php else: ?>
           <div id="carouselRmxmcdo-modal" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
              <?php 
      $x = 0;
       foreach($post_details['photovideo'] as $row ){ ?>
              <button type="button" data-bs-target="#carouselRmxmcdo-modal"
            data-bs-slide-to="<?php echo $x; ?>" class="<?php if($x==0){ ?>active<?php } ?>" aria-current="true" aria-label="Slide"></button>
                      <?php $x++; } ?>
              </div>
              <div class="carousel-inner">
        <?php 
      $i = 0;
       foreach($post_details['photovideo'] as $row ){
        
        
            ?>
            <div class="carousel-item <?php if($i==0){ ?>active<?php } ?>" data-bs-interval="10000" data-filetype="image"> <img src="<?php echo base_url().'public/uploads/'.$row; ?>" alt="..."> </div>
                      <?php  $i++; } ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselRmxmcdo-modal" data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselRmxmcdo-modal" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
              </button>
           </div>
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
                             
                           <div>
                              <label class="likecheckbox smallsvg" issublike="true" for="" data-post="<?php echo $post_details['id']; ?>">
                                 <div class="label">
                               
                                    <input type="checkbox" id="" <?php if($post_details['isreact']=='1'){ ?>checked="checked"<?php } ?>>
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
                                 <span class="rmc--snippet-text total-like"><?php echo $post_details['totalreact']; ?> </span>
                              </label>
                           </div>
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
                           <input type="text" placeholder="Link URL" name="posturl" value="<?php echo base_url().'post/'.$post_details['slug'];?>">
                           <button type="button" class="btn btn-gray-outline" onclick="rckymcdo.copylink(this)">Copy Link</button>
                        </div>
                     </div>
                     <div class="rmc--photovideo-commentvw">
                     <div class="rmc--commentarea">
                     <ul>

                     </ul>
                     </div>
                  <div class="loader"> <div class="loader-wheel"></div> </div>

                     </div>
                     <div class="rmc--photovideo-msgtool">
                        <input type="text" name="comment" placeholder="Add comments">
                        <button type="button" class="btn btn-primary-outline addcommentbtn" data-post="<?php echo $post_details['id']; ?>">Post</button>
                     </div>
                  </div>
               </div>
            </div>

</section>
