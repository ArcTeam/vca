$(document).ready(function() {
  $('#summernote').summernote({
    toolbar: [
      ['style', ['bold', /*'italic',*/ 'underline'/*, 'clear'*/]],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert',['picture','link',/*'video',*/'table','hr']],
      ['misc',['codeview']]
    ]
  });
  $('.note-resizebar').remove();
  $('.note-editor.note-frame').css('border','none');
});
