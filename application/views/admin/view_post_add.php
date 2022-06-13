<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>



<section id="nav-upload">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="video-upload-title">
               <h2>Upload Video / Image</h2>
               <p>Post a Video / Image to your account</p>
            </div>
            <div class="custom-form">
               <form action="<?php echo base_url().'upload/process'; ?>" id="submit_post"
                  method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-lg-12">
                        <span class="msgoutput"></span>
                     </div>
                     <div class="col-lg-4">

                        <input type="hidden" name="videotype" class="videotype">
                        <div class="load-area">
                           <div class="video-upload-input-area">
                              <div class="text-center filewrapper">
                                 <div class="info-star">
                                    <div class="form-group">
                                       <label>Select upload files</label>
                                       <select class="form-select" name="posttype">
                                          <option selected value="video">Video</option>
                                          <option value="image">Image</option>
                                       </select>
                                    </div>
                                    <div>
                                       <p><span>Allowed File Type:<br />
                                             <span class="filetypeallow"><b>MP4</b>,
                                                <b>WebM</b></span><br />
                                             Maximum file size is <b>
                                                <?php echo $setting['file_size_limit']; ?>
                                             </b></p>
                                       <div><button type="button" class="btn btn-primary"
                                             onclick="rckymcdo.triggerupload(this)"> Select
                                             File</button></div>

                                    </div>

                                 </div>
                              </div>
                              <div class="generating-preview">

                              </div>
                              <input type="file" name="files[]" class="d-none" id="photo_upload" accept="image/png, image/gif, image/jpeg"
                                 multiple>
                              <input type="file" name="videofile" class="d-none" id="video_upload"
                                 accept="video/mp4, video/webm">
                           </div>

                        </div>

                        <div class="preview-area">
                           <div class="preview-area-video">
                              <video id="previewvideo" controls></video>
                           </div>
                           <div class="videopreview-info">
                              <div class="videopreview-title"></div>
                              <div class="videopreview-changevideo"><a href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#alertreplaceModal">Change
                                    video</a></div>
                           </div>
                        </div>

                        <div class="photopreview-area">
                           <div id="carouselRmxmcdo" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-indicators">

                              </div>
                              <div class="carousel-inner">

                              </div>
                              <button class="carousel-control-prev" type="button"
                                 data-bs-target="#carouselRmxmcdo" data-bs-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button"
                                 data-bs-target="#carouselRmxmcdo" data-bs-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="visually-hidden">Next</span>
                              </button>
                           </div>
                        </div>

                     </div>
                     <div class="col-lg-8">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group position-relative">
                                 <label for="caption">Caption</label>
                                 <input type="text" name="caption" class="form-control txtcaption"
                                    maxlength="150" />
                                 <span class="text-limit"><span id="rchars">0</span> / 150</span>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="caption">Tags</label>
                                 <input type="text" name="tags" class="form-control" />
                                 <div class="notetext">Only letters, numbers, dashed are allowed.</div>
                              </div>
                           </div>
                           <div <?php if($this->session->userdata('role')== 'Admin') : ?>class="col-lg-6"<?php else: ?>class="col-lg-12"<?php endif; ?>>
                              <div class="form-group">
                                 <label>Who can view this video</label>
                                 <select class="form-select" name="privacytype">
                                    <option selected value="public">Public</option>
                                    <option value="private">Private</option>
                                 </select>
                              </div>
                           </div>
                           <div <?php if($this->session->userdata('role')== 'Admin') : ?>class="col-lg-6"<?php else: ?>class="col-lg-12"<?php endif; ?>>
                              <div class="form-group">
                                 <label>Allow users to:</label>
                                 <div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox"
                                          id="chk_comment" name="iscomment" checked>
                                       <label class="form-check-label"
                                          for="chk_comment">Comment</label>
                                    </div>

                                 </div>
                              </div>
                           </div>
                           <?php if($this->session->userdata('role')== 'Admin') : ?>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Status</label>
                                 <select class="form-select" name="status">
                                    <option value="Active">Approved</option>
                                    <option selected value="Pending">Pending</option>
                                    <option value="Decline">Decline</option>
                                 </select>
                              </div>
                           </div>
                           <?php endif; ?>
                           <div class="col-lg-12">
                              <div class="submit-post-action f-right mt-3">
                                 <button type="button" class="btn btn-gray-outline btndiscardvideo"
                                    data-bs-toggle="modal"
                                    data-bs-target="#alertModal">Discard</button>
                                 <button type="button" class="btn btn-primary btnpostvideo"
                                    disabled><span>Post</span></button>
                              </div>
                              <input type="hidden" name="postvideoform">
                           </div>
                        </div>

                     </div>
                  </div>
                  <!-- end row -->
               </form>
            </div>
         </div>
      </div>
   </div>
</section>