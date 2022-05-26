<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin');
}

?>
<section class="content-header">
  <h1>Dashboard</h1>
</section>

<section class="content">

  <div class="row">

    <div class="col-md-4 col-sm-6 col-xs-12">
      <a href="<?php echo base_url(); ?>admin/users" class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Users</h4>
          </div>
          <div class="card-body">
            <?php echo $total_users ?>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <a href="<?php echo base_url(); ?>admin/post/pending" class="card card-statistic-1">
        <div class="card-icon bg-danger">
        <i class="fa fa-photo-video"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>For Approval of Post</h4>
          </div>
          <div class="card-body">
          <?php echo $total_pending ?>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <a href="<?php echo base_url(); ?>admin/pages" class="card card-statistic-1">
        <div class="card-icon bg-warning">
        <i class="far fa-file-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Pages</h4>
          </div>
          <div class="card-body">
          <?php echo $total_pages ?>
          </div>
        </div>
      </a>
    </div>




  </div>


</section>