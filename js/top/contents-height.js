function getHeight() {
  const slideText = $(".slide-text");
  slideText.each(function () {
    var title = $(this).find(".title").outerHeight();
    var source = $(this).find(".source").outerHeight();
    $(this).height(title + source);
  })
}

$(window).on('load', getHeight);
$(window).on('resize', getHeight);