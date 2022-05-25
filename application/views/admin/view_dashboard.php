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
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fa fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Subscribers</h4>
          </div>
          <div class="card-body">
            105
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
        <i class="fa fa-photo-video"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Decline Post</h4>
          </div>
          <div class="card-body">
           9
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
        <i class="fa fa-photo-video"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Pending Post</h4>
          </div>
          <div class="card-body">
            12
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
        <i class="fa fa-photo-video"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Approved Post</h4>
          </div>
          <div class="card-body">
           40
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-dark">
          <i class="fab fa-buysellads"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Advertising</h4>
          </div>
          <div class="card-body">
           12
          </div>
        </div>
      </div>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-info">
          <i class="fa fa-gift"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Sponsor</h4>
          </div>
          <div class="card-body">
           6
          </div>
        </div>
      </div>

    </div>




  </div>


</section>