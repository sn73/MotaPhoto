(function ($) {
   $(document).on("click", ".prev-link, .next-link", function (event) {
      event.preventDefault();
      alert("Clicked Link");
   });
})(jQuery);
