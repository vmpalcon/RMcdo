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
                    <li class="nav-item"><a href="#tab_other" class="nav-link active"
                            data-bs-toggle="tab">General Settings</a></li>
                    <li class="nav-item"><a href="#tab_logo" class="nav-link"
                            data-bs-toggle="tab">Logo</a></li>
                    <li class="nav-item"><a href="#tab_favicon" class="nav-link"
                            data-bs-toggle="tab">Favicon</a></li>
                    <li class="nav-item"><a href="#tab_email" class="nav-link"
                            data-bs-toggle="tab">Mail Settings</a></li>


                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_other">
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
                                    <label for="" class="col-sm-2 control-label">Upload File Size
                                        Limit
                                    </label>
                                    <div class="col-sm-4">
                                        <select name="file_size_limit" class="form-control select2">
                                            <option value="1MB" <?php
                                                if($setting['file_size_limit']=='1MB' )
                                                {echo 'selected' ;} ?>>1MB</option>
                                            <option value="5MB" <?php
                                                if($setting['file_size_limit']=='5MB' )
                                                {echo 'selected' ;} ?>>5MB</option>
                                            <option value="10MB" <?php
                                                if($setting['file_size_limit']=='10MB' )
                                                {echo 'selected' ;} ?>>10MB</option>
                                            <option value="30MB" <?php
                                                if($setting['file_size_limit']=='30MB' )
                                                {echo 'selected' ;} ?>>30MB</option>
                                            <option value="50MB" <?php
                                                if($setting['file_size_limit']=='50MB' )
                                                {echo 'selected' ;} ?>>50MB</option>
                                            <option value="100MB" <?php
                                                if($setting['file_size_limit']=='100MB' )
                                                {echo 'selected' ;} ?>>100MB</option>
                                            <option value="200MB" <?php
                                                if($setting['file_size_limit']=='200MB' )
                                                {echo 'selected' ;} ?>>200MB</option>
                                            <option value="500MB" <?php
                                                if($setting['file_size_limit']=='500MB' )
                                                {echo 'selected' ;} ?>>500MB</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Timezone
                                    </label>
                                    <div class="col-sm-4">
<select name="timezone" class="form-control select2">
   <option <?php if($setting['timezone']=='' ) {echo 'selected' ;} ?>>-</option>
   <option value="Etc/GMT+12" <?php if($setting['timezone']=='Etc/GMT+12' ) {echo 'selected' ;} ?>>(GMT-12:00) International Date Line West</option>
   <option value="Pacific/Midway" <?php if($setting['timezone']=='Pacific/Midway' ) {echo 'selected' ;} ?>>(GMT-11:00) Midway Island, Samoa</option>
   <option value="Pacific/Honolulu" <?php if($setting['timezone']=='Pacific/Honolulu' ) {echo 'selected' ;} ?>>(GMT-10:00) Hawaii</option>
   <option value="US/Alaska" <?php if($setting['timezone']=='US/Alaska' ) {echo 'selected' ;} ?>>(GMT-09:00) Alaska</option>
   <option value="America/Los_Angeles" <?php if($setting['timezone']=='America/Los_Angeles' ) {echo 'selected' ;} ?>>(GMT-08:00) Pacific Time (US & Canada)</option>
   <option value="America/Tijuana" <?php if($setting['timezone']=='America/Tijuana' ) {echo 'selected' ;} ?>>(GMT-08:00) Tijuana, Baja California</option>
   <option value="US/Arizona" <?php if($setting['timezone']=='US/Arizona' ) {echo 'selected' ;} ?>>(GMT-07:00) Arizona</option>
   <option value="America/Chihuahua" <?php if($setting['timezone']=='America/Chihuahua' ) {echo 'selected' ;} ?>>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
   <option value="US/Mountain" <?php if($setting['timezone']=='US/Mountain' ) {echo 'selected' ;} ?>>(GMT-07:00) Mountain Time (US & Canada)</option>
   <option value="America/Managua" <?php if($setting['timezone']=='America/Managua' ) {echo 'selected' ;} ?>>(GMT-06:00) Central America</option>
   <option value="US/Central" <?php if($setting['timezone']=='US/Central' ) {echo 'selected' ;} ?>>(GMT-06:00) Central Time (US & Canada)</option>
   <option value="America/Mexico_City" <?php if($setting['timezone']=='America/Mexico_City' ) {echo 'selected' ;} ?>>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
   <option value="Canada/Saskatchewan" <?php if($setting['timezone']=='Canada/Saskatchewan' ) {echo 'selected' ;} ?>>(GMT-06:00) Saskatchewan</option>
   <option value="America/Bogota" <?php if($setting['timezone']=='America/Bogota' ) {echo 'selected' ;} ?>>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
   <option value="US/Eastern" <?php if($setting['timezone']=='US/Eastern' ) {echo 'selected' ;} ?>>(GMT-05:00) Eastern Time (US & Canada)</option>
   <option value="US/East-Indiana" <?php if($setting['timezone']=='US/East-Indiana' ) {echo 'selected' ;} ?>>(GMT-05:00) Indiana (East)</option>
   <option value="Canada/Atlantic" <?php if($setting['timezone']=='Canada/Atlantic' ) {echo 'selected' ;} ?>>(GMT-04:00) Atlantic Time (Canada)</option>
   <option value="America/Caracas" <?php if($setting['timezone']=='America/Caracas' ) {echo 'selected' ;} ?>>(GMT-04:00) Caracas, La Paz</option>
   <option value="America/Manaus" <?php if($setting['timezone']=='America/Manaus' ) {echo 'selected' ;} ?>>(GMT-04:00) Manaus</option>
   <option value="America/Santiago" <?php if($setting['timezone']=='America/Santiago' ) {echo 'selected' ;} ?>>(GMT-04:00) Santiago</option>
   <option value="Canada/Newfoundland" <?php if($setting['timezone']=='Canada/Newfoundland' ) {echo 'selected' ;} ?>>(GMT-03:30) Newfoundland</option>
   <option value="America/Sao_Paulo" <?php if($setting['timezone']=='America/Sao_Paulo' ) {echo 'selected' ;} ?>>(GMT-03:00) Brasilia</option>
   <option value="America/Argentina/Buenos_Aires" <?php if($setting['timezone']=='America/Argentina/Buenos_Aires' ) {echo 'selected' ;} ?>>(GMT-03:00) Buenos Aires, Georgetown</option>
   <option value="America/Godthab" <?php if($setting['timezone']=='America/Godthab' ) {echo 'selected' ;} ?>>(GMT-03:00) Greenland</option>
   <option value="America/Montevideo" <?php if($setting['timezone']=='America/Montevideo' ) {echo 'selected' ;} ?>>(GMT-03:00) Montevideo</option>
   <option value="America/Noronha" <?php if($setting['timezone']=='America/Noronha' ) {echo 'selected' ;} ?>>(GMT-02:00) Mid-Atlantic</option>
   <option value="Atlantic/Cape_Verde" <?php if($setting['timezone']=='Atlantic/Cape_Verde' ) {echo 'selected' ;} ?>>(GMT-01:00) Cape Verde Is.</option>
   <option value="Atlantic/Azores" <?php if($setting['timezone']=='America/Tijuana' ) {echo 'selected' ;} ?>>(GMT-01:00) Azores</option>
   <option value="Africa/Casablanca" <?php if($setting['timezone']=='Africa/Casablanca' ) {echo 'selected' ;} ?>>(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
   <option value="Etc/Greenwich" <?php if($setting['timezone']=='Etc/Greenwich' ) {echo 'selected' ;} ?>>(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
   <option value="Europe/Amsterdam" <?php if($setting['timezone']=='Europe/Amsterdam' ) {echo 'selected' ;} ?>>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
   <option value="Europe/Belgrade" <?php if($setting['timezone']=='Europe/Belgrade' ) {echo 'selected' ;} ?>>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
   <option value="Europe/Brussels" <?php if($setting['timezone']=='Europe/Brussels' ) {echo 'selected' ;} ?>>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
   <option value="Europe/Sarajevo" <?php if($setting['timezone']=='Europe/Sarajevo' ) {echo 'selected' ;} ?>>(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
   <option value="Africa/Lagos" <?php if($setting['timezone']=='Africa/Lagos' ) {echo 'selected' ;} ?>>(GMT+01:00) West Central Africa</option>
   <option value="Asia/Amman" <?php if($setting['timezone']=='Asia/Amman' ) {echo 'selected' ;} ?>>(GMT+02:00) Amman</option>
   <option value="Europe/Athens" <?php if($setting['timezone']=='Europe/Athens' ) {echo 'selected' ;} ?>>(GMT+02:00) Athens, Bucharest, Istanbul</option>
   <option value="Asia/Beirut" <?php if($setting['timezone']=='Asia/Beirut' ) {echo 'selected' ;} ?>>(GMT+02:00) Beirut</option>
   <option value="Africa/Cairo" <?php if($setting['timezone']=='Africa/Cairo' ) {echo 'selected' ;} ?>>(GMT+02:00) Cairo</option>
   <option value="Africa/Harare" <?php if($setting['timezone']=='Africa/Harare' ) {echo 'selected' ;} ?>>(GMT+02:00) Harare, Pretoria</option>
   <option value="Europe/Helsinki" <?php if($setting['timezone']=='Europe/Helsinki' ) {echo 'selected' ;} ?>>(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
   <option value="Asia/Jerusalem" <?php if($setting['timezone']=='Asia/Jerusalem' ) {echo 'selected' ;} ?>>(GMT+02:00) Jerusalem</option>
   <option value="Europe/Minsk" <?php if($setting['timezone']=='Europe/Minsk' ) {echo 'selected' ;} ?>>(GMT+02:00) Minsk</option>
   <option value="Africa/Windhoek" <?php if($setting['timezone']=='Africa/Windhoek' ) {echo 'selected' ;} ?>>(GMT+02:00) Windhoek</option>
   <option value="Asia/Kuwait" <?php if($setting['timezone']=='Asia/Kuwait' ) {echo 'selected' ;} ?>>(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
   <option value="Europe/Moscow" <?php if($setting['timezone']=='Europe/Moscow' ) {echo 'selected' ;} ?>>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
   <option value="Africa/Nairobi" <?php if($setting['timezone']=='Africa/Nairobi' ) {echo 'selected' ;} ?>>(GMT+03:00) Nairobi</option>
   <option value="Asia/Tbilisi" <?php if($setting['timezone']=='Asia/Tbilisi' ) {echo 'selected' ;} ?>>(GMT+03:00) Tbilisi</option>
   <option value="Asia/Tehran" <?php if($setting['timezone']=='Asia/Tehran' ) {echo 'selected' ;} ?>>(GMT+03:30) Tehran</option>
   <option value="Asia/Muscat" <?php if($setting['timezone']=='Asia/Muscat' ) {echo 'selected' ;} ?>>(GMT+04:00) Abu Dhabi, Muscat</option>
   <option value="Asia/Baku" <?php if($setting['timezone']=='Asia/Baku' ) {echo 'selected' ;} ?>>(GMT+04:00) Baku</option>
   <option value="Asia/Yerevan" <?php if($setting['timezone']=='Asia/Yerevan' ) {echo 'selected' ;} ?>>(GMT+04:00) Yerevan</option>
   <option value="Asia/Kabul" <?php if($setting['timezone']=='Asia/Kabul' ) {echo 'selected' ;} ?>>(GMT+04:30) Kabul</option>
   <option value="Asia/Yekaterinburg" <?php if($setting['timezone']=='Asia/Yekaterinburg' ) {echo 'selected' ;} ?>>(GMT+05:00) Yekaterinburg</option>
   <option value="Asia/Karachi" <?php if($setting['timezone']=='Asia/Karachi' ) {echo 'selected' ;} ?>>(GMT+05:00) Islamabad, Karachi, Tashkent</option>
   <option value="Asia/Calcutta" <?php if($setting['timezone']=='Asia/Calcutta' ) {echo 'selected' ;} ?>>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
   <option value="Asia/Katmandu" <?php if($setting['timezone']=='Asia/Katmandu' ) {echo 'selected' ;} ?>>(GMT+05:45) Kathmandu</option>
   <option value="Asia/Almaty" <?php if($setting['timezone']=='Asia/Almaty' ) {echo 'selected' ;} ?>>(GMT+06:00) Almaty, Novosibirsk</option>
   <option value="Asia/Dhaka" <?php if($setting['timezone']=='Asia/Dhaka' ) {echo 'selected' ;} ?>>(GMT+06:00) Astana, Dhaka</option>
   <option value="Asia/Rangoon" <?php if($setting['timezone']=='Asia/Rangoon' ) {echo 'selected' ;} ?>>(GMT+06:30) Yangon (Rangoon)</option>
   <option value="Asia/Bangkok" <?php if($setting['timezone']=='Asia/Bangkok' ) {echo 'selected' ;} ?>>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
   <option value="Asia/Krasnoyarsk" <?php if($setting['timezone']=='Asia/Krasnoyarsk' ) {echo 'selected' ;} ?>>(GMT+07:00) Krasnoyarsk</option>
   <option value="Asia/Hong_Kong" <?php if($setting['timezone']=='Asia/Hong_Kong' ) {echo 'selected' ;} ?>>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
   <option value="Asia/Kuala_Lumpur" <?php if($setting['timezone']=='Asia/Kuala_Lumpur' ) {echo 'selected' ;} ?>>(GMT+08:00) Kuala Lumpur, Singapore</option>
   <option value="Asia/Irkutsk" <?php if($setting['timezone']=='Asia/Irkutsk' ) {echo 'selected' ;} ?>>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
   <option value="Australia/Perth" <?php if($setting['timezone']=='Australia/Perth' ) {echo 'selected' ;} ?>>(GMT+08:00) Perth</option>
   <option value="Asia/Taipei" <?php if($setting['timezone']=='Asia/Taipei' ) {echo 'selected' ;} ?>>(GMT+08:00) Taipei</option>
   <option value="Asia/Tokyo" <?php if($setting['timezone']=='Asia/Tokyo' ) {echo 'selected' ;} ?>>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
   <option value="Asia/Seoul" <?php if($setting['timezone']=='Asia/Seoul' ) {echo 'selected' ;} ?>>(GMT+09:00) Seoul</option>
   <option value="Asia/Yakutsk" <?php if($setting['timezone']=='Asia/Yakutsk' ) {echo 'selected' ;} ?>>(GMT+09:00) Yakutsk</option>
   <option value="Australia/Adelaide" <?php if($setting['timezone']=='Australia/Adelaide' ) {echo 'selected' ;} ?>>(GMT+09:30) Adelaide</option>
   <option value="Australia/Darwin" <?php if($setting['timezone']=='Australia/Darwin' ) {echo 'selected' ;} ?>>(GMT+09:30) Darwin</option>
   <option value="Australia/Brisbane" <?php if($setting['timezone']=='Australia/Brisbane' ) {echo 'selected' ;} ?>>(GMT+10:00) Brisbane</option>
   <option value="Australia/Canberra" <?php if($setting['timezone']=='Australia/Canberra' ) {echo 'selected' ;} ?>>(GMT+10:00) Canberra, Melbourne, Sydney</option>
   <option value="Australia/Hobart" <?php if($setting['timezone']=='Australia/Hobart' ) {echo 'selected' ;} ?>>(GMT+10:00) Hobart</option>
   <option value="Pacific/Guam" <?php if($setting['timezone']=='Pacific/Guam' ) {echo 'selected' ;} ?>>(GMT+10:00) Guam, Port Moresby</option>
   <option value="Asia/Vladivostok" <?php if($setting['timezone']=='Asia/Vladivostok' ) {echo 'selected' ;} ?>>(GMT+10:00) Vladivostok</option>
   <option value="Asia/Magadan" <?php if($setting['timezone']=='Asia/Magadan' ) {echo 'selected' ;} ?>>(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
   <option value="Pacific/Auckland" <?php if($setting['timezone']=='Pacific/Auckland' ) {echo 'selected' ;} ?>>(GMT+12:00) Auckland, Wellington</option>
   <option value="Pacific/Fiji" <?php if($setting['timezone']=='Pacific/Fiji' ) {echo 'selected' ;} ?>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
   <option value="Pacific/Tongatapu" <?php if($setting['timezone']=='Pacific/Tongatapu' ) {echo 'selected' ;} ?>>(GMT+13:00) Nuku'alofa</option>
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

                    <div class="tab-pane" id="tab_logo">
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














                </div>
            </div>


        </div>
    </div>

</section>