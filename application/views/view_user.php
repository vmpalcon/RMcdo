<section class="user-section">
   <div class="container">

      <div class="user-header-wrapper">
         <div class="user-header-inner">
            <div class="uh-left">
               <div class="uh-image">
                  <?php if (file_exists(FCPATH.'public/uploads/'.$userdetail['photo']) && $userdetail['photo']!='') { ?>
                  <img
                     src="<?php echo base_url(); ?>public/uploads/<?php echo $userdetail['photo']; ?>"
                     title="<?php echo $row['firstname']; ?>" alt="" class="uh-image-inner">
                  <?php } else { ?>
                  <img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg"
                     title="no photo" alt="" class="uh-image-inner">
                  <?php } ?>
                  <div class="gradient"></div>
               </div>
            </div>
            <div class="uh-right">
               <div class="user-info">
                  <div>
                     <h3>
                        <?php echo $userdetail['username']; ?>
                        <?php if($this->session->userdata('isverified') == 1){ ?>
                        <span><img
                              src="<?php echo base_url(); ?>public/assets/img/svg/user-check.svg"
                              alt="" /></span>
                        <?php } ?>
                     </h3>
                  </div>
                  <div>
                     <?php if($this->session->userdata('id') == $userdetail['id']): ?><a
                        href="<?php echo base_url(); ?>edit/profile" class="btn btn-primary">Edit
                        Profile</a>
                     <?php endif; ?>
                     <?php if($this->session->userdata('id') != $userdetail['id']): ?><button
                        class="btn btn-primary">Follow</button>
                     <?php endif; ?>
                  </div>
               </div>
               <div class=user-links>
                  <a><span class="totalpost">
                        <?php echo count($totalpost); ?>
                     </span> Posts</a>
                  <a><span class="totalfollower">0</span> Followers</a>
                  <a>Following <span class="totalfollowing">0</span></a>
               </div>
               <div class="user-bio">
                  <p class="user-bio-name">
                     <?php echo $userdetail['firstname'].' '.$userdetail['lastname']; ?>
                  </p>
                  <p class="user-bio-text">
                     <?php echo $userdetail['bio']; ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="user-page-wrapper">

      <div class="user-page-inner">




      </div>

   </div>
   <div class="timeline-preloader">
      <div class="spinner"></div>
   </div>
   <div class="space"></div>

   </div>
</section>