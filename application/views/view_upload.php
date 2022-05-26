<?php
if(!$this->session->userdata('id')) {
	redirect(base_url());
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
                  <form action="<?php echo base_url().'upload/process'; ?>" id="submit_post" method="POST"
                              enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-lg-12">
                           <span class="msgoutput"></span>
                        </div>
                        <div class="col-lg-4">
                            
                              <input type="hidden" name="videotype" class="videotype">
                              <div class="load-area">
                                 <div class="video-upload-input-area">
                                    <label class="text-center">
                                       <div class="info-star">
                                          <h5>Select Video / Image
                                             to upload</h5>
                                          <p>MP4 or WebM<br />
                                             720x1280 resolution or higher<br />
                                             Up to 10 minutes<br />
                                             Less than 2 GB</p>
                                          <div><button type="button" class="btn btn-primary"
                                                onclick="rckymcdo.triggerupload(this)"> Select
                                                File</button></div>
                                       </div>
                                    </label>
                                    <input type="file" name="files[]" class="d-none" id="video_upload"
                                       multiple>
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
                                 <div id="carouselRmxmcdo" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-indicators">

                                    </div>
                                    <div class="carousel-inner">

                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                       data-bs-target="#carouselRmxmcdo" data-bs-slide="prev">
                                       <span class="carousel-control-prev-icon"
                                          aria-hidden="true"></span>
                                       <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                       data-bs-target="#carouselRmxmcdo" data-bs-slide="next">
                                       <span class="carousel-control-next-icon"
                                          aria-hidden="true"></span>
                                       <span class="visually-hidden">Next</span>
                                    </button>
                                 </div>
                              </div>
                   
                        </div>
                        <div class="col-lg-8">
                        
                              <div class="form-group">
                                 <label for="caption">Caption</label>
                                 <input type="text" name="caption"
                                    class="form-control txtcaption" />
                              </div>
                              <div class="form-group">
                                 <label>Who can view this video</label>
                                 <select class="form-select" name="privacytype">
                                    <option selected value="public">Public</option>
                                    <option value="private">Private</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Allow users to:</label>
                                 <div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox"
                                          id="chk_comment" checked>
                                       <label class="form-check-label"
                                          for="chk_comment">Comment</label>
                                    </div>

                                 </div>
                              </div>
                              <div class="form-group videocopytext">
                                 <label>Run a copyright check</label>
                                 <p>We'll check your video for potential copyright infringements on
                                    used sounds. This post is subject for approval and will informed you once approved.</p>
                              </div>
                              <div class="submit-post-action f-right">
                                 <button type="button" class="btn btn-gray-outline btndiscardvideo"
                                    data-bs-toggle="modal"
                                    data-bs-target="#alertModal">Discard</button>
                                 <button type="button" class="btn btn-primary btnpostvideo"
                                    disabled><span>Post</span></button>
                              </div>
                          <input type="hidden" name="postvideoform">
                        </div>
                     </div>
                     <!-- end row -->
</form>
                  </div>
               </div>
            </div>
         </div>
      </section>