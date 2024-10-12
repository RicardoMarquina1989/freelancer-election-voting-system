(function ($) {
  $("#mySelect").change(function () {
    $(this).parents("form").submit();
  });
})(jQuery);
