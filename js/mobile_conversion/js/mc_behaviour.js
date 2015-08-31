(function ($) {
Drupal.behaviors.gal_theme_carousel = {
  attach: function (context, settings) {
    $(".nav-button").click(function () {
      $(".nav-button, .primary-nav").toggleClass("open");
    }); 
  }
};
})(jQuery);
