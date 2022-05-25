<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin');
}
?>
<section class="content-header">
		<h1>Edit Profile</h1>
		<div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item">Edit Profile</div>
    </div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
		<?php
	        if($this->session->flashdata('error')) {
	            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            <?php
	        }
	        if($this->session->flashdata('success')) {
	            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <?php echo $this->session->flashdata('success'); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            <?php
	        }
	        ?>
		</div>
	</div>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">
				
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="nav-item"><a href="#tab_updateinfo" class="nav-link active" data-bs-toggle="tab">Update Information</a></li>
					<li class="nav-item"><a href="#tab_updatephoto" class="nav-link" data-bs-toggle="tab">Update Photo</a></li>
					<li class="nav-item"><a href="#tab_updatepass" class="nav-link" data-bs-toggle="tab">Update Password</a></li>
				</ul>
				<div class="tab-content">

      				<div class="tab-pane active" id="tab_updateinfo">						
						<?php echo form_open(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Email Address <span>*</span></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="email" value="<?php echo $this->session->userdata('email'); ?>">
									</div>			
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Role <span>*</span></label>
									<div class="col-sm-4" style="padding-top:7px;">
										<?php echo $this->session->userdata('role'); ?>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form1">Update Information</button>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
      				</div>


      				<div class="tab-pane" id="tab_updatephoto">
						<?php echo form_open_multipart(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
								
							
								<div class="form-group">
						            <label for="" class="col-sm-2 control-label">Existing Photo</label>
						            <div class="col-sm-6" style="padding-top:6px;">
						            	<?php if($this->session->userdata('photo') ==''): ?>
						            		<img src="<?php echo base_url(); ?>public/assets/img/no-photo.jpg" class="existing-photo" alt="profile photo" width="140">
						            	<?php else: ?>
						            		 <img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>" class="existing-photo" width="140">
						            	<?php endif; ?>							                
						            </div>
						        </div>
							
								<div class="form-group">
						            <label for="" class="col-sm-2 control-label">New Photo</label>
						            <div class="col-sm-6" style="padding-top:6px;">
						                <input type="file" name="photo">
						            </div>
						        </div>
						        <div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form2">Update Photo</button>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
      				</div>


      				<div class="tab-pane" id="tab_updatepass">
						<?php echo form_open(base_url().'admin/profile/update',array('class' => 'form-horizontal')); ?>
						<div class="box box-info">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Password </label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Retype Password </label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="re_password">
									</div>
								</div>
						        <div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form3">Update Password</button>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
      				</div>
      			</div>
			</div>
		</div>
	</div>
</section>