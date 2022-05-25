/*!
 * Web Projects
 * Copyright © 2022 Purplepatch Services LLC.
 */
$('body').removeClass('bd-init');

/*------------------------
        Video Mousrover
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

var element = document.querySelector('.rmc--leftpane');
var leftpane = new Optiscroll(element);

var searchresult = new Optiscroll(document.getElementById('searchresult'), { forceScrollbars: true });

$(document).on('click', '.btnlike', function (e) {
  e.preventDefault();
  $(this).toggleClass('active');
});

$('#phoneField1').CcPicker({
  countryCode: 'PH',
});
$('#phoneField1').on('countrySelect', function (e, i) {
  console.log(i.countryName + ' ' + i.phoneCode);
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
    };
    rckymcdo.preloader('show');
    if (isvideoimg == 'video') {
      $('.rmc--rightpane.timeline').prepend(
        `
      <div class="rmc--video-card hidden">
      <div class="rmc--profile">
         <div><a href="#"><img src="` +
          profilephoto +
          `" alt=""></a></div>
         <div>
            <div class="rmc--profile-photo">
               <div><a href="#"><img src="` +
          profilephoto +
          `"
                        class="rmc--profile-userimg" alt=""></a></div>
            </div>
            <div class="rmc--profile-username" title="Justin Smith"><a
                  href="#">` +
          profilename +
          `</a></div>
            <div class="rmc--profile-title">` +
          caption +
          `</div>
            <div class="rmc--video-timeline">
               <div>
                  <div class="rmc--video-wrap" data-filetype="` +
          isvideoimg +
          `">
                     <div class="loader">
                        <div class="loader-wheel"></div>
                     </div>
                     <video class="rmc--video" id="rmc-video-99" loop="" muted="muted"
                        onmouseover="mouseover('rmc-video-99')"
                        onmouseout="mouseout('rmc-video-99')" data-bs-toggle="modal"
                        data-bs-target="#videoshowModal"
                        data-source="` +
          postvideo +
          `">
                        <source src="` +
          postvideo +
          `" type="video/mp4" playsinline>
                     </video>
                     <div class="rmc--video-tool">

                        <div class="video-total-view">
                           <i class="fas fa-play"></i> 0
                        </div>
                     </div>
                  </div>
               </div>
               <div class="rmc--profile-snippet">
                  <div><a href="#" class="btn btn-primary">Follow</a></div>
                  <div class="rmc--snippet-tool">
                     <ul>
                        <li><a href="javascript:void(0)" class="btnlike"><span
                                 class="rmc--snippet-icon like"></span>
                              <span class="rmc--snippet-text total-like">0</span></a>
                        </li>
                        <li><a href="javascript:void(0)"><span
                                 class="rmc--snippet-icon comment"></span>
                              <span
                                 class="rmc--snippet-text total-comment">0</span></a>
                        </li>
                        <li><a href="javascript:void(0)"
                              onclick="rckymcdo.share(this)"><span
                                 class="rmc--snippet-icon share"></span>
                              <span
                                 class="rmc--snippet-text total-share">0</span></a>
                           <div class="rmc--share">
                              <ul>
                                 <li><a href="javascript:void(0)"
                                       class="embed">Embed</a>
                                 </li>
                                 <li><a href="javascript:void(0)"
                                       class="sendtofriends">Send to friends</a></li>
                                 <li><a href="javascript:void(0)" class="copylink"
                                       onclick="rckymcdo.copylink(this)">Copy
                                       Link</a></li>
                                 <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftestblock.co%2Frmxmcdo&quote=Nature+really+hit+different"
                                       target="_blank" class="sharetofb"
                                       onclick="rckymcdo.closeshare(this)">Share
                                       to Facebook</a>
                                 </li>
                                 <li><a href="https://www.linkedin.com/sharing/share-offsite?url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetolinkedin"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       LinkedIn</a>
                                 <li><a href="https://www.twitter.com/share?text=Nature+really+hit+different&url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetotwitter"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       Twitter</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
      `,
      );
    } else {
      console.log('image');
      $('.rmc--rightpane.timeline').prepend(
        `<div class="rmc--video-card">
      <div class="rmc--profile">
         <div><a href="#"><img src="` +
          profilephoto +
          `" alt=""></a></div>
         <div>
            <div class="rmc--profile-photo">
               <div><a href="#"><img src="` +
          profilephoto +
          `"
                        class="rmc--profile-userimg" alt=""></a></div>
            </div>
            <div class="rmc--profile-username" title="Justin Smith"><a
                  href="#">` +
          profilename +
          `</a></div>
            <div class="rmc--profile-title">` +
          caption +
          `</div>
            <div class="rmc--video-timeline">
               <div>
                  <div class="rmc--video-wrap" data-filetype="` +
          isvideoimg +
          `">
                     <img src="` +
          imglist[0] +
          `" alt="" data-bs-toggle="modal"
                        data-bs-target="#videoshowModal"
                        data-source="` +
          imglist[0] +
          `" />
                     <div class="rmc--video-tool">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <div class="rmc--profile-snippet">
                  <div><a href="#" class="btn btn-primary">Follow</a></div>
                  <div class="rmc--snippet-tool">
                     <ul>
                        <li><a href="javascript:void(0)" class="btnlike"><span
                                 class="rmc--snippet-icon like"></span>
                              <span class="rmc--snippet-text total-like">0</span></a>
                        </li>
                        <li><a href="javascript:void(0)"><span
                                 class="rmc--snippet-icon comment"></span>
                              <span
                                 class="rmc--snippet-text total-comment">0</span></a>
                        </li>
                        <li><a href="javascript:void(0)"
                              onclick="rckymcdo.share(this)"><span
                                 class="rmc--snippet-icon share"></span>
                              <span
                                 class="rmc--snippet-text total-share">0</span></a>
                           <div class="rmc--share">
                              <ul>
                                 <li><a href="javascript:void(0)"
                                       class="embed">Embed</a>
                                 </li>
                                 <li><a href="javascript:void(0)"
                                       class="sendtofriends">Send to friends</a></li>
                                 <li><a href="javascript:void(0)" class="copylink"
                                       onclick="rckymcdo.copylink(this)">Copy
                                       Link</a></li>
                                 <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftestblock.co%2Frmxmcdo&quote=Nature+really+hit+different"
                                       target="_blank" class="sharetofb"
                                       onclick="rckymcdo.closeshare(this)">Share
                                       to Facebook</a>
                                 </li>
                                 <li><a href="https://www.linkedin.com/sharing/share-offsite?url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetolinkedin"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       LinkedIn</a>
                                 <li><a href="https://www.twitter.com/share?text=Nature+really+hit+different&url=http%3A%2F%2Ftestblock.co%2Frmxmcdo"
                                       target="_blank" class="sharetotwitter"
                                       onclick="rckymcdo.closeshare(this)">Share to
                                       Twitter</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>`,
      );
    }
    $('.btndiscardvideo').prop('disabled', true);
    $('.btnpostvideo').prop('disabled', true);
    $('.btnpostvideo').addClass('button--loading');
    setTimeout(function () {
      $('.btnpostvideo').removeClass('button--loading');
      $('.btndiscardvideo').prop('disabled', false);
      $('.btnpostvideo').prop('disabled', false);
      rckymcdo.openviewupload('#nav-home');
      rckymcdo.preloader('hide');
      rckymcdo.resetupload();
      setTimeout(function () {
        $('.rmc--video-card').removeClass('hidden');
      }, 500);
    }, 5000);
  },
  replacevideo: function () {
    var vid = document.getElementById('previewvideo');
    vid.pause();
    $('#previewvideo').html('');
    $('.load-area').show();
    $('.preview-area').removeClass('active');
    $('.info-star').html(
      `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
    );
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
    $('.info-star').html(
      `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
    );
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

if (localStorage.getItem('rockymountainsxmcdo_auth') !== null) {
  $('.rmc--auth-mainleftpane').show();
  $('.header-auth-area').show();
  $('.header-button-area').hide();
  $('.rmc--login-widget').hide();
  $('.rmc--leftpane-menu').hide();
}
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

const input = document.getElementById('video_upload');
const video = document.getElementById('previewvideo');
const videoSource = document.createElement('source');

input.addEventListener('change', function (e) {
  $('.info-star').html(`<div class="circular"> <div class="inner"></div>
  <div class="number">100%</div> <div class="circle">
  <div class="bar left"> <div class="progress"></div> </div> <div class="bar right">
  <div class="progress"></div> </div>
  </div> </div><div style="margin-top: 10px;">Uploading please wait...</div>`);

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
            $('.info-star').html(
              `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
            );
            $('.msgoutput').html('<div class="msgform">Maximum 5 Photos or 1 per Video are allowed</div>');
            return true;
          }
          var err = 0;
          $('.videotype').val('image');
          for (var i = 0, f; (f = allfiles[i]); i++) {
            if (f.type == 'video/mp4') {
              $('.info-star').html(
                `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
              );
              $('.msgoutput').html(
                '<div class="msgform">Error you cannot upload photo and video at the sametime and only 1 per video are allowed to upload.</div>',
              );
              $('.load-area').show();
              $('.photopreview-area').find('.carousel-indicators').html('');
              $('.photopreview-area').find('.carousel-inner').html('');
              err = err + 1;
              return true;
            } else {
              $('.load-area').hide();
              $('.msgoutput').html('');
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
                  //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));
                  $('.btnpostvideo').prop('disabled', false);
                  $('.carousel-indicators button:first-child').addClass('active');
                  $('#carouselRmxmcdo').find('.carousel-inner .carousel-item:first-child').addClass('active');
                  count++;
                }
              };

              reader.readAsDataURL(e.target.files[i]);
            }
          }
        } else {
          var currfile = e.target.files[0];
          console.log(currfile);
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
          } else if (currfile.type == 'image/png' || currfile.type == 'image/jpg' || currfile.type == 'image/gif') {
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
                .append('<div class="carousel-item" data-bs-interval="10000"> <img src="' + event.target.result + '" alt="..."> </div>');
              //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));
              $('.btnpostvideo').prop('disabled', false);
              $('.carousel-indicators button:first-child').addClass('active');
              $('#carouselRmxmcdo').find('.carousel-inner .carousel-item:first-child').addClass('active');
              count++;
              //$($.parseHTML('<img>')).attr('src', event.target.result).appendTo($('.photopreview-area'));
            };

            reader.readAsDataURL(e.target.files[0]);
          } else {
            $('.info-star').html(
              `<h5>Select Video / Image to upload</h5> <p>MP4 or WebM<br /> 720x1280 resolution or higher<br /> Up to 10 minutes<br /> Less than 2 GB</p> <div><button type="button" class="btn btn-primary" onclick="rckymcdo.triggerupload(this)"> Select File</button></div>`,
            );
            $('.msgoutput').html('File not supported, please make sure to upload mp4, webm, jpg, gif, png');
          }
        }
      }, 1500);
    } else {
      counter += 1;
      numb.textContent = counter + '%';
    }
  }, 15);
});

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
