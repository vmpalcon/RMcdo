<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin');
}
?>

<section class="content-header">
<div class="content-header-title">
            <h1>View All Users</h1>
            <div class="content-header-right">
                    <a href="<?php echo base_url(); ?>admin/users/add" class="btn btn-primary btn-sm">Add New</a>
                </div>
        </div>
    <div class="content-header-breadcrumb">
        <div class="breadcrumb-item active"><a
                href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item">Manage Users</div>
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

					<table id="tablelist" class="table table-bordered table-striped" data-export-title="List of Users">
						<thead>
							<tr>
								<th>#</th>
								<th>Photo</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Status</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($users as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:150px;"><img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['firstname']; ?>" style="width:100px;"></td>
									<td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['role']; ?></td>
									<td><div class="chip <?php if($row['status']=='Active'){ ?>color-green<?php } else { ?>color-red<?php } ?>"><div class="chip-label"><?php echo $row['status']; ?></div></div></td>
									<td><div class="btngroup-action">									
										<a href="<?php echo base_url(); ?>admin/users/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/users/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
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