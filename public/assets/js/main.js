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

var rckymcdo = {
  resetfileupload: function () {
    $('.info-star').html(
      `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
    );
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
    var profilephoto = 'uploads/header-profile.png',
      profilename = 'Jtnsmth',
      caption = $('.txtcaption').val(),
      isvideoimg = $('.videotype').val(),
      postvideo = $('#previewvideo').find('source').attr('src');

    let imglist = [];
    $('.carousel-inner .carousel-item').each(function () {
      imglist.push($(this).find('img').attr('src'));
    });

    var output = {
      profilephoto: profilephoto,
      profilename: profilename,
      caption: caption,
      isvideoimg: isvideoimg,
      postvideo: postvideo,
      imglist: imglist,
      postvideoform: true,
    };
    rckymcdo.preloader('show');

    var formData = new FormData();
    var filesLength = document.getElementById('video_upload').files.length;
    var title = $('#submit_post').find('input[name="caption"]').val(),
      videotype = $('#submit_post').find('input[name="videotype"]').val(),
      privacytype = $('#submit_post').find('select[name="privacytype"]').val();

    formData.append('title', title);
    formData.append('isvideoimg', videotype);
    formData.append('privacytype', privacytype);
    formData.append('postvideoform', true);
    for (var i = 0; i < filesLength; i++) {
      formData.append('files[]', document.getElementById('video_upload').files[i]);
    }

    $('.btndiscardvideo').prop('disabled', true);
    $('.btnpostvideo').prop('disabled', true);
    $('.btnpostvideo').addClass('button--loading');
    var form = $('#submit_post');
    var actionUrl = form.attr('action');
    console.log(actionUrl);
    $.ajax({
      type: 'POST',
      url: actionUrl,
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        $('.btnpostvideo').removeClass('button--loading');
        $('.btndiscardvideo').prop('disabled', false);
        $('.btnpostvideo').prop('disabled', false);

        rckymcdo.preloader('hide');
        rckymcdo.resetupload();

        data = JSON.parse(data);
        console.log(data);
        if (data.error == false) {
          $('.msgoutput').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
          Your post has been submitted. This post is subject for approval and will informed you once approved.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`);
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
    $('.preview-area').removeClass('active');
    rckymcdo.resetfileupload();
    $('.photopreview-area').find('.carousel-indicators').html('');
    $('.photopreview-area').find('.carousel-inner').html('');
    $('#alertreplaceModal').modal('hide');
    $('.btnpostvideo').prop('disabled', true);
  },
  resetupload: function () {
    var vid = document.getElementById('previewvideo');
    vid.pause();
    $('#previewvideo').html('');
    $('.load-area').show();
    $('.preview-area').removeClass('active');
    rckymcdo.resetfileupload();
    $('.btnpostvideo').prop('disabled', true);
    $('.photopreview-area').find('.carousel-indicators').html('');
    $('.photopreview-area').find('.carousel-inner').html('');
    $('#submit_post')[0].reset();
    $('#alertModal').modal('hide');
  },
  shownotification: function (_this) {
    $(_this).parent().find('.notification-wrapper').toggleClass('active');
  },
  triggerupload: function () {
    $('#video_upload').trigger('click');
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
    localStorage.setItem('rockymountainsxmcdo_auth', 'true');
    setTimeout(function () {
      rckymcdo.preloader('hide');
      console.log(localStorage.getItem('rockymountainsxmcdo_auth'));
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
    localStorage.removeItem('rockymountainsxmcdo_auth');
    setTimeout(function () {
      rckymcdo.preloader('hide');
      location.reload();
    }, 3000);
  },
  copylink: function (_this) {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val('http://rockymountain.co/rmxmcdo/?fbclid=I').select();
    document.execCommand('copy');
    $temp.remove();
    $('.toast-container').append(`
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="500" >
          <div class="toast-body">
           Copied
          </div>
        </div>
      `);

    $('.toast').each(function (index, e) {
      $(e).toast('show');
    });
    $(_this).parent().parent().parent().removeClass('active');
    $('.toast').on('hidden.bs.toast', e => {
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
    notification = $('.notification-wrapper');
  if (!searchcontainer.is(e.target) && searchcontainer.has(e.target).length === 0) {
    searchcontainer.removeClass('active');
  }
  if (!sharecontainer.is(e.target) && sharecontainer.has(e.target).length === 0) {
    $(sharecontainer).removeClass('active');
  }
  if (!notification.is(e.target) && notification.has(e.target).length === 0) {
    $(notification).removeClass('active');
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
    setTimeout(function () {
      $.getJSON('search.json', function (data) {
        $('.searchloading').hide();

        var q = $('#search').val();
        $('.header-search-wrap').addClass('active');
        var res = [];
        data.sort((a, b) => a.title.localeCompare(b.title));
        for (var i = 0; i < data.length; i++) {
          res.push(data[i].title);
        }
        var search = new RegExp(q, 'i'); // prepare a regex object
        let b = res.filter(item => search.test(item));
        console.log(b);
        $('#searchresult').find('.searchlikeresult').html('');

        for (var i = 0; i < b.length; i++) {
          if (i <= 5) {
            $('#searchresult')
              .find('.searchlikeresult')
              .append('<li><a href="javascript:void(0)" class="searchhelper">' + b[i] + '</a></li>');
          }
        }
      });
    }, 500);
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

if ($('#video_upload')[0]) {
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

$('#videoshowModal').on('show.bs.modal', function (event) {
  $('.rmc--photovideo-source').html('');
  var getfiletype = $(event.relatedTarget).parent().attr('data-filetype');
  if (typeof getfiletype !== 'undefined' && preview !== getfiletype) {
    if (getfiletype == 'video') {
      var source = $(event.relatedTarget).attr('data-source');
      var preview = $(event.relatedTarget).attr('data-preview');
      if (typeof preview !== 'undefined' && preview !== false) {
        $('.rmc--photovideo-blurbg').css('background', "url('" + preview + "')");
      }
      $('.rmc--photovideo-source').html(
        `<video id="popupvideoplayer" loop="" autoplay="" controls>
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
      var source = $(event.relatedTarget).attr('data-source');
      $('.rmc--photovideo-source').html(`<img src="` + source + `" alt="" />`);
    }
  }
});
$('#videoshowModal').on('hide.bs.modal', function (event) {
  $('.rmc--photovideo-blurbg').removeAttr('style');
  if (document.getElementById('popupvideoplayer')) {
    var vid = document.getElementById('popupvideoplayer');
    vid.pause();
  }
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
  var limit = 3;
  var start = 0;
  var action = 'inactive';

  function load_data(limit, start) {
    $.ajax({
      url: 'home/fetch',
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

  if (action == 'inactive') {
    action = 'active';
    load_data(limit, start);
  }

  $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() > $('.timeline').height() && action == 'inactive') {
      $('.timeline-preloader').show();
      action = 'active';
      start = start + limit;
      setTimeout(function () {
        load_data(limit, start);
      }, 1000);
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
