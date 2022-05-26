<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
        <div class="content-header-title">
            <h1>For Approval of Photo / Video</h1>
           
        </div>
        <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item">For Approval</div>
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
                                <th>Photo / Video</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($pendingpost_dynamic as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                 
                                  
                                        <img src="<?php echo base_url(); ?>public/assets/img/no-photo1.jpg" title="banner photo" alt="">
                                   
                        
                                    </td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><div class="chip <?php if($row['status']=='Active'){ ?>color-green<?php } else if($row['status']=='Pending') { ?>color-yellow<?php } else { ?>color-red<?php } ?>"><div class="chip-label"><?php echo $row['status']; ?></div></div></td>
                                    <td ><div class="btngroup-action">
                                    <?php if($row['status']=='Pending'): ?>
                                            <a href="#" class="btn btn-purple btn-sm btn-block">Review</a>
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