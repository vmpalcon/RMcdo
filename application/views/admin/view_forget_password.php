<?php
$CI =& get_instance();
$CI->load->model('admin/Model_common');
$setting_data = $CI->Model_common->get_setting_data();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Forget Password</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
		name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/admin-styles.css">
</head>

<body class="bd-init">

	<div class="login-box">
		<div class="login-logo">
			<b>
				<?php echo $setting_data['website_name']; ?> - Admin Panel
			</b>
		</div>
		<div class="login-box-body">
			<h4 class="login-box-msg">Reset Password</h4>

			<?php
        if($this->session->flashdata('error')) {
            echo '<div class="error">'.$this->session->flashdata('error').'</div>';
        }
        if($this->session->flashdata('success')) {
            echo '<div class="success">'.$this->session->flashdata('success').'</div>';
        }
        ?>

			<?php echo form_open(base_url().'admin/forget-password');?>
			<div class="form-group has-feedback">
				<input class="form-control" placeholder="Email address" name="email" type="text"
					autocomplete="off" autofocus>
			</div>
			<div class="row">
				<div class="col-xs-8 fp-btn"><a
						href="<?php echo base_url(); ?>admin/login">Back to login
						page</a></div>
				<div class="col-xs-4">
					<input type="submit" class="btn btn-primary btn-block btn-flat login-button"
						name="form1" value="Submit">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>


	<script src="<?php echo base_url(); ?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/bootstrap5/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/optiscroll/optiscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/admin-main.js"></script>
</body>

</html>