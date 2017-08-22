
//whenever the user scrolls, measure how far we have scrolled
$(window).scroll(function() {
  var windowTop = $(window).scrollTop();

  //check to see if we have scrolled past the original location of the sticky element
  if (windowTop > 400) {
    //if so, change the sticky element to fised positioning
    $(".nav").addClass("sticky");
  }else
  {   
    $(".nav").removeClass("sticky");
  }
});