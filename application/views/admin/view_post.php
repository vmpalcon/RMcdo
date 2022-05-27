<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
        <div class="content-header-title">
            <h1>Manage All Posted Photo / Video</h1>
           
        </div>
        <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item">All Post</div>
    </div>

   
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php
            if($this->session->flashdata('error')) {
                ?>
                <div class="callout callout-danger">
                    <p><?php echo $this->session->flashdata('error'); ?></p>
                </div>
                <?php
            }
            if($this->session->flashdata('success')) {
                ?>
                <div class="callout callout-success">
                    <p><?php echo $this->session->flashdata('success'); ?></p>
                </div>
                <?php
            }
            ?>
           
            <div class="box box-info">
                <div class="box-body table-responsive">
                
                    <table id="tablelist" class="table table-bordered table-striped" data-export-title="List of Pages">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Photo / Video</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Date Posted</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($post_dynamic as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><span class="captxt"><b><?php echo $row['posttype']; ?></b></span></td>
                                    <td>
                                 
                                    <?php if($row['posttype']=='video'):  ?>
                                        <video class="rmc--video" id="rmc-video-<?php echo $row['id']; ?>" loop="" muted="muted" onmouseover="mouseover('rmc-video-<?php echo $row['id']; ?>')" onmouseout="mouseout('rmc-video-<?php echo $row['id']; ?>')" >
                                            <source src="<?php echo base_url(); ?>public/uploads/<?php echo $row['photovideo']; ?>" type="video/mp4" playsinline="">
                                        </video>
                                       
                                    <?php endif; ?>
                                    <?php if($row['posttype']=='image'):
                            $listimg = unserialize($row['photovideo']);
                            ?>
                            <img
                                src="<?php echo base_url(); ?>public/uploads/<?php echo $listimg[0]; ?>" />
                               
                            <?php endif; ?>
                        
                                    </td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><div class="chip <?php if($row['status']=='Active'){ ?>color-green<?php } else if($row['status']=='Pending') { ?>color-yellow<?php } else { ?>color-red<?php } ?>"><div class="chip-label"><?php echo $row['status']; ?></div></div></td>
                                    <td><div class="btngroup-action">
                                    <?php if($row['status']=='Pending'): ?>
                                            <a href="<?php echo base_url(); ?>admin/post/review/<?php echo $row['id']; ?>" class="btn btn-purple btn-sm btn-block">Review</a>
                                            <?php endif; ?>
                                            <?php if($row['status']!='Pending'): ?>

                                        <a href="<?php echo base_url(); ?>admin/post/review/<?php echo $row['id']; ?>" class="btn btn-warning btn-sm btn-block" >View</a>
                                       <!-- <a href="<?php echo base_url(); ?>admin/post/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-block" onClick="return confirm('Are you sure?');">Delete</a>-->
                                        <?php endif; ?>
                                    </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>