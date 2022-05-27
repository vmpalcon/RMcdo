<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-title">
        <h1>Review Post</h1>

        <div class="content-header-right">
            <a href="<?php echo base_url(); ?>admin/post" class="btn btn-primary btn-sm">View
                All</a>
            <a href="<?php echo base_url(); ?>admin/post/pending"
                class="btn btn-primary btn-sm">View
                Pending</a>
        </div>
    </div>
    <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin/pages">Manage
                Pages</a>
        </div>
        <div class="breadcrumb-item">Edit Page</div>
    </div>

</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php
            if($this->session->flashdata('error')) {
                ?>
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            <?php
            }
            if($this->session->flashdata('success')) {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
            
            <?php
            }
            ?>

            <?php echo form_open_multipart(base_url().'admin/post/review/'.$post_review['id'], array('class' => 'form-horizontal'));?>
            <div class="box box-info">
                <div class="box-body">
                    <div class="row reviewvideowrap">
                        <div class="col-lg-6 rev-videophoto">
                            <?php if($post_review['posttype']=='video'):  ?>
                            <video class="rmc--video"
                                id="rmc-video-<?php echo $post_review['id']; ?>" loop="" controls>
                                <source
                                    src="<?php echo base_url(); ?>public/uploads/<?php echo $post_review['photovideo']; ?>"
                                    type="video/mp4" playsinline="">
                            </video>

                            <?php endif; ?>
                            <?php if($post_review['posttype']=='image'):
                            
                            $vidtool = '&nbsp;';
                            $listimg =  unserialize($post_review['photovideo']);
                            $total = count($listimg);
                            $returnbtn = '';
                            $returnimg = '';
                            for( $i=0 ; $i < $total ; $i++ ) {
                               
                               if($i==0){
                                  $returnbtn .= '<button type="button" data-bs-target="#carouselRmxmcdo'.$post_review["id"].'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" class="active" aria-current="true"></button>';
                                  $returnimg .= '<div class="carousel-item active" data-bs-interval="10000"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
                               } else {
                                  $returnbtn .= '<button type="button" data-bs-target="#carouselRmxmcdo'.$post_review["id"].'" data-bs-slide-to="'.$i.'" aria-label="Slide '.$i.'" aria-current="true"></button>';
                                  $returnimg .= '<div class="carousel-item" data-bs-interval="10000"> <img src="'.base_url().'public/uploads/'.$listimg[$i].'" alt="..."> </div>';
                               }
                               
                           }
                            
                          

                            ?>
                           <div id="carouselRmxmcdo<?php echo $post_review["id"]; ?>" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
         <?php echo $returnbtn; ?>
         </div>
         <div class="carousel-inner">
         <?php echo $returnimg; ?>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselRmxmcdo<?php echo $post_review["id"]; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselRmxmcdo<?php echo $post_review["id"]; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Title:</label>
                                <div class="col-sm-9">
                                    <?php echo $post_review['title']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">URL:</label>
                                <div class="col-sm-9">
                                    <a href="<?php echo base_url().'video/'.$post_review['slug']; ?>"
                                        target="_blank">
                                        <?php echo base_url().'video/'.$post_review['slug']; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Video Type:</label>
                                <div class="col-sm-9">
                                    <span class="captxt">
                                        <?php echo $post_review['posttype']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Privacy:</label>
                                <div class="col-sm-9">
                                    <span class="captxt">
                                        <?php echo $post_review['privacy']; ?>
                                    </span>
                                </div>
                            </div>
                            <?php if($post_review['status']=='Decline'): ?>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Reason for declining:</label>
                                <div class="col-sm-9" style="margin-top:5px;">
                                <?php echo $post_review['message']; ?>
                                    
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Status:</label>
                                <div class="col-sm-9" style="margin-top:5px;">

                                    <div class="chip <?php if($post_review['status']=='Active' ){ ?>
                                        color-green
                                        <?php } else if($post_review['status']=='Pending') { ?>color-yellow
                                        <?php } else { ?>color-red
                                        <?php } ?>">
                                        <div class="chip-label">
                                            <?php echo $post_review['status']; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <?php if($post_review['status']=='Pending'): ?>
                            <div class="review-button-list">

                                <div class="col-sm-12 text-center mt-4">
                                    <button type="button" class="btn btn-success pull-left"
                                        name="formapproved" data-bs-toggle="modal" data-bs-target="#approvalModal" data-approve-id="<?php echo $post_review['id']; ?>" data-action-url="<?php echo base_url() ?>admin/post/review/<?php echo $post_review['id']; ?>">Approve Post</button>

                                    <button type="button" class="btn btn-danger pull-left" data-bs-toggle="modal" data-bs-target="#declineModal" data-approve-id="<?php echo $post_review['id']; ?>"
                                        name="formdecline">Decline Post</button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</section>