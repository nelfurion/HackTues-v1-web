function changeFrame(id) {
      document.getElementById('page-field').src = id + '.html';
      
      $("input").click(function() {
            $('html, body').animate({
              scrollTop: $("#hi").offset().top
            }, 500);
      });
}