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

jQuery(document).ready(function($) {
  $('*[data-href]').on('click', function() {
      window.location = $(this).data("href");
  });
});

function copy_code(id) {
    var copyText = document.getElementById(id).innerText;
    navigator.clipboard.writeText(copyText);
    sendNotification();
}

/* THEMES */
// function to set a given theme/color-scheme
function setTheme(themeName) {
  localStorage.setItem('theme', themeName);
  document.documentElement.className = themeName;
}

// function to toggle between light and dark theme
function changeTheme() {
  if (localStorage.getItem('theme') === 'darkmode'){
    setTheme('lightmode');
  } else {
    setTheme('darkmode');
  }
}

// Immediately invoked function to set the theme on initial load
(function () {
  if (localStorage.getItem('theme') === 'darkmode') {
    setTheme('darkmode');
    return;
  }
  if (localStorage.getItem('theme') === 'lightmode') {
    setTheme('lightmode');
    return;
  }
  var preference = window.matchMedia('(prefers-color-scheme: dark)');
  if (preference.matches) {
    setTheme('darkmode');
  } else {
    setTheme('lightmode');
  }
})();