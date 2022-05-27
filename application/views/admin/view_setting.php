<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <h1>Settings Section</h1>
    <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item">Settings</div>
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
                    <li class="nav-item"><a href="#tab_logo" class="nav-link active"
                            data-bs-toggle="tab">Logo</a></li>
                    <li class="nav-item"><a href="#tab_favicon" class="nav-link"
                            data-bs-toggle="tab">Favicon</a></li>
                    <li class="nav-item"><a href="#tab_email" class="nav-link"
                            data-bs-toggle="tab">Mail Settings</a></li>

                    <li class="nav-item"><a href="#tab_other" class="nav-link"
                            data-bs-toggle="tab">General Settings</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_logo">
                        <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                        <div class="box box-info">
                            <div class="box-body">
                                <?php if (file_exists(FCPATH.'public/uploads/'.$setting['logo'])) { ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Existing
                                        Photo</label>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo $setting['logo']; ?>"
                                            class="existing-photo">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">New Photo</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="photo_logo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success pull-left"
                                            name="form_logo">Update Logo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                    <div class="tab-pane" id="tab_favicon">

                        <?php echo form_open_multipart(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Existing
                                        Photo</label>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo $setting['favicon']; ?>"
                                            class="existing-photo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">New Photo</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="photo_favicon">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success pull-left"
                                            name="form_favicon">Update Favicon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>






                    <div class="tab-pane" id="tab_email">
                        <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Send Email From
                                        *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"
                                            name="send_email_from" maxlength="255"
                                            autocomplete="off"
                                            value="<?php echo $setting['send_email_from']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Receive Email To
                                        *</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"
                                            name="receive_email_to" maxlength="255"
                                            autocomplete="off"
                                            value="<?php echo $setting['receive_email_to']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SMTP Active?
                                        *</label>
                                    <div class="col-sm-4">
                                        <select name="smtp_active" class="form-control select2">
                                            <option value="Yes" <?php
                                                if($setting['smtp_active']=='Yes' ) {echo 'selected'
                                                ;} ?>>Yes</option>
                                            <option value="No" <?php
                                                if($setting['smtp_active']=='No' ) {echo 'selected'
                                                ;} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SSL Active?
                                        *</label>
                                    <div class="col-sm-4">
                                        <select name="smtp_ssl" class="form-control select2">
                                            <option value="Yes" <?php if($setting['smtp_ssl']=='Yes'
                                                ) {echo 'selected' ;} ?>>Yes</option>
                                            <option value="No" <?php if($setting['smtp_ssl']=='No' )
                                                {echo 'selected' ;} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SMTP Host </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="smtp_host"
                                            maxlength="255" autocomplete="off"
                                            value="<?php echo $setting['smtp_host']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SMTP Port </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="smtp_port"
                                            maxlength="255" autocomplete="off"
                                            value="<?php echo $setting['smtp_port']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SMTP Username
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="smtp_username"
                                            maxlength="255" autocomplete="off"
                                            value="<?php echo $setting['smtp_username']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">SMTP Password
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="smtp_password"
                                            maxlength="255" autocomplete="off"
                                            value="<?php echo $setting['smtp_password']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success pull-left"
                                            name="form_email">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                    <div class="tab-pane" id="tab_other">
                        <?php echo form_open(base_url().'admin/setting/update',array('class' => 'form-horizontal')); ?>
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Website Title
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" name="website_name" class="form-control"
                                            value="<?php echo $setting['website_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Preloader Status
                                    </label>
                                    <div class="col-sm-4">
                                        <select name="preloader_status"
                                            class="form-control select2">
                                            <option value="On" <?php
                                                if($setting['preloader_status']=='On' )
                                                {echo 'selected' ;} ?>>On</option>
                                            <option value="Off" <?php
                                                if($setting['preloader_status']=='Off' )
                                                {echo 'selected' ;} ?>>Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success pull-left"
                                            name="form_other">Update</button>
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