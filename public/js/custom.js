var modal =  $("#Modal");//your modal 

$(document).on({
    ajaxStart: function() {
        modal.find(".modal-content").html("");//empty modal every ajaxstart
        $('.loading').show();
        modal.modal("hide");//hide

    },
    ajaxStop: function() {
        $('.loading').hide();
        modal.modal("show");//modal show
    }
});

$(document).ready(function () {
  $('.button').click(function() {
      var url = Routing.generate( 'project_show', {'id': $(this).attr('id')});
      $.get(url, function (data) { console.log(data)
          $(".modal-content").html(data);
      });
  });
});



  
formLoginBar();


function formLoginBar() {
  var eventMail = document.querySelector('.mail-event');
  var eventPassword = document.querySelector('.password-event');
  if (eventMail) {
    eventMail.addEventListener("focus", function () {
      document.styleSheets[0].addRule('span.underline:before', 'width: 100%');
    }, true);
    eventMail.addEventListener("blur", function () {
      document.styleSheets[0].addRule('span.underline:before', 'width: 0%');
    }, true);
    eventPassword.addEventListener("focus", function () {
      document.styleSheets[0].addRule('span.underline-2:before', 'width: 100%');
    }, true);
    eventPassword.addEventListener("blur", function () {
      document.styleSheets[0].addRule('span.underline-2:before', 'width: 0%');
    }, true);
  }
}

