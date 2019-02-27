formLoginBar();


$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('title') // Extract info from data-* attributes
  var content = button.data('content')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(id)
  modal.find('.modal-body').text(content)

})

function formLoginBar() {
  var eventMail = document.querySelector('.mail-event');
  var eventPassword = document.querySelector('.password-event');
  if (eventMail) {
    eventMail.addEventListener("focus", function () {
      document.styleSheets[0].addRule('span.progress:before', 'width: 100%');
    }, true);
    eventMail.addEventListener("blur", function () {
      document.styleSheets[0].addRule('span.progress:before', 'width: 0%');
    }, true);
    eventPassword.addEventListener("focus", function () {
      document.styleSheets[0].addRule('span.progress-2:before', 'width: 100%');
    }, true);
    eventPassword.addEventListener("blur", function () {
      document.styleSheets[0].addRule('span.progress-2:before', 'width: 0%');
    }, true);
  }
}