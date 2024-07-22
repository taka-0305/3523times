$(function () {
  const header = $("header");
  $(window).on('scroll', function () {
    let scrollTop = $(window).scrollTop();
    if (scrollTop > 50) {
      header.addClass("fixed");
    }else{
      header.removeClass();
    }
  });
})