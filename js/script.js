/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

(function(d) {
  var config = {
    kitId: 'zyv5mda',
    scriptTimeout: 3000
  },
  h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
})(document);

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {

	
	
	
$(window).load(function() {
  $("#edit-islandora-simple-search-query").val("Search Digital Library");

    $("#edit-islandora-simple-search-query").focus(function() {
      $(this).val("");
    });

   function update_header_position() {
      if ($('#admin-menu').length > 0) {
        $('#page').css('margin-top', $('#admin-menu').height());
      }
      if ($('#toolbar').length > 0) {
        $('#page').css('margin-top', $('#toolbar').height());
      }
    }
});

})(jQuery, Drupal, this, this.document);
