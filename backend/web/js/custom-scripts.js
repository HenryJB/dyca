$(document).ready(function(){
$('.sufee-alert').hide();
  $('.modal-mail').click(function(e){
      e.preventDefault();
      $("#mediumModal").modal("show");
      $("#mediumModal").appendTo("body");
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

  $('.tag-box').click(function(e){
      e.preventDefault();
      $("#smallmodal").modal("show");
      $("#smallmodal").appendTo("body");
      return false;
  });


   $('#batch_tag_link').click(function (e) {
       alert("welcome");
       e.preventDefault();
       //alert('clicked');
       $("#batchTagModal").modal("show");
       $("#batchTagModal").appendTo("body");

       //$.ajax({
       //    url: '<?= Yii::$app->request->baseUrl?>/skills/get-skills',
       //    method: 'POST',
       //    success: function (data) {
       //        $('#batch-tag-box').show();
       //        // alert(data);
       //        $('#batch-tag-modal').html(data);
       //    },
       //    error: {}
       //});
       return false;
   });


});
