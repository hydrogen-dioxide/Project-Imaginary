function sendNotification(){
  $('button').click(function(){
    $('.alert').addClass("active");
    $('.alert').addClass("show");
    $('.alert').removeClass("hide");
    setTimeout(function(){
      $('.alert').removeClass("show");
      $('.alert').addClass("hide");
    },5000);
  });
  $('.close-btn').click(function(){
    $('.alert').removeClass("show");
    $('.alert').addClass("hide");
  });
}