function changeFrame(id) {
      $('html, body').animate({
        scrollTop: $("#hi").offset().top
      }, 500);
      
      document.getElementById('page-field').src = id + '.html';
      
}