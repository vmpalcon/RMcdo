/*!
 * Web Projects
 * Copyright © 2022 Purplepatch Services LLC.
 */
$('body').removeClass('bd-init');
var rckymcdoadmin = {
  preloader: function (val) {
    if (val == 'show') {
      $('.linear-activity').show();
    } else if (val == 'hide') {
      $('.linear-activity').hide();
    } else {
      alert('Unknow value: ' + val);
    }
  },
};
/*------------------------
        Video Mouseover
    -----------------------------*/
function mouseover(id) {
  var getid = document.getElementById(id);
  var mediaPlayer;
  let slowInternetTimeout = null;
  let threshold = 500;

  getid.addEventListener('waiting', () => {
    slowInternetTimeout = setTimeout(() => {
      $('.loader' + id).removeClass('d-none');
    }, threshold);
  });
  getid.addEventListener('playing', () => {
    if (slowInternetTimeout != null) {
      clearTimeout(slowInternetTimeout);
      slowInternetTimeout = null;
    }
  });
  getid.addEventListener('canplay', () => {
    $('.loader' + id).addClass('d-none');
  });
  mediaPlayer = getid;
  mediaPlayer.play();
}

/*-------------------
              Video Mouseout
          -------------------------*/
function mouseout(id) {
  var mediaPlayer;
  mediaPlayer = document.getElementById(id);
  mediaPlayer.pause();
}
/*-------------------
   Check Mime file type
-------------------------*/
function loadMime(file, callback) {
  var mimes = [
    {
      mime: 'image/jpeg',
      pattern: [0xff, 0xd8, 0xff],
      mask: [0xff, 0xff, 0xff],
    },
    {
      mime: 'image/png',
      pattern: [0x89, 0x50, 0x4e, 0x47],
      mask: [0xff, 0xff, 0xff, 0xff],
    },
    {
      mime: 'image/gif',
      pattern: [0x47, 0x49, 0x46, 0x38, 0x37, 0x61],
      mask: [0xff, 0xff, 0xff, 0xff, 0xff, 0xff],
    },
    {
      mime: 'image/gif',
      pattern: [0x47, 0x49, 0x46, 0x38, 0x39, 0x61],
      mask: [0xff, 0xff, 0xff, 0xff, 0xff, 0xff],
    },
    // you can expand this list @see https://mimesniff.spec.whatwg.org/#matching-an-image-type-pattern
  ];

  function check(bytes, mime) {
    for (var i = 0, l = mime.mask.length; i < l; ++i) {
      if ((bytes[i] & mime.mask[i]) - mime.pattern[i] !== 0) {
        return false;
      }
    }
    return true;
  }

  var blob = file.slice(0, 4); //read the first 4 bytes of the file

  var reader = new FileReader();
  reader.onloadend = function (e) {
    if (e.target.readyState === FileReader.DONE) {
      var bytes = new Uint8Array(e.target.result);

      for (var i = 0, l = mimes.length; i < l; ++i) {
        if (check(bytes, mimes[i])) return callback({ mimetype: mimes[i].mime, mimefile: file });
      }

      return callback('unknown');
    }
  };
  reader.readAsArrayBuffer(blob);
}

$(document).ready(function () {
  if ($('.select2')[0]) {
    $('.select2').select2();
  }
  if ($('#tablelist')[0]) {
    var buttonCommon = {
      init: function (dt, node, config) {
        var table = dt.table().context[0].nTable;
        if (table) config.title = $(table).data('export-title');
      },
      title: 'default title',
    };
    $.extend($.fn.dataTable.defaults, {
      buttons: [
        $.extend(true, {}, buttonCommon, {
          extend: 'excelHtml5',
          exportOptions: {
            columns: ':visible',
          },
        }),
        $.extend(true, {}, buttonCommon, {
          extend: 'print',
          exportOptions: {
            columns: ':visible',
          },
          orientation: 'landscape',
        }),
      ],
    });
    $('#tablelist').DataTable();
  }
});

$(document).on('click', '.nav-tabs .nav-link', function (e) {
  e.preventDefault();
  console.log($(this).attr('href'));
  if ($(this).attr('href') != undefined && $(this).attr('href') != null && $(this).attr('href') != '#') {
    localStorage.setItem('activeTab', $(this).attr('href'));
  }
});
var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
  if (activeTab != undefined && activeTab != null && activeTab != '#') {
    if ($(activeTab)[0]) {
      $('.nav-tabs li a.nav-link').removeClass('active');
      $('.nav-tabs li a.nav-link').each(function () {
        if ($(this).attr('href') === activeTab) {
          $(this).addClass('active');
        }
      });
      $('.tab-content .tab-pane').removeClass('active');
      $(activeTab).addClass('active');
    }
  }
}
$(document).on('click', '.sidebar-menu > .dropdown > a.nav-link', function (e) {
  e.preventDefault();
  $('.sidebar-menu > li:not(.dropdown)').removeClass('active');
  $(this).parent().toggleClass('active');
});
$(document).on('click', '.nav-mainmenu', function (e) {
  e.preventDefault();
  $('body').toggleClass('showmenu');
});

$('#approvalModal').on('show.bs.modal', function (event) {
  var videophotoid = $(event.relatedTarget).attr('data-approve-id');
  var vidurl = $(event.relatedTarget).attr('data-action-url');
  if (typeof videophotoid !== 'undefined' && videophotoid !== false) {
    $(this).find('.approvebtnmodal').attr('data-approve-id', videophotoid);
    $('#approvalModal')
      .find('.approveform-modal')
      .append(
        "<input type='hidden' name='photovideoid' value='" + videophotoid + "' /> <input type='hidden' name='formapprove' value='true' />",
      );
  }
  if (typeof vidurl !== 'undefined' && vidurl !== false) {
    $('#approvalModal').find('.approveform-modal').attr('action', vidurl);
  }
});

$('#approvalModal').on('hide.bs.modal', function (event) {
  $('#approvalModal').find('.approveform-modal').find('input[name="photovideoid"]').remove();
  $('#approvalModal').find('.approveform-modal').find('input[name="formapprove"]').remove();
});

$('#declineModal').on('show.bs.modal', function (event) {
  var videophotoid = $(event.relatedTarget).attr('data-approve-id');
  var vidurl = $(event.relatedTarget).attr('data-action-url');
  if (typeof videophotoid !== 'undefined' && videophotoid !== false) {
    $(this).find('.approvebtnmodal').attr('data-approve-id', videophotoid);
    $('#declineModal')
      .find('.approveform-modal')
      .append(
        "<input type='hidden' name='photovideoid' value='" + videophotoid + "' /> <input type='hidden' name='formapprove' value='true' />",
      );
  }
  if (typeof vidurl !== 'undefined' && vidurl !== false) {
    $('#declineModal').find('.approveform-modal').attr('action', vidurl);
  }
});

$('#declineModal').on('hide.bs.modal', function (event) {
  $('#declineModal').find('.approveform-modal').find('input[name="photovideoid"]').remove();
  $('#declineModal').find('.approveform-modal').find('input[name="formapprove"]').remove();
});

$(document).on('click', '.approvebtnmodal', function (e) {
  e.preventDefault();
  var id = $(this).attr('data-approve-id');
  var form = $(this).closest('.approveform-modal');
  var actionUrl = form.attr('action');
  rckymcdoadmin.preloader('show');
  $.ajax({
    type: 'POST',
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function (data) {
      console.log(data);
      setTimeout(function () {
        rckymcdoadmin.preloader('hide');
        window.location.reload();
      }, 500);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      console.log(errorThrown);
    },
  });
});

if ($('[name=tags]')[0]) {
  $('[name=tags]').tagify({
    pattern: /^[a-z0-9]+(?:-[a-z0-9]+)*$/,
    delimiters: ',| ',
  });
}

$(document).on('click', '.chip-svg', function (e) {
  var postid = $(this).attr('post-id');
  var tagid = $(this).attr('tag-id');
  var title = $(this).attr('data-title');
  if (typeof postid !== 'undefined' && postid !== false) {
    var myModal = new bootstrap.Modal(document.getElementById('deletetagsModal'));
    var modalToggle = document.getElementById('deletetagsModal');
    myModal.show(modalToggle);

    $('#deletetagsModal').on('shown.bs.modal', function (event) {
      $(this)
        .find('.tagname')
        .html('<b>' + title + '</b>');
      $(this)
        .find('.deletetagform-modal')
        .append('<input type="hidden" name="post_id" value="' + postid + '" />');
      $(this)
        .find('.deletetagform-modal')
        .append('<input type="hidden" name="tag_id" value="' + tagid + '" />');
    });
    $('#deletetagsModal').on('hide.bs.modal', function (event) {
      $(this).find('.tagname').html('');
      $(this).find('input[name="post_id"]').remove();
      $(this).find('input[name="tag_id"]').remove();
    });
  } else {
    alert('postid not found');
  }
});

$(document).on('click', '.deletetagbtnmodal', function (e) {
  rckymcdoadmin.preloader('show');
  $.ajax({
    type: 'POST',
    url: baseurl + 'admin/post/deletetag',
    data: $(this).closest('form').serialize(), // serializes the form's elements.
    success: function (data) {
      data = JSON.parse(data);
      rckymcdoadmin.preloader('hide');
      if (data.error == false) {
        window.location.reload();
      }
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      rckymcdoadmin.preloader('hide');
      console.log(errorThrown);
    },
  });
});

/*** POST UPLOAD */
var maxLength = 150;
$('.txtcaption').keyup(function () {
  var leng = $(this).val().length;
  $('#rchars').text(leng);
});

$('select[name="posttype"]').on('change', function () {
  if (this.value == 'image') {
    $('.filetypeallow').html('<b>JPG</b>, <b>PNG</b>, <b>GIF</b>');
  } else if (this.value == 'video') {
    $('.filetypeallow').html('<b>MP4</b>, <b>WebM</b>');
  }
});

window.rckymcdo = {
  triggerupload: function () {
    if ($('select[name="posttype"] option:selected').val() == 'video') {
      $('#video_upload').trigger('click');
    } else if ($('select[name="posttype"] option:selected').val() == 'image') {
      $('#photo_upload').trigger('click');
    } else {
      alert('invalid selection');
    }
  },
  postvideo: function () {
    rckymcdo.preloader('show');
    var caption = $('.txtcaption').val(),
      videotype = $('select[name="posttype"]').val(),
      privacytype = $('select[name="privacytype"]').val(),
      tags = $('input[name="tags"]').val(),
      status = $('select[name="status"]').val(),
      newstatus = 'Pending',
      allowcomment = 1;
    if (tags.length != 0) {
      tags = tags;
    }
    if ($('input[name="iscomment"]').is(':checked')) {
      allowcomment = 1;
    } else {
      allowcomment = 0;
    }
    if (status === undefined) {
      newstatus = 'Pending';
    } else {
      newstatus = status;
    }
    var formData = new FormData();
    var filesLength = document.getElementById('photo_upload').files.length;

    formData.append('title', caption);
    formData.append('tags', tags);
    formData.append('isvideoimg', videotype);
    formData.append('privacytype', privacytype);
    formData.append('status', newstatus);
    formData.append('allowcomment', allowcomment);
    formData.append('postvideoform', true);
    formData.append('videofile', document.getElementById('video_upload').files[0]);
    for (var i = 0; i < filesLength; i++) {
      formData.append('files[]', document.getElementById('photo_upload').files[i]);
    }

    console.log(formData);
    var form = $('#submit_post');
    var actionUrl = form.attr('action');

    $('.btndiscardvideo').prop('disabled', true);
    $('.btnpostvideo').prop('disabled', true);
    $('.btnpostvideo').addClass('button--loading');
    $.ajax({
      type: 'POST',
      url: actionUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data);
        $('.btnpostvideo').removeClass('button--loading');
        $('.btndiscardvideo').prop('disabled', false);
        $('.btnpostvideo').prop('disabled', false);
        rckymcdo.preloader('hide');

        data = JSON.parse(data);
        console.log(data);
        if (data.error == false) {
          $('.msgoutput').html(
            `<div class="alert alert-success alert-dismissible fade show" role="alert">
          ` +
              data.message +
              `
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`,
          );
          rckymcdo.resetupload();
        } else {
          $('.msgoutput').html(`<div class="msgform">` + data.message + `</div>`);
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  },
  replacevideo: function () {
    var vid = document.getElementById('previewvideo');
    vid.pause();
    $('#previewvideo').html('');
    $('.load-area').show();
    $('.preview-area').hide();

    $('.filewrapper').show();
    $('.generating-preview').html('');
    document.getElementById('video_upload').value = null;

    $('.photopreview-area').find('.carousel-indicators').html('');
    $('.photopreview-area').find('.carousel-inner').html('');
    $('#alertreplaceModal').modal('hide');
    $('.btnpostvideo').prop('disabled', true);
  },
  preloader: function (val) {
    if (val == 'show') {
      $('.linear-activity').show();
    } else if (val == 'hide') {
      $('.linear-activity').hide();
    } else {
      alert('Unknow value: ' + val);
    }
  },
  resetfileupload: function () {
    $('.filewrapper').show();
    $('.generating-preview').html('');
  },
  resetupload: function () {
    $('.filetypeallow').html('<b>MP4</b>, <b>WebM</b>');
    $('#previewvideo').html('');
    $('.load-area').show();
    $('.preview-area').hide();

    $('.filewrapper').show();
    $('.generating-preview').html('');

    $('.btnpostvideo').prop('disabled', true);
    $('.photopreview-area').find('.carousel-indicators').html('');
    $('.photopreview-area').find('.carousel-inner').html('');
    $('#submit_post')[0].reset();
    $('#alertModal').modal('hide');
  },
};

$('.btnpostvideo').on('click', function (e) {
  rckymcdo.postvideo();
});

if ($('#photo_upload')[0]) {
  const inputimg = document.getElementById('photo_upload');

  inputimg.addEventListener('change', function (e) {
    console.log(e);
    $('.msgoutput').html('');
    $('.filewrapper').hide();
    $('.generating-preview').html(`<div class="circular"> <div class="inner"></div>
    <div class="number">100%</div> <div class="circle">
    <div class="bar left"> <div class="progress"></div> </div> <div class="bar right">
    <div class="progress"></div> </div>
    </div> </div><div style="margin-top: 10px;">Rendering video/photo please wait...</div>`);
    const numb = document.querySelector('.number');
    let counter = 0;
    const files = this.files || [];
    var interval = setInterval(() => {
      if (counter == 100) {
        clearInterval(interval);
        setTimeout(() => {
          var allfiles = e.target.files;
          rckymcdo.resetfileupload();

          if (files.length >= 6) {
            $('.msgoutput').html('<div class="msgform">Maximum 5 Photos are allowed</div>');
            document.getElementById('photo_upload').value = '';
            return true;
          }

          var err = 0;
          $('.videotype').val('image');
          var filerr = 0;
          $('.generating-preview').html('');
          $('.photopreview-area').show();
          $('.load-area').hide();
          $('.btnpostvideo').prop('disabled', false);
          for (var i = 0, f; (f = allfiles[i]); i++) {
            loadMime(f, function (mime) {
              if (mime == 'unknown') {
                filerr += 1;
              }
            });
            var reader = new FileReader();
            var count = 0;
            reader.onload = function (event) {
              if (err == 0) {
                $('#carouselRmxmcdo')
                  .find('.carousel-inner')
                  .append('<div class="carousel-item" data-bs-interval="10000"> <img src="' + event.target.result + '" alt="..."> </div>');
                $('#carouselRmxmcdo').find('.carousel-inner > .carousel-item:first-child').addClass('active');

                if (files.length == 1) {
                  $('#carouselRmxmcdo').find('button').hide();
                } else {
                  $('.carousel-indicators').append(
                    `<button type="button" data-bs-target="#carouselRmxmcdo"
              data-bs-slide-to="` +
                      count +
                      `" aria-current="true" aria-label="Slide"></button>`,
                  );

                  $('.carousel-indicators button:first-child').addClass('active');

                  $('#carouselRmxmcdo').find('button').show();
                }

                //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));

                count++;
              }
            };

            reader.readAsDataURL(f);
          }
        }, 1500);
      } else {
        counter += 1;
        numb.textContent = counter + '%';
      }
    }, 15);
  });
}
if ($('#video_upload')[0]) {
  const input = document.getElementById('video_upload');
  const video = document.getElementById('previewvideo');
  const videoSource = document.createElement('source');

  input.addEventListener('change', function (e) {
    console.log(e);
    $('.msgoutput').html('');
    $('.filewrapper').hide();
    $('.generating-preview').html(`<div class="circular"> <div class="inner"></div>
    <div class="number">100%</div> <div class="circle">
    <div class="bar left"> <div class="progress"></div> </div> <div class="bar right">
    <div class="progress"></div> </div>
    </div> </div><div style="margin-top: 10px;">Rendering video/photo please wait...</div>`);
    const numb = document.querySelector('.number');
    let counter = 0;
    const files = this.files;
    const currfile = e.target.files[0];

    var interval = setInterval(() => {
      if (counter == 100) {
        clearInterval(interval);
        setTimeout(() => {
          const reader = new FileReader();
          reader.onload = function (e) {
            var newtitle = currfile.name.split('.')[0];
            $('.videopreview-title').html(currfile.name);
            if ($('input.txtcaption').val().length === 0) {
              $('input.txtcaption').val(newtitle);
              $('#rchars').text($('input.txtcaption').val().length);
            }
            $('.btnpostvideo').prop('disabled', false);
            videoSource.setAttribute('src', e.target.result);
            video.appendChild(videoSource);
            video.load();
            video.play();
            $('.filewrapper').show();
            $('.generating-preview').html('');
            $('.preview-area').show();
            $('.load-area').hide();
          };

          reader.onprogress = function (e) {
            console.log('progress: ', Math.round((e.loaded * 100) / e.total));
          };

          reader.readAsDataURL(currfile);
        }, 1500);
      } else {
        counter += 1;
        numb.textContent = counter + '%';
      }
    }, 15);
  });
}

$('#cannedmsg').on('change', function () {
  alert('This feature is not yet available');
  $(this).val('');
});
$('#declinecannedmsg').on('change', function () {
  alert('This feature is not yet available');
  $(this).val('');
});
