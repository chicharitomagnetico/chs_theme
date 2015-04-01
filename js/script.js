/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// Place your code here.

$(window).load(function() { 
  $("#edit-islandora-simple-search-query").val("Search this repository");

    $("#edit-islandora-simple-search-query").focus(function() {
      $(this).val("");
    });
    
   function update_header_position() {
      if ($('#admin-menu').length > 0) {
        $('#page').css('margin-top', $('#admin-menu').height());
      }
    }
  
    var $window = $(window);
    var flexslider = $('.flexslider').data('flexslider');
    
    var $window = $(window);

    function getGridSize() {
      return (window.innerWidth < 600) ? 2 :
        (window.innerWidth < 900) ? 3 : 6;
    }

    function fixItemCount() {
      update_header_position();
      var gridSize = getGridSize();
      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
    }
  $(window).resize(function() {
    fixItemCount();
  });

    fixItemCount();
});

})(jQuery, Drupal, this, this.document);