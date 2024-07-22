$(function () {
  const contents = $(".slide-image");
  var contentsPosition = [];
  function resizeWindow() {
    contentsPosition = [];
    contents.each(function () {
      var left = $(this).offset().left;
      var width = $(this).width();
      var windowWidth = $(window).innerWidth();
      var center = (left + (width / 2) - (windowWidth / 2)) * -1;
      contentsPosition.push(center);
    })
  }
  resizeWindow()
  slideBack(1);
  $(window).resize(function(){
    $(".slider-wrapper").css({
      transform: "",
      transition: ""
    });
    resizeWindow()
    slideBack(i-1)
  });
  function addClassButton(num) {
    const list = $('.slider-button ul li');
    list.removeClass('isShow');
    list.eq(num - 1).addClass('isShow');
  }
  function slide(num) {
    $(".slider-wrapper").css({
      transform: "translateX(" + contentsPosition[num] + "px)",
      transition: "all 0.5s"
    });
    contents.removeClass('isShow');
    contents.eq(num).addClass('isShow');
    addClassButton(num);
  };
  function slideBack(num) {
    addClassButton(num);
    $(".slider-wrapper").css({
      transform: "translateX(" + contentsPosition[num] + "px)",
      transition: "all 0s"
    });
    contents.removeClass('isShow');
    contents.eq(num).addClass('isShow');
  }
  var i = 2;
  function slideProg() {
    i = i % (contents.length - 1);
    if (i == contents.length - 2) {
      slide(i);
      i = 1;
      addClassButton(i);
      setTimeout(() => 
      {
        slideBack(i);
        i++;
      }, 500);
    } else {
      slide(i);
      i++;
    }
  }
  var slideInterval = setInterval(slideProg, 3000);
  const slideButoon = $('.slider-button ul li button');
  slideButoon.on('click', function () {
    var num = $(this).val();
    clearInterval(slideInterval);
    slide(num++);
    i = num;
    slideInterval = setInterval(slideProg, 3000);
  })
})
