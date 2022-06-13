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
		<p>Please state your message below to user.</p>
    <select name="cannedmsg" id="cannedmsg">
    <option value="">Select Message Template</option>
  <option value="succ1">Success Message Template 1</option>
  <option value="succ2">Success Message Template 2</option>
  <option value="succ3">Success Message Template 3</option>
 
</select>
		<textarea class="form-control" name="notifymessage" id="notifymessage" rows="3"></textarea>
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
    <select name="declinecannedmsg" id="declinecannedmsg">
    <option value="">Select Message Template</option>
  <option value="dec1">Decline Message Template 1</option>
  <option value="dec2">Decline Message Template 2</option>
  <option value="dec3">Decline Message Template 3</option>
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

<div class="modal fade" id="deletetagsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <form action="" method="post" class="deletetagform-modal">
      <div class="modal-body">
        <p>Are you sure you want to remove this tag connection from this post?</p>
        <p>Untagging: <span class="tagname"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary deletetagbtnmodal" data-decline-id="">OK</button>
        <input type="hidden" name="formremovetag" value="1" />
      </div>
      </form>
    </div>
  </div>
</div>

<!-- alert -->
<div class="modal fade" id="alertModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="alertModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <h2>Discard this post?</h2>
            <p>The video and all edits will be discarded.</p>
            <div class="btn-alert red" onclick="rckymcdo.resetupload(this)"><a href="#">Discard</a>
            </div>
            <div class="btn-alert"><a href="#" data-bs-dismiss="modal" aria-label="Close">Continue
                  editing</a></div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="alertreplaceModal" data-bs-backdrop="static" tabindex="-1"
   aria-labelledby="alertreplaceModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body">
            <h2>Replace this video?</h2>
            <p>Caption and video settings will still be saved.</p>
            <div class="btn-alert red" onclick="rckymcdo.replacevideo(this)"><a href="#">Replace</a>
            </div>
            <div class="btn-alert"><a href="#" data-bs-dismiss="modal" aria-label="Close">Continue
                  editing</a></div>
         </div>
      </div>
   </div>
</div>
<script>
   var baseurl = "<?php echo base_url(); ?>";
</script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/bootstrap5/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/optiscroll/optiscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/select2/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/vendor/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>public/assets/vendor/tagify/jQuery.tagify.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/admin-main.js"></script>
</body>
</html>