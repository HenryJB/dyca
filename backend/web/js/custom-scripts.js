$(document).ready(function(){
$('.sufee-alert').hide();
  $('.modal-mail').click(function(e){
    e.preventDefault();
      $("#mediumModal").modal();
      return false;
  });

  $('.sponsor').click(function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('href'),
        method: 'POST',
        success: function(data){
          $('.sufee-alert').show();
            $('.alert-msg-box').html(data);
        },
        error: {}
    });
      return false;
  });


  $('.selected-member').click(function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('href'),
        method: 'POST',
        success: function(data){
          $('.sufee-alert').show();
          $('.alert-msg-box').html(data);
        },
        error: {}
    });
      return false;
  });



});
