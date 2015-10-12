


function footerHeight() {
  $('.footer-v1').css({'opacity':1});
  var bodyHeight = $('body').height();
  var windowHeight = $(window).height();
//
  if(bodyHeight < windowHeight+5) {
    $('.footer-v1').addClass('fixed_footer');
    console.log("Mr Garrison");
  } else {
    $('.footer-v1').removeClass('fixed_footer');
    console.log("Wendy Testaburger");
  }
}

$(window).resize(function () {
  footerHeight();
});

$(document).ready(function () {
  footerHeight();
  changeSidebarList();
});


/*
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+++++ functions for view_updates.php
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

function changeSidebarList() {
// respond to user changing the switch value. Use ajax 
  $('#chbSideList').change(function(){
    console.log(this.checked);
    $.ajax({
      method: "GET",
      url: "displaySidebarList.php",
      success: function (output) {
        $('.list-group').html = output;
      }
    });
  });
}