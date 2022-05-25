<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
$error_message = '';
$success_message = '';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php
    $CI =& get_instance();
    $CI->load->model('Model_common');
    $all_setting = $CI->Model_common->all_setting();
    $class_name = '';
    $segment_2 = 0;
    $segment_3 = 0;
    $class_name = $this->router->fetch_class();
    $segment_2 = $this->uri->segment('2');
    $segment_3 = $this->uri->segment('3');

    if($class_name == 'home')
    {
        echo '<meta name="description" content="desc">';
        echo '<meta name="keywords" content="keywords">';
        echo '<title>RockyMountains x McDo</title>';
    }
   
    ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/uploads/<?php echo $setting['favicon']; ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/styles.css">
   
</head>

<body class="bd-init">
