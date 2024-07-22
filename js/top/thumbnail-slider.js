$(function () {
  const contentsCheck = $(".slide");
  var classArray = [];
  setClass();
  startSlide();
  window.addEventListener('load', function () {
    timerArray = [];
    contentsCheck.each(function (index) {
      var i = 1;
      timerStart = (wrapper,index) => { 
        var timer = setInterval(function () {
          var check = timerWrap(i,wrapper,index)
          if (check) {
            i++;
          }
        }.bind(this), 6000);
        timerArray.push(timer);
      }
      timerStart(this,index)
    })
  });
  /* contentsCheck.each(function (index) {
    $(this).hover(function () {
      clearInterval(timerArray[index]);
    }, function () {
      startSlide()
      timerStart(this,index);
    });
  }) */
  const hoverElement = $(".info-wrapper .info");
  $(".product-wrapper.slide").mouseenter(function () {
    var index = $(".isTop").closest(".product-slide").index()
    hoverElement.eq(index).addClass("isShow");
  })
  hoverElement.mouseleave(function () {
    hoverElement.removeClass("isShow");
  })
  
  window.addEventListener('scroll', function () {
    let scrollTop = $(window).scrollTop();
    let windowHeight = $(window).innerHeight();
    let scrollBottom = scrollTop + windowHeight;
    contentsCheck.each(function () {
      var contenstsPosition = $(this).offset();
      var contentsPositionBottom = contenstsPosition.top + $(this).outerHeight();
      if (scrollBottom > contenstsPosition.top && contentsPositionBottom > scrollTop) {
        $(this).removeClass("stop");
      }else{
        $(this).addClass("stop");
      }
    })
  });
  function timerWrap(i,wrapper,index) {
    var check = false;
    check = slideProg(i, wrapper, classArray[index]);
    return check;
  }
  function startSlide() {
    contentsCheck.each(function (index) {
      slide(0, classArray[index])
    })
  }
  function setClass() {
    contentsCheck.each(function () {
      childClassName = $(this).children();
      classArray.push(childClassName);
    })
  }
  function getStop(n) {
    if ($(n).hasClass("stop")) {
      console.log(false)
      return false;
    } else {
      console.log(true)
      return true
    }
  }
  function slide(num, contents) {
    var beforeContents = num - 1;
    var pastContens;
    if (beforeContents < 0) {
      beforeContents = contents.length - 1
    }
    pastContens = beforeContents - 1;
    contents.eq(pastContens).css({
      "z-index": 0
    })
    contents.eq(beforeContents).css({
      "z-index": 1
    })
    contents.eq(num).css({
      "z-index": contents.length - 1
    })
    if (contents.eq(pastContens).hasClass("isShow")) {
      contents.eq(pastContens).removeClass("isShow");
    }
    contents.eq(beforeContents).removeClass("isTop");
    contents.eq(num).addClass("isShow");
    contents.eq(num).addClass("isTop");
  }
  function slideProg(indexNum, wrapper, contents) {
    if (!$(wrapper).hasClass("stop")) {
      var indexNum = indexNum % contents.length;
      slide(indexNum, contents);
      return true
    } else {
      return false
    }
  }
})