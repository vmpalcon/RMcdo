<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
        <div class="content-header-title">
            <h1>View All Pages</h1>
            <div class="content-header-right">
                    <a href="<?php echo base_url(); ?>admin/pages/add" class="btn btn-primary btn-sm">Add New</a>
                </div>
        </div>
        <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item">Manage Pages</div>
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
                                <th>SL</th>
                                <th>Banner</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($page_dynamic as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                 
                                    <?php if (file_exists(FCPATH.'public/uploads/'.$row['banner'])) { ?>
                                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['banner']; ?>" title="banner photo" alt="">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url(); ?>public/assets/img/no-photo1.jpg" title="banner photo" alt="">
                                    <?php } ?>
                        
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['lang_name']; ?></td>
                                    <td><div class="btngroup-action">
                                        <a href="<?php echo base_url(); ?>admin/pages/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-sm btn-block">Edit</a>
                                        <a href="<?php echo base_url(); ?>admin/pages/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-block" onClick="return confirm('Are you sure?');">Delete</a>
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