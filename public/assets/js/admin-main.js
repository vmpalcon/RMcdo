/*!
 * Web Projects
 * Copyright © 2022 Purplepatch Services LLC.
 */
$('body').removeClass('bd-init');
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
