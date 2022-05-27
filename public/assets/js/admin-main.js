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
