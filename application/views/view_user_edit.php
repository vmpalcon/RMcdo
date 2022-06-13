<?php
if(!$this->session->userdata('id')) {
	redirect(base_url());
}

?>

<section class="user-section">
  <div class="container">

    <div class="row settings-area">

      <div class="col-md-3">
        <div class="user-settings-info text-center">
          <div class="user-img">
            <?php if (file_exists(FCPATH.'public/uploads/'.$userdetail['photo']) && $userdetail['photo']!='') { ?>
            <img src="<?php echo base_url(); ?>public/uploads/<?php echo $userdetail['photo']; ?>"
              title="<?php echo $row['firstname']; ?>" alt="">
            <?php } else { ?>
            <img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg" title="no photo"
              alt="">
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-md-9">

        <div class="settings-menu">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#nav-general"
                class="nav-link active" href="#">General</a></li>

            <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#nav-password" href="#"
                class="nav-link">Password</a></li>
          </ul>
        </div>
        <div class="product-info-tab">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="nav-general">
              <form action="" method="POST" class="setting_form">

                <div class="card-section">
                  <div class="row equal-cols">
                    <div class="col-md-6">
                      <h6>Username</h6>

                      <input type="text" id="username" class="login-form-control" name="username"
                        placeholder="Username" value="<?php echo $userdetail['username']; ?>">

                    </div>
                    <div class="col-md-6">
                      <h6>Email</h6>

                      <input type="text" id="email" class="login-form-control" name="email"
                        placeholder="Email" value="<?php echo $userdetail['email']; ?>">

                    </div>
                    <div class="col-md-6">

                      <h6>First Name</h6>

                      <div>
                        <input type="text" id="first_name" class="login-form-control"
                          name="firstname" placeholder="First Name"
                          value="<?php echo $userdetail['firstname']; ?>">
                      </div>

                    </div>
                    <div class="col-md-6">
                      <h6>Last Name</h6>
                      <div>
                        <input type="text" id="last_name" class="login-form-control" name="lastname"
                          placeholder="Last Name" value="<?php echo $userdetail['lastname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h6>About Me</h6>
                      <div>
                        <textarea name="bio" cols="7" rows="5"
                          placeholder="About Me"><?php echo $userdetail['bio']; ?></textarea>
                      </div>

                    </div>
                    <div class="col-md-12">
                      <div class="save-button text-center mt-3">
                        <button class="usersettings_update btn btn-primary"
                          type="submit">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-password">
              <form action="" method="POST" class="setting_form">

                <div class="card-section">
                  <div class="row equal-cols">
                    <div class="col-md-12">
                      <h6>Current Password</h6>
                      <div class="login-form-gorup">
                        <input type="password" id="current_password" name="current_password"
                          class="login-form-control" placeholder="Current Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h6>New Password</h6>
                      <div class="login-form-gorup">
                        <input type="password" id="password" name="password"
                          class="login-form-control" placeholder="New Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <h6>Confirm Password</h6>
                      <div class="login-form-gorup">
                        <input type="password" id="password_confirmation"
                          name="password_confirmation" class="login-form-control"
                          placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="save-button text-center mt-3">
                        <button class="usersettings_update btn btn-primary"
                          type="submit">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>

  </div>
</section>