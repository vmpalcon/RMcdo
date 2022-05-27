		</div>

	</div>
		<!-- Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approval of Video: </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="approveform-modal">
      <div class="modal-body">
        <p>Are you sure you want to approve this post?</p>

      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary approvebtnmodal" data-approve-id="" data-action-url="">Approved</button>
        <input type="hidden" name="statusoption" value="1">
    
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Decline of Video: </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" class="approveform-modal">
      <div class="modal-body">
        <p>You are about to decline this post.</p>
		<p>Please state your message below to user why you need to decline this post.</p>
		<textarea class="form-control" name="notifymessage" id="notifymessage" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger approvebtnmodal" data-decline-id="">Decline</button>
        <input type="hidden" name="statusoption" value="0">
      </div>
      </form>
    </div>
  </div>
</div>
	<script src="<?php echo base_url(); ?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/bootstrap5/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/optiscroll/optiscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/select2/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/admin-main.js"></script>
</body>
</html>