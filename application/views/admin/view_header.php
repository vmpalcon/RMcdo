<?php
if($this->session->userdata('role')=='User'){
  redirect(base_url());
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/admin-styles.css">
</head>

<body class="bd-init">
<div class="linear-activity">
      <div class="indeterminate"></div>
   </div>
<div class="app">
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
<?php
			$class_name = '';
		    $segment_2 = 0;
		    $segment_3 = 0;
		    $class_name = $this->router->fetch_class();
		    $segment_2 = $this->uri->segment('2');
		    $segment_3 = $this->uri->segment('3');
		?>
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" class="nav-link nav-link-lg nav-mainmenu"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="nav-link ">
					<a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-dark">Visit Website</a>
                </li>
                <li class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
					<div><?php if($this->session->userdata('photo') == ''): ?>
									<img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg" class="rounded-circle mr-1" alt="user photo">
								<?php else: ?>
									<img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>" class="rounded-circle mr-1" alt="user photo">
								<?php endif; ?>
								</div>
                        <div class="d-lg-inline-block"><?php echo $this->session->userdata('firstname'); ?> <?php echo $this->session->userdata('lastname'); ?></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
					<a href="<?php echo base_url(); ?>admin/profile" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit Profile</a>
                        
                        <a href="<?php echo base_url(); ?>admin/login/logout" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        
                    </div>
                </li>
            </ul>
        </nav>
	<div class="main-sidebar">
	<ul class="sidebar-menu">
	<li class="menu-header">Main Navigation</li>
	<li class="nav-item <?php if($class_name == 'dashboard') {echo 'active';} ?>">
		<a href="<?php echo base_url(); ?>admin/dashboard">
			<i class="fas fa-fire"></i>
			<span>Dashboard</span>
		</a>
	</li>
	<li class="nav-item dropdown <?php if( ($class_name == 'users') ) {echo 'active';} ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fa fa-users"></i> <span>Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link <?php if( ($segment_2 == 'users' && $segment_3 == 'add') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/users/add">Add User</a></li>
          <li><a class="nav-link <?php if( ($segment_2 == 'users' && $segment_3 == '') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/users">Manage Users</a></li>
        </ul>
      </li>
	<li class="nav-item dropdown <?php if( ($class_name == 'post') ) {echo 'active';} ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fa fa-photo-video"></i> <span>Posting</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link <?php if( ($segment_2 == 'post' && $segment_3 == 'pending') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/post/pending">For Approval</a></li>
          <li><a class="nav-link <?php if( ($segment_2 == 'post' && $segment_3 == '') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/post">All Post</a></li>
        </ul>
      </li>
	<li class="nav-item dropdown <?php if( ($class_name == 'pages') ) {echo 'active';} ?>">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Pages</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link <?php if( ($segment_2 == 'pages' && $segment_3 == 'add') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/pages/add">Add New Page</a></li>
          <li><a class="nav-link <?php if( ($segment_2 == 'pages' && $segment_3 == '') ) {echo 'active';} ?>" href="<?php echo base_url(); ?>admin/pages">Manage Pages</a></li>
        </ul>
      </li>
	<li class="menu-header">General Settings </li>
	<li class="nav-item <?php if( ($class_name == 'setting') ) {echo 'active';} ?>">
		<a href="<?php echo base_url(); ?>admin/setting">
			 <i class="fa fa-cog"></i> <span>Settings</span>
		</a>
	</li>

</ul>
	</div>
</div>

<div class="main-content">
