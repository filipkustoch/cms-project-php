$(document).ready(function () {
  $('#summernote').summernote();
  $('#selectAllBoxes').click(function (e) {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });
});
