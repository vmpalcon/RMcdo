/*!
 * Web Projects
 * Copyright © 2022 Purplepatch Services LLC.
 */
$('body').removeClass('bd-init');
let passwordStrength = document.getElementById('password-strength');
let lowUpperCase = document.querySelector('.low-upper-case i');
let number = document.querySelector('.one-number i');
let specialChar = document.querySelector('.one-special-char i');
let eightChar = document.querySelector('.eight-character i');
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

if ($('.rmc--leftpane')[0]) {
  var element = document.querySelector('.rmc--leftpane');
  var leftpane = new Optiscroll(element);
}
var searchresult = new Optiscroll(document.getElementById('searchresult'), { forceScrollbars: true });

$(document).on('click', '.btnlike', function (e) {
  e.preventDefault();
  $(this).toggleClass('active');
});

$(document).on('click', '.popsignupbtn a', function (e) {
  e.preventDefault();
  $('.rmc--login-view').hide();
  $('.rmc--register-view').show();
});
$(document).on('click', '.poploginbtn a', function (e) {
  e.preventDefault();
  $('.rmc--login-view').show();
  $('.rmc--register-view').hide();
});
$(document).on('click', '.unread', function (e) {
  e.preventDefault();
  var id = $(this).attr('data-id');
  var total = $('.notification-holder').attr('data-current');
  console.log(total);
  if (typeof total !== 'undefined' && total !== false) {
    var newtotal = parseInt(total) - 1;
    $('.notification-holder').attr('data-current', newtotal);

    if (newtotal == 0) {
      $('.notification-holder').html('');
    } else {
      $('.notification-holder').html(
        `<span
      class="mainnotification-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
      >
      ` +
          newtotal +
          `
   </span>`,
      );
    }
  }
  if (typeof id !== 'undefined' && id !== false) {
    var mydata = {
      notificationid: id,
      notificationstatus: 'read',
    };
    $(this).removeClass('unread');

    $.ajax({
      type: 'POST',
      url: baseurl + 'home/index',
      data: mydata,
      success: function (data) {
        console.log(data);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  }
});

$('.rmc--login-view form').submit(function (e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.

  var form = $(this);
  var actionUrl = form.attr('action');
  rckymcdo.preloader('show');
  $.ajax({
    type: 'POST',
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function (data) {
      console.log(data);

      data = JSON.parse(data);
      if (data.error == false) {
        $('.loginmsgoutput').html(
          `<div class="alert alert-success alert-dismissible fade show" role="alert">
        ` +
            data.message +
            `
        <button type="button" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close"></button>
      </div>`,
        );
        //window.location.reload();
        setTimeout(function () {
          rckymcdo.preloader('hide');
          if (data.redirect != undefined || data.redirect != null) {
            location.href = data.redirect;
          } else {
            window.location.reload();
          }
        }, 2000);
      } else {
        rckymcdo.preloader('hide');
        $('.loginmsgoutput').html(
          `<div class="alert alert-danger alert-dismissible fade show" role="alert">
          ` +
            data.message +
            `
          <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>`,
        );
      }
    },
  });
});
$('.rmc--register-view form').submit(function (e) {
  e.preventDefault();

  var form = $(this);
  var actionUrl = form.attr('action');
  var totalvalid = 0;
  /*var month = $('.rmc--register-view #month').val(),
    day = $('.rmc--register-view #day').val(),
    year = $('.rmc--register-view #year').val(),
    valid = 1;
  if (month == 'month') {
    valid = 0;
    rckymcdo.preloader('hide');
    $('.rmc--register-view #month').addClass('isrequired');
  } else {
    $('.rmc--register-view #month').removeClass('isrequired');
  }
  if (day == 'day') {
    valid = 0;
    rckymcdo.preloader('hide');
    $('.rmc--register-view #day').addClass('isrequired');
  } else {
    $('.rmc--register-view #day').removeClass('isrequired');
  }
  if (year == 'year') {
    valid = 0;
    rckymcdo.preloader('hide');
    $('.rmc--register-view #year').addClass('isrequired');
  } else {
    $('.rmc--register-view #year').removeClass('isrequired');
  }*/

  if ($('.rmc--register-view input[name="firstname"]').val().length == 0) {
    valid = 0;

    $('.rmc--register-view input[name="firstname"]').addClass('isrequired');
  } else {
    totalvalid = totalvalid + 1;
    $('.rmc--register-view input[name="firstname"]').removeClass('isrequired');
  }
  if ($('.rmc--register-view input[name="lastname"]').val().length == 0) {
    valid = 0;

    $('.rmc--register-view input[name="lastname"]').addClass('isrequired');
  } else {
    totalvalid = totalvalid + 1;
    $('.rmc--register-view input[name="lastname"]').removeClass('isrequired');
  }
  if ($('.rmc--register-view input[name="username"]').val().length == 0) {
    valid = 0;

    $('.rmc--register-view input[name="username"]').addClass('isrequired');
  } else {
    var expr = /^[a-zA-Z0-9._]*$/;
    if (!expr.test($('.rmc--register-view input[name="username"]').val())) {
      valid = 0;
      $('.rmc--register-view input[name="username"]').addClass('isrequired');
      $('.username-error-field').append(
        '<div class="username-error ">Only Alphabets, Numbers, Dot and Underscore allowed in Username.</div>',
      );
    } else {
      totalvalid = totalvalid + 1;
      $('.rmc--register-view input[name="username"]').removeClass('isrequired');
      $('.username-error').remove();
    }
  }
  if ($('.rmc--register-view #email').val().length == 0) {
    valid = 0;

    $('.rmc--register-view #email').addClass('isrequired');
  } else {
    totalvalid = totalvalid + 1;
    $('.rmc--register-view #email').removeClass('isrequired');
  }
  if ($('.rmc--register-view input[name="password"]').val().length == 0) {
    valid = 0;

    $('.rmc--register-view input[name="password"]').addClass('isrequired');
  } else {
    totalvalid = totalvalid + 1;

    var passstr = $('#password-strength').attr('data-strength');
    if (passstr == 100) {
      totalvalid = totalvalid + 1;
      $('.rmc--register-view input[name="password"]').removeClass('isrequired');
    } else {
      valid = 0;
      $('.rmc--register-view input[name="password"]').addClass('isrequired');
    }
  }
  if ($('.rmc--register-view input[name="confirmpassword"]').val().length == 0) {
    valid = 0;
    $('.rmc--register-view input[name="confirmpassword"]').addClass('isrequired');
  } else {
    $('.rmc--register-view input[name="confirmpassword"]').removeClass('isrequired');
  }
  console.log('total valid: ' + totalvalid);
  if (totalvalid == 6) {
    valid = 1;
  }
  if (valid == 1) {
    rckymcdo.preloader('show');
    $.ajax({
      type: 'POST',
      url: actionUrl,
      data: form.serialize(), // serializes the form's elements.
      success: function (data) {
        data = JSON.parse(data);

        if (data.error == false) {
          console.log(data);
          $('.rmc--register-view form')[0].reset();
          $('#password-strength').removeClass('progress-bar-warning progress-bar-success progress-bar-danger');
          $('#password-strength').attr('style', 'width: 0%');
          $('#password-strength').attr('data-strength', '0');
          eightChar.classList.add('fa-circle');
          eightChar.classList.remove('fa-check');
          specialChar.classList.add('fa-circle');
          specialChar.classList.remove('fa-check');
          number.classList.add('fa-circle');
          number.classList.remove('fa-check');
          lowUpperCase.classList.add('fa-circle');
          lowUpperCase.classList.remove('fa-check');
          rckymcdo.preloader('hide');
          $('.registermsgoutput').html(
            `<div class="alert alert-success alert-dismissible fade show" role="alert">
        ` +
              data.message +
              `
        <button type="button" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close"></button>
      </div>`,
          );
        } else {
          rckymcdo.preloader('hide');
          $('.registermsgoutput').html(
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
          ` +
              data.message +
              `
          <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>`,
          );
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        rckymcdo.preloader('hide');
        console.log(errorThrown);
      },
    });
  }
});
$('.btnpostvideo').on('click', function (e) {
  rckymcdo.postvideo();
});

function trimString(s) {
  var l = 0,
    r = s.length - 1;
  while (l < s.length && s[l] == ' ') l++;
  while (r > l && s[r] == ' ') r -= 1;
  return s.substring(l, r + 1);
}

function compareObjects(o1, o2) {
  var k = '';
  for (k in o1) if (o1[k] != o2[k]) return false;
  for (k in o2) if (o1[k] != o2[k]) return false;
  return true;
}

function itemExists(haystack, needle) {
  for (var i = 0; i < haystack.length; i++) if (compareObjects(haystack[i], needle)) return true;
  return false;
}

$('.rmc--photovideo-commentvw').scroll(function () {
  if (scrolloaded == true) {
    if (
      $('.rmc--photovideo-commentvw').scrollTop() + $('.rmc--photovideo-commentvw').height() > $('.rmc--commentarea').height() &&
      commentaction == 'inactive'
    ) {
      $('.rmc--photovideo-commentvw .loader').show();
      commentaction = 'active';
      commentstart = commentstart + commentlimit;

      setTimeout(function () {
        var postid = $('.addcommentbtn').attr('data-post');
        rckymcdo.getcomment(commentlimit, commentstart, postid);
      }, 1000);
    }
  }
});

var rckymcdo = {
  loadcomment: function (postid) {
    window.commentlimit = 6;
    window.commentstart = 0;
    window.commentaction = 'inactive';
    window.scrolloaded = true;

    rckymcdo.getcomment(commentlimit, commentstart, postid);
  },
  getcomment: function (commentlimit, commentstart, postid) {
    $.ajax({
      type: 'POST',
      url: baseurl + 'home/getcomment',
      data: { limit: commentlimit, start: commentstart, postid: postid },
      cache: false,
      success: function (data) {
        if (data.length == 0) {
          //$('.timeline-preloader').hide();
          //$('.user-page-inner').append('');
          $('.rmc--photovideo-commentvw .loader').hide();
          scrolloaded = false;
          commentaction = 'active';
        } else {
          $('.rmc--photovideo-commentvw .loader').hide();
          $('.rmc--commentarea ul').append(data);
          commentaction = 'inactive';
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  },
  showerror: function () {
    var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
    var modalToggle = document.getElementById('errorModal');
    myModal.show(modalToggle);
  },
  sse: function () {
    // SSE
    var evtSource = new EventSource(baseurl + 'home/notification_data');

    evtSource.onopen = function () {
      console.log('Connection to server opened.');
    };

    evtSource.onmessage = function (e) {
      var data = JSON.parse(e.data);
      var current = $('.notification-holder').attr('data-current');

      var notifydata = $('.notificationbtn').attr('data-sent');

      var notifydata = $('.notificationbtn').attr('data-sent');
      console.log(notifydata);

      if (data.sent != null) {
        if (notifydata != '') {
          if (parseInt(data.sent) != parseInt(notifydata)) {
            $('.notificationbtn').attr('data-sent', data.sent);

            $('.newtoast-container').append(
              `
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="8000" >
      <div class="toast-header">
  <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#ff4a00"></rect></svg>
    <strong class="me-auto">Notification</strong>
    <small class="text-muted">just now</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
        <div class="toast-body">
         ` +
                data.notification.title +
                `
        </div>
      </div>
    `,
            );

            $('.newtoast-container .toast').each(function (index, e) {
              $(e).toast('show');
            });

            $('.newtoast-container .toast').on('hidden.bs.toast', e => {
              $(e.currentTarget).remove();
            });
          }
        }
      }

      if (parseInt(data.totalnotification) != 0) {
        $('.notification-holder').html(
          `<span
        class="mainnotification-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
        >
        ` +
            data.totalnotification +
            `
     </span>`,
        );
        if (parseInt(data.totalnotification) != parseInt(current)) {
          $('.notification-holder').attr('data-current', data.totalnotification);
          $('.mainnotification-count').attr('data-current', data.totalnotification);
          if (data.totalnotification != 0) {
            $('.mainnotification-count').show();
            $('.mainnotification-count').text(data.totalnotification);
          } else {
            $('.mainnotification-count').hide();
          }
        }
      } else {
        $('notification-holder').html('');
      }
    };

    evtSource.onerror = function () {
      console.log('EventSource failed.');
      evtSource.close();
    };
  },
  resetfileupload: function () {
    $('.filewrapper').show();
    $('.generating-preview').html('');
    /*$('.info-star').html(
      `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
    );*/
  },
  search: function (objects, title) {
    var results = [];
    toSearch = trimString(title); // trim it
    console.log(toSearch);
    for (var i = 0; i < objects.length; i++) {
      for (var key in objects[i]) {
        if (objects[i][key].indexOf(toSearch) != -1) {
          if (!itemExists(results, objects[i])) results.push(objects[i]);
        }
      }
    }
    return results;
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
  shownotification: function (_this) {
    console.log($(_this).parent().find('.notification-wrapper').hasClass('active'));
    if ($(_this).parent().find('.notification-wrapper').hasClass('active')) {
      $(_this).parent().find('.notification-wrapper').removeClass('active');
    } else {
      $(_this).parent().find('.notification-wrapper').addClass('active');
      var mydata = {
        formnotification: true,
      };
      $('.notification-list').html('<div class="ntyloader"></div>');
      $.ajax({
        type: 'POST',
        url: baseurl + 'home/index',
        data: mydata,
        success: function (data) {
          $('.notification-list').html('');
          data = data = JSON.parse(data);
          console.log(data);

          if (data.error == false) {
            var unread = '';
            for (var i = 0; i < data.notifylist.length; i++) {
              if (data.notifylist[i]['status'] == 'unread') {
                unread = 'unread';
              }
              $('.notification-list').append(
                `<li><a href="` +
                  baseurl +
                  data.notifylist[i]['link'] +
                  `"
              class="` +
                  unread +
                  `" data-id="` +
                  data.notifylist[i]['id'] +
                  `"><span><i
                    class="fas fa-photo-video"></i></span><span>
                ` +
                  data.notifylist[i]['title'] +
                  `
                 <br>
                 <i>
                    ` +
                  timeAgo(new Date(data.notifylist[i]['created_at'])) +
                  `
                 </i>
                 <br>
              </span></a></li>`,
              );
            }
            if (data.notifylist.length == 0) {
              $('.notification-list').html(
                '<div class="mt-3" style="padding: 0px 40px"><h3>All activity</h3><p style="font-size: 14px;">Notifications about your account will appear here.</p></div>',
              );
            }
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
        },
      });
    }
  },
  triggerupload: function () {
    if ($('select[name="posttype"] option:selected').val() == 'video') {
      $('#video_upload').trigger('click');
    } else if ($('select[name="posttype"] option:selected').val() == 'image') {
      $('#photo_upload').trigger('click');
    } else {
      alert('invalid selection');
    }
    //
  },
  opennotiftab: function (id, _this) {
    $('.notification-menu ul li a').removeClass('active');
    $(_this).addClass('active');
  },
  openviewupload: function (id) {
    $('#nav-tabContent').find('.tab-pane').removeClass('show active');
    $(id).addClass('show active');
  },
  backview: function () {
    $('.rmc--default-view').show();
    $('.rmc--viewtemplate').hide();
    $('.btn-back').hide();
  },
  openview: function (_this) {
    var dataview = $(_this).attr('data-view');
    console.log(dataview);
    if (dataview === 'qrcode') {
      $('.rmc--qrcode-view').show();
    } else if (dataview === 'username') {
      $('.rmc--login-view').show();
    }
    $('.rmc--default-view').hide();
    $('.btn-back').show();
  },
  socialconnect: function () {
    rckymcdo.preloader('show');

    setTimeout(function () {
      rckymcdo.preloader('hide');

      location.reload();
    }, 4000);
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
  logout: function () {
    rckymcdo.preloader('show');

    setTimeout(function () {
      rckymcdo.preloader('hide');
      location.reload();
    }, 3000);
  },
  copylink: function (_this) {
    var val = $(_this).parent().find('input').val();

    var $temp = $('<input>');
    if ($('#videoshowModal').is(':visible')) {
      $('#videoshowModal').append($temp);
    } else {
      $('body').append($temp);
    }
    $temp.val(val).select();
    document.execCommand('copy');

    $temp.remove();
    $('.toast-container').append(`
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="500" >
          <div class="toast-body">
           Copied
          </div>
        </div>
      `);

    $('.toast-container .toast').each(function (index, e) {
      $(e).toast('show');
    });
    $(_this).parent().parent().parent().removeClass('active');
    $('.toast-container .toast').on('hidden.bs.toast', e => {
      $(e.currentTarget).remove();
    });
  },
  share: function (_this) {
    $(_this).parent().find('.rmc--share').toggleClass('active');
  },
  closeshare: function (_this) {
    $(_this).parent().parent().parent().removeClass('active');
  },
};

// click outside element will close
$(document).mouseup(function (e) {
  var searchcontainer = $('.header-search-wrap'),
    sharecontainer = $('.rmc--share'),
    notification = $('.notification-wrapper'),
    noty = $('.notificationbtn');
  if (!searchcontainer.is(e.target) && searchcontainer.has(e.target).length === 0) {
    searchcontainer.removeClass('active');
  }
  if (!sharecontainer.is(e.target) && sharecontainer.has(e.target).length === 0) {
    $(sharecontainer).removeClass('active');
  }
  if ($('.notification-wrapper').hasClass('active')) {
    if (!notification.is(e.target) && notification.has(e.target).length === 0 && !noty.is(e.target) && noty.has(e.target).length === 0) {
      $(notification).removeClass('active');
    }
  }
});
$('#search').on('click', function (e) {
  var value = $(this).val();
  if (value.length !== 0) {
    $('.header-search-wrap').addClass('active');
  } else {
    $('.header-search-wrap').removeClass('active');
  }
  $('.searchresult').find('.search-resulttxt').html(value);
});
$(document).keyup(function (e) {
  if (e.key === 'Escape') {
    $('.header-search-wrap').removeClass('active');
    $('.rmc--share').removeClass('active');
    $('.notification-wrapper').removeClass('active');
  }
});

var typingTimer;
var doneTypingInterval = 500;
var $input = $('#search');

//on keyup, start the countdown
$input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping() {
  var value = $input.val();

  if (value.length !== 0) {
    $('.searchloading').show();

    var res = {
      searchresult: value,
    };
    $.ajax({
      type: 'POST',
      url: baseurl + 'home/searchresult',
      data: res,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('.searchloading').hide();

        var q = $('#search').val();
        $('.header-search-wrap').addClass('active');
        var res = [];
        data.tags.sort((a, b) => a.title.localeCompare(b.title));
        for (var i = 0; i < data.tags.length; i++) {
          res.push(data.tags[i].title);
        }
        var search = new RegExp(q, 'i'); // prepare a regex object
        let b = res.filter(item => search.test(item));

        $('#searchresult').find('.searchlikeresult').html('');

        for (var i = 0; i < b.length; i++) {
          if (i <= 5) {
            $('#searchresult')
              .find('.searchlikeresult')
              .append('<li><a href="' + baseurl + 'tags/' + b[i] + '" class="searchhelper">' + b[i] + '</a></li>');
          }
        }
        $('#searchresult').find('.searchuserlist').html('');

        for (var x = 0; x < data.users.length; x++) {
          if (x <= 5) {
            $('#searchresult')
              .find('.searchuserlist')
              .append(
                `<li><a href="` +
                  baseurl +
                  'user/' +
                  data.users[x].username +
                  `" class="searchuser">
              <div class="searchimg-wrap"><img
                    src="` +
                  baseurl +
                  `public/uploads/` +
                  data.users[x].photo +
                  `" onError="this.onerror=null;this.src='` +
                  baseurl +
                  `public/assets/img/no-photo.jpg';"
                    alt=""></div>
              <div class="search-text-wrap">
                 <span>` +
                  data.users[x].username +
                  `</span>
                 <span>` +
                  data.users[x].firstname +
                  ' ' +
                  data.users[x].lastname +
                  `</span>
              </div>
           </a>
        </li>`,
              );
          }
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  } else {
    $('.header-search-wrap').removeClass('active');
  }
  $('.searchresult').find('.search-resulttxt').html(value);
}

/* scroll to top */
var scrolltotop = $('.scrollToTop'),
  cscroll = $(window).scrollTop();
if (cscroll >= 39) {
  scrolltotop.addClass('active');
} else {
  scrolltotop.removeClass('active');
}
$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 39) {
    scrolltotop.addClass('active');
  } else {
    scrolltotop.removeClass('active');
  }
});
$('.scrollToTop').on('click', function () {
  $('html, body').animate(
    {
      scrollTop: 0,
    },
    0,
  );
  return false;
});

$(function () {
  $('video source').each(function () {
    var sourceFile = $(this).attr('data-src');
    $(this).attr('src', sourceFile);
    var video = this.parentElement;
    video.load();
  });
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
/*if ($('#video_upload')[0]) {
  const input = document.getElementById('video_upload');
  const video = document.getElementById('previewvideo');
  const videoSource = document.createElement('source');

  input.addEventListener('change', function (e) {
    $('.info-star').html(`<div class="circular"> <div class="inner"></div>
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
          if (!files.length) return;
          if (files.length > 1) {
            var allfiles = e.target.files;
            if (files.length >= 6) {
              rckymcdo.resetfileupload();

              $('.msgoutput').html('<div class="msgform">Maximum 5 Photos or 1 per Video are allowed</div>');
              document.getElementById('video_upload').value = '';
              return true;
            }
            var err = 0;
            $('.videotype').val('image');
            var filerr = 0;
            $('.photopreview-area').hide();
            for (var i = 0, f; (f = allfiles[i]); i++) {
              if (f.type == 'image/png' || f.type == 'image/jpg' || f.type == 'image/jpeg' || f.type == 'image/gif') {
                loadMime(f, function (mime) {
                  if (mime == 'unknown') {
                    filerr += 1;
                  }
                });
                var reader = new FileReader();
                var count = 0;
                reader.onload = function (event) {
                  if (err == 0) {
                    $('.carousel-indicators').append(
                      `<button type="button" data-bs-target="#carouselRmxmcdo"
              data-bs-slide-to="` +
                        count +
                        `" aria-current="true" aria-label="Slide 1"></button>`,
                    );
                    $('#carouselRmxmcdo')
                      .find('.carousel-inner')
                      .append(
                        '<div class="carousel-item" data-bs-interval="10000"> <img src="' + event.target.result + '" alt="..."> </div>',
                      );
                    $('.carousel-indicators button:first-child').addClass('active');
                    $('#carouselRmxmcdo').find('.carousel-inner > .carousel-item:first-child').addClass('active');
                    //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));

                    count++;
                  }
                };

                reader.readAsDataURL(f);
              } else if (f.type == 'video/mp4' || f.type == 'video/webm') {
                rckymcdo.resetfileupload();
                $('.msgoutput').html(
                  '<div class="msgform">Error you cannot upload photo and video at the sametime and only 1 per video are allowed to upload.</div>',
                );
                document.getElementById('video_upload').value = '';
                $('.load-area').show();
                $('.photopreview-area').find('.carousel-indicators').html('');
                $('.photopreview-area').find('.carousel-inner').html('');
                err = err + 1;
                return true;
              } else {
                rckymcdo.resetfileupload();
                $('.msgoutput').html('<div class="msgform">File not supported, please make sure to upload mp4, webm, jpg, gif, png</div>');
              }
            }

            setTimeout(function () {
              console.log(e.target.files);
              $('.photopreview-area').show();
              if (filerr == 0) {
                $('.load-area').hide();
                $('.msgoutput').html('');
                $('.btnpostvideo').prop('disabled', false);
              } else {
                $('.btnpostvideo').prop('disabled', true);
                console.log(filerr);
                rckymcdo.resetfileupload();
                $('.msgoutput').html('<div class="msgform">Invalid file signature detected.</div>');
                $('.photopreview-area').show();
                $('.carousel-indicators').html('');
                $('.carousel-inner').html('');
                document.getElementById('video_upload').value = '';
              }
            }, 2000);
          } else {
            var currfile = e.target.files[0];

            if (currfile.type == 'video/mp4' || currfile.type == 'video/webm') {
              console.log('this is video');
              $('.videotype').val('video');
              $('.msgoutput').html('');
              const reader = new FileReader();
              reader.onload = function (e) {
                var newtitle = currfile.name.split('.')[0];
                $('.videopreview-title').html(currfile.name);
                if ($('input.txtcaption').val().length === 0) {
                  $('input.txtcaption').val(newtitle);
                }
                $('.btnpostvideo').prop('disabled', false);
                videoSource.setAttribute('src', e.target.result);
                video.appendChild(videoSource);
                video.load();
                video.play();
              };

              reader.onprogress = function (e) {
                console.log('progress: ', Math.round((e.loaded * 100) / e.total));
              };

              reader.readAsDataURL(files[0]);
              $('.preview-area').addClass('active');
              $('.load-area').hide();
            } else if (
              currfile.type == 'image/png' ||
              currfile.type == 'image/jpg' ||
              currfile.type == 'image/jpeg' ||
              currfile.type == 'image/gif'
            ) {
              loadMime(currfile, function (mime) {
                if (mime == 'unknown') {
                  rckymcdo.resetfileupload();
                  $('.msgoutput').html('<div class="msgform">Invalid file signature detected.</div>');
                  document.getElementById('video_upload').value = '';
                } else {
                  console.log('this is image');
                  $('.videotype').val('image');
                  $('.load-area').hide();
                  $('.msgoutput').html('');
                  var reader = new FileReader();
                  var count = 0;
                  reader.onload = function (event) {
                    $('.btnpostvideo').prop('disabled', false);
                    $('.carousel-indicators').append(
                      `<button type="button" data-bs-target="#carouselRmxmcdo"
          data-bs-slide-to="` +
                        count +
                        `" aria-current="true" aria-label="Slide 1"></button>`,
                    );
                    var newtitle = currfile.name.split('.')[0];
                    if ($('input.txtcaption').val().length === 0) {
                      $('input.txtcaption').val(newtitle);
                    }
                    $('#carouselRmxmcdo')
                      .find('.carousel-inner')
                      .append(
                        '<div class="carousel-item" data-bs-interval="10000"> <img src="' + event.target.result + '" alt="..."> </div>',
                      );
                    //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));
                    $('.btnpostvideo').prop('disabled', false);
                    $('.carousel-indicators button:first-child').addClass('active');
                    $('#carouselRmxmcdo').find('.carousel-inner .carousel-item:first-child').addClass('active');
                    count++;
                    //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));
                  };

                  reader.readAsDataURL(e.target.files[0]);
                }
              });
            } else {
              rckymcdo.resetfileupload();
              $('.msgoutput').html('<div class="msgform">File not supported, please make sure to upload mp4, webm, jpg, gif, png</div>');
            }
          }
        }, 1500);
      } else {
        counter += 1;
        numb.textContent = counter + '%';
      }
    }, 15);
  });
}
*/
$('#videoshowModal').on('shown.bs.modal', function (event) {
  $('.rmc--commentarea ul').html('');
  var iscomment = $(event.relatedTarget).attr('data-focus');
  var postid = $(event.relatedTarget).attr('data-id');
  if (typeof iscomment !== 'undefined' && iscomment !== false) {
    if ($('.rmc--photovideo-msgtool').find('input')[0]) {
      $('.rmc--photovideo-msgtool').find('input')[0].focus();
    }
  }
  if (typeof postid !== 'undefined' && postid !== false) {
    var mydata = {
      postid: postid,
      iscomment: true,
    };
    if ($(this).find('.addcommentbtn')[0]) {
      $(this).find('.addcommentbtn').attr('data-post', postid);
    }
    $(this).find('.likecheckbox').attr('data-post', postid);
    $this = $(this);
    console.log(mydata);
    $.ajax({
      type: 'POST',
      url: baseurl + 'home/showpost',
      data: mydata,
      success: function (output) {
        output = JSON.parse(output);
        console.log(output);
        if (output.error == false) {
          if (output.data.isverified == '1') {
            $isverified = '<span><img src="' + baseurl + 'public/assets/img/svg/user-check.svg" alt=""></span>';
          } else {
            $isverified = '';
          }
          //$this.find('.rmc--photovideo-commentvw').html('');

          rckymcdo.loadcomment(output.data.id);
          if (output.data.posttype == 'video') {
            $mypostcontent =
              '<div class="loader"> <div class="loader-wheel"></div> </div><iframe src="' +
              output.data.photovideo +
              '&autoplay=1&loop=1&autopause=0&api=1&controls=0&muted=0?playsinline=0" frameborder="0" allow="autoplay;fullscreen;" allowfullscreen="" playsinline=""> </iframe>';
            $this.find('.rmc--photovideo-source').html($mypostcontent);
          } else if (output.data.posttype == 'image') {
            console.log(output.data.photovideo);
            $('#videoshowModal').find('.rmc--photovideo-source')
              .html(`<div id="carouselRmxmcdo-modal" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
             
              </div>
              <div class="carousel-inner">
        
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselRmxmcdo-modal" data-bs-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselRmxmcdo-modal" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Next</span>
              </button>
           </div>`);

            for (var i = 0; i <= output.data.photovideo.length; i++) {
              if (output.data.photovideo[i] != undefined) {
                $('#videoshowModal')
                  .find('.carousel-inner')
                  .append(
                    '<div class="carousel-item" data-bs-interval="10000" data-filetype="image"> <img src="' +
                      baseurl +
                      'public/uploads/' +
                      output.data.photovideo[i] +
                      '" alt="..."> </div>',
                  );
                $('#videoshowModal')
                  .find('.carousel-indicators')
                  .append(
                    `<button type="button" data-bs-target="#carouselRmxmcdo-modal"
            data-bs-slide-to="` +
                      i +
                      `" aria-current="true" aria-label="Slide"></button>`,
                  );

                $('#videoshowModal #carouselRmxmcdo-modal').find('button').show();
              }
            }
            $('#videoshowModal #carouselRmxmcdo-modal').find('.carousel-indicators button:first-child').addClass('active');
            $('#videoshowModal #carouselRmxmcdo-modal').find('.carousel-inner > .carousel-item:first-child').addClass('active');

            if (output.data.photovideo.length == 1) {
              $('#videoshowModal #carouselRmxmcdo-modal').find('button').hide();
            }
          }

          $this.find('.total-like').text(output.data.totalreact);
          $this
            .find('.rmc--pv-linktool')
            .find('input')
            .val(baseurl + 'post/' + output.data.slug);
          console.log(output.data);
          if (output.data.isreact == '1') {
            $this.find('.likecheckbox > div input').attr('checked', true);
          } else {
            $this.find('.likecheckbox > div input').attr('checked', false);
          }
          //$this.find('.total-comment').text(output.data.totalreact);
          $('.rmcpop-user').html(output.data.username + ' ' + $isverified);
          if (output.data.photo != '') {
            $photo = baseurl + 'public/uploads/' + output.data.photo;
          } else {
            $photo = baseurl + 'public/assets/img/no-photo.jpg';
          }
          $('.rmcpop-img').attr('src', $photo);
          $('.rmcpop-title').html(
            output.data.firstname + ' ' + output.data.lastname + ' &middot; ' + timeAgo(new Date(output.data.created_at)),
          );
          $this.find('.rmcpop-message').html(output.data.title);
          //$('.rmcpop-message').html($(event.relatedTarget).parent().parent().parent().parent().find('.rmc--profile-title').html());
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  } else {
    rckymcdo.showerror();
  }
  /* $('.rmc--photovideo-source').html('');
  var getfiletype = $(event.relatedTarget).attr('data-filetype');

  if (typeof getfiletype !== 'undefined' && preview !== getfiletype) {
    if (getfiletype == 'video') {
      var source = $(event.relatedTarget).attr('data-source');
      var preview = $(event.relatedTarget).attr('data-preview');

      if (typeof preview !== 'undefined' && preview !== false) {
        $('.rmc--photovideo-blurbg').css('background', "url('" + preview + "')");
      }
      $('#videoshowModal .rmc--photovideo-source').html(
        `<video id="popupvideoplayer" loop="" autoplay="" playsinline controls>
      <source src="` +
          source +
          `" type="video/mp4" playsinline>
    </video>`,
      );
      $('.rmcpop-user').html($(event.relatedTarget).parent().parent().parent().parent().find('.rmc--profile-username a').html());
      $('.rmcpop-img').attr('src', $(event.relatedTarget).parent().parent().parent().parent().find('.rmc--profile-userimg').attr('src'));
      $('.rmcpop-title').html($(event.relatedTarget).parent().parent().parent().parent().find('.rmc--profile-username').attr('title'));
      $('.rmcpop-message').html($(event.relatedTarget).parent().parent().parent().parent().find('.rmc--profile-title').html());
    } else if (getfiletype == 'image') {
      var source = $(event.relatedTarget).parent().parent().html();
      $('#videoshowModal')
        .find('.rmc--photovideo-source')
        .html('<div id="popcarouselRmxmcdo" class="carousel slide" data-bs-ride="carousel">' + source + '</div>');
      $('#videoshowModal').find('.rmc--photovideo-source .carousel-indicators > button').attr('data-bs-target', '#popcarouselRmxmcdo');
      $('#videoshowModal').find('.rmc--photovideo-source .carousel-control-prev').attr('data-bs-target', '#popcarouselRmxmcdo');
      $('#videoshowModal').find('.rmc--photovideo-source .carousel-control-next').attr('data-bs-target', '#popcarouselRmxmcdo');

      $('.rmcpop-user').html(
        $(event.relatedTarget).parent().parent().parent().parent().parent().parent().find('.rmc--profile-username a').html(),
      );
      $('.rmcpop-img').attr(
        'src',
        $(event.relatedTarget).parent().parent().parent().parent().parent().parent().find('.rmc--profile-userimg').attr('src'),
      );
      $('.rmcpop-title').html(
        $(event.relatedTarget).parent().parent().parent().parent().parent().parent().find('.rmc--profile-username').attr('title'),
      );
      $('.rmcpop-message').html(
        $(event.relatedTarget).parent().parent().parent().parent().parent().parent().find('.rmc--profile-title').html(),
      );
    }
  }*/
});
$('#videoshowModal').on('hide.bs.modal', function (event) {
  $('.rmc--photovideo-blurbg').removeAttr('style');
  $('#videoshowModal').find('.rmc--photovideo-source').html('');
  /*if (document.getElementById('popupvideoplayer')) {
    var vid = document.getElementById('popupvideoplayer');
    vid.pause();
  }*/

  commentaction = 'inactive';
});
$('#loginModal').on('show.bs.modal', function (event) {
  var checkpage = $(event.relatedTarget).attr('data-src');
  if (typeof checkpage !== 'undefined' && checkpage !== false) {
    $('.rmc--login-view form').append('<input type="hidden" name="location_redirect" value="' + checkpage + '">');
  }
});
$('#loginModal').on('hidden.bs.modal', function (event) {
  $('.rmc--login-view').show();
  $('.rmc--register-view').hide();
  $('input[name="location_redirect"]').remove();
});

$('video.rmc--video')
  .bind('touchstart', function () {
    var currentid = $(this).attr('id');
    mouseover(currentid);
  })
  .bind('touchend', function () {
    var currentid = $(this).attr('id');
    mouseout(currentid);
  });

$(document).ready(function () {
  $('.carousel').carousel({
    interval: 2000,
  });
});
/*
var Days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; // index => month [0-11]
$(document).ready(function () {
  var option = '<option value="day">Day</option>';
  var selectedDay = 'day';
  for (var i = 1; i <= Days[0]; i++) {
    //add option days
    option += '<option value="' + i + '">' + i + '</option>';
  }
  $('#day').append(option);
  $('#day').val(selectedDay);

  var option = '<option value="month">Month</option>';
  var selectedMon = 'month';
  for (var i = 1; i <= 12; i++) {
    option += '<option value="' + i + '">' + i + '</option>';
  }
  $('#month').append(option);
  $('#month').val(selectedMon);

  var option = '<option value="month">Month</option>';
  var selectedMon = 'month';
  for (var i = 1; i <= 12; i++) {
    option += '<option value="' + i + '">' + i + '</option>';
  }
  $('#month2').append(option);
  $('#month2').val(selectedMon);

  var d = new Date();
  var option = '<option value="year">Year</option>';
  selectedYear = 'year';
  for (var i = 1930; i <= d.getFullYear(); i++) {
    // years start i
    option += '<option value="' + i + '">' + i + '</option>';
  }
  $('#year').append(option);
  $('#year').val(selectedYear);
});
function isLeapYear(year) {
  year = parseInt(year);
  if (year % 4 != 0) {
    return false;
  } else if (year % 400 == 0) {
    return true;
  } else if (year % 100 == 0) {
    return false;
  } else {
    return true;
  }
}

function change_year(select) {
  if (isLeapYear($(select).val())) {
    Days[1] = 29;
  } else {
    Days[1] = 28;
  }
  if ($('#month').val() == 2) {
    var day = $('#day');
    var val = $(day).val();
    $(day).empty();
    var option = '<option value="day">Day</option>';
    for (var i = 1; i <= Days[1]; i++) {
      //add option days
      option += '<option value="' + i + '">' + i + '</option>';
    }
    $(day).append(option);
    if (val > Days[month]) {
      val = 1;
    }
    $(day).val(val);
  }
}

function change_month(select) {
  var day = $('#day');
  var val = $(day).val();
  $(day).empty();
  var option = '<option value="day">Day</option>';
  var month = parseInt($(select).val()) - 1;
  for (var i = 1; i <= Days[month]; i++) {
    //add option days
    option += '<option value="' + i + '">' + i + '</option>';
  }
  $(day).append(option);
  if (val > Days[month]) {
    val = 1;
  }
  $(day).val(val);
}
*/
/**** POST ****/
$(document).ready(function () {
  rckymcdo.sse();

  var limit = 3;
  var start = 0;
  var action = 'inactive',
    tagaction = 'inactive',
    useraction = 'inactive';

  var xlimit = 6;
  var xstart = 0;

  function userload_data(limit, start, username) {
    $.ajax({
      url: baseurl + 'home/fetchpost',
      method: 'POST',
      data: { limit: xlimit, start: xstart, username: username },
      cache: false,
      success: function (data) {
        console.log(data.length);

        if (data.length == 0) {
          $('.timeline-preloader').hide();
          //$('.user-page-inner').append('');
          useraction = 'active';
        } else {
          $('.timeline-preloader').hide();
          $('.user-page-inner').append(data);

          useraction = 'inactive';
        }
      },
    });
  }

  function load_data(limit, start) {
    $.ajax({
      url: baseurl + 'home/fetch',
      method: 'POST',
      data: { limit: limit, start: start },
      cache: false,
      success: function (data) {
        if (data == '') {
          $('.timeline-preloader').hide();
          $('.main-timeline').append('<div class="endtimeline"><h3>No More Result Found</h3></div>');
          action = 'active';
        } else {
          $('.timeline-preloader').hide();
          $('.main-timeline').append(data);

          action = 'inactive';
        }
      },
    });
  }

  function tagload_data(limit, start, tagtitle) {
    $.ajax({
      url: baseurl + 'home/fetchtags',
      method: 'POST',
      data: { limit: limit, start: start, tag_title: tagtitle },
      cache: false,
      success: function (data) {
        if (data == '') {
          $('.timeline-preloader').hide();

          $('.tag-timeline').append('<div class="endtimeline"><h3>No More Result Found</h3></div>');
          tagaction = 'active';
        } else {
          $('.timeline-preloader').hide();
          $('.tag-timeline').append(data);

          tagaction = 'inactive';
        }
      },
    });
  }

  if ($('.main-timeline')[0]) {
    if (action == 'inactive') {
      action = 'active';
      load_data(limit, start);
    }
  }

  if ($('.user-page-inner')[0]) {
    if (useraction == 'inactive') {
      useraction = 'active';
      $username = window.location.pathname.split('/').pop();

      userload_data(xlimit, xstart, $username);
    }
  }

  if ($('.tag-timeline')[0]) {
    if (tagaction == 'inactive') {
      tagaction = 'active';
      tagtitle = $('.tag-timelinetitle').attr('data-title');
      tagload_data(limit, start, tagtitle);
    }
  }

  $(window).scroll(function () {
    if ($('.main-timeline')[0]) {
      if ($(window).scrollTop() + $(window).height() > $('.timeline').height() && action == 'inactive') {
        $('.timeline-preloader').show();
        action = 'active';
        start = start + limit;
        setTimeout(function () {
          load_data(limit, start);
        }, 1000);
      }
    }
    if ($('.tag-timeline')[0]) {
      if ($(window).scrollTop() + $(window).height() > $('.timeline').height() && tagaction == 'inactive') {
        $('.timeline-preloader').show();
        tagaction = 'active';
        start = start + limit;
        tagtitle = $('.tag-timelinetitle').attr('data-title');
        setTimeout(function () {
          tagload_data(limit, start, tagtitle);
        }, 1000);
      }
    }
    if ($('.user-page-inner')[0]) {
      if ($(window).scrollTop() + $(window).height() > $('.user-page-wrapper').height() && useraction == 'inactive') {
        $('.user-section .timeline-preloader').show();
        useraction = 'active';
        xstart = xstart + xlimit;
        setTimeout(function () {
          $link = window.location.pathname.split('/').pop();
          userload_data(xlimit, xstart, $username);
        }, 1000);
      }
    }
  });
});

$('.toggle-password').click(function () {
  $(this).toggleClass('fa-eye fa-eye-slash');
  var input = $($(this).parent().find('input'));
  if (input.attr('type') == 'password') {
    input.attr('type', 'text');
  } else {
    input.attr('type', 'password');
  }
});

let state = false;

$('.rmc--register-view input[name="password"]').on('keyup', function () {
  let pass = $(this).val();
  checkStrength(pass);
  console.log(pass);
});
function checkStrength(password) {
  let strength = 0;

  //If password contains both lower and uppercase characters
  if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
    strength += 1;
    lowUpperCase.classList.remove('fa-circle');
    lowUpperCase.classList.add('fa-check');
  } else {
    lowUpperCase.classList.add('fa-circle');
    lowUpperCase.classList.remove('fa-check');
  }
  //If it has numbers and characters
  if (password.match(/([0-9])/)) {
    strength += 1;
    number.classList.remove('fa-circle');
    number.classList.add('fa-check');
  } else {
    number.classList.add('fa-circle');
    number.classList.remove('fa-check');
  }
  //If it has one special character
  if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
    strength += 1;
    specialChar.classList.remove('fa-circle');
    specialChar.classList.add('fa-check');
  } else {
    specialChar.classList.add('fa-circle');
    specialChar.classList.remove('fa-check');
  }
  //If password is greater than 7
  if (password.length > 7) {
    strength += 1;
    eightChar.classList.remove('fa-circle');
    eightChar.classList.add('fa-check');
  } else {
    eightChar.classList.add('fa-circle');
    eightChar.classList.remove('fa-check');
  }

  // If value is less than 2
  console.log(strength);
  if (strength == 0) {
    passwordStrength.classList.remove('progress-bar-warning');
    passwordStrength.classList.remove('progress-bar-success');
    passwordStrength.classList.remove('progress-bar-danger');
    passwordStrength.style = 'width: 0%';
    $('#password-strength').attr('data-strength', '0');
  } else if (strength == 1) {
    passwordStrength.classList.remove('progress-bar-warning');
    passwordStrength.classList.remove('progress-bar-success');
    passwordStrength.classList.add('progress-bar-danger');
    passwordStrength.style = 'width: 10%';
    $('#password-strength').attr('data-strength', '10');
  } else if (strength == 2) {
    passwordStrength.classList.remove('progress-bar-warning');
    passwordStrength.classList.remove('progress-bar-success');
    passwordStrength.classList.add('progress-bar-danger');
    passwordStrength.style = 'width: 30%';
    $('#password-strength').attr('data-strength', '30');
  } else if (strength == 3) {
    passwordStrength.classList.remove('progress-bar-success');
    passwordStrength.classList.remove('progress-bar-danger');
    passwordStrength.classList.add('progress-bar-warning');
    passwordStrength.style = 'width: 60%';
    $('#password-strength').attr('data-strength', '60');
  } else if (strength == 4) {
    passwordStrength.classList.remove('progress-bar-warning');
    passwordStrength.classList.remove('progress-bar-danger');
    passwordStrength.classList.add('progress-bar-success');
    passwordStrength.style = 'width: 100%';
    $('#password-strength').attr('data-strength', '100');
  }
}

function timeAgo(time) {
  switch (typeof time) {
    case 'number':
      break;
    case 'string':
      time = +new Date(time);
      break;
    case 'object':
      if (time.constructor === Date) time = time.getTime();
      break;
    default:
      time = +new Date();
  }
  var time_formats = [
    [60, 'seconds', 1], // 60
    [120, '1 minute ago', '1 minute from now'], // 60*2
    [3600, 'minutes', 60], // 60*60, 60
    [7200, '1 hour ago', '1 hour from now'], // 60*60*2
    [86400, 'hours', 3600], // 60*60*24, 60*60
    [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
    [604800, 'days', 86400], // 60*60*24*7, 60*60*24
    [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
    [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
    [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
    [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
    [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
    [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
    [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
    [58060800000, 'centuries', 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
  ];
  var seconds = (+new Date() - time) / 1000,
    token = 'ago',
    list_choice = 1;

  if (seconds == 0) {
    return 'Just now';
  }
  if (seconds < 0) {
    seconds = Math.abs(seconds);
    token = 'from now';
    list_choice = 2;
  }
  var i = 0,
    format;
  while ((format = time_formats[i++]))
    if (seconds < format[0]) {
      if (typeof format[2] == 'string') return format[list_choice];
      else return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
    }
  return time;
}

function subtractMinutes(numOfMinutes, date = new Date()) {
  date.setMinutes(date.getMinutes() - numOfMinutes);

  return date;
}

if ($('[name=tags]')[0]) {
  $('[name=tags]').tagify({
    pattern: /^[a-z0-9]+(?:-[a-z0-9]+)*$/,
    delimiters: ',| ',
  });
}

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

$(document).on('click', '.likecheckbox', function (e) {
  e.preventDefault();
  var id = $(this).attr('data-post');
  var issublike = $(this).attr('issublike');
  if (id !== 'undefined' && id !== false) {
    var mydata = {
      postid: id,
      reactpost: true,
    };
    var $this = $(this);
    console.log($this);

    $.ajax({
      type: 'POST',
      url: baseurl + 'home/react',
      data: mydata,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        var totallike = parseInt($this.find('.total-like').text());
        console.log(totallike);

        if (data.error == true) {
          if (data.login == false) {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
            var modalToggle = document.getElementById('loginModal');
            myModal.show(modalToggle);
          } else {
            rckymcdo.showerror();
          }
        } else {
          if (data.data == null) {
            $this.find('input').attr('checked', false);
            totallike = totallike - 1;
            $this.find('.total-like').text(totallike);

            if (typeof issublike !== 'undefined' && issublike !== false) {
              $('#likecheckbox' + id).attr('checked', false);
              $('#likecheckbox' + id)
                .parent()
                .parent()
                .find('.total-like')
                .text(totallike);
            }
          } else {
            $this.find('input').attr('checked', true);
            totallike = totallike + 1;
            $this.find('.total-like').text(totallike);

            if (typeof issublike !== 'undefined' && issublike !== false) {
              $('#likecheckbox' + id).attr('checked', true);
              $('#likecheckbox' + id)
                .parent()
                .parent()
                .find('.total-like')
                .text(totallike);
            }
          }
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  } else {
    alert('Theres an error while, getting post data please refresh the page.');
  }
});

/*$(document).on('click', '.rmcbtncomment', function (e) {
  e.preventDefault();
  var myModal = new bootstrap.Modal(document.getElementById('videoshowModal'));
  var modalToggle = document.getElementById('videoshowModal');
  myModal.show(modalToggle);
});*/

$(document).on('click', '.addcommentbtn', function (e) {
  var postid = $(this).attr('data-post');
  var comment = $(this).parent().find('[name="comment"]').val();
  if (typeof postid !== 'undefined' && postid !== false) {
    console.log(postid);
    var mydata = {
      postid: postid,
      comment: comment,
      commentform: true,
    };
    var $this = $(this);
    console.log($this);
    console.log(commentaction);
    $.ajax({
      type: 'POST',
      url: baseurl + 'home/addcomment',
      data: mydata,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        if (data.error == false) {
          $this.parent().find('input[name="comment"]').val('');

          $('.rmc--commentarea ul').html('');
          rckymcdo.loadcomment(postid);
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  } else {
    rckymcdo.showerror();
  }
});

var pagepostid = $('.pagepost-section').attr('data-postid');
console.log(pagepostid);
if (typeof pagepostid !== 'undefined' && pagepostid !== false) {
  rckymcdo.loadcomment(pagepostid);
}
