<?php
/**
 * @file
 * Islandora solr search navigation block.
 *
 * Variables available:
 * - $return_link: link to reutrn to original search.
 * - $prev_link: Link to previous object in search result.
 * - $next_link: link to next object in the search result.
 *
 */
?>

<div class="islandora-solr-search-nav-content">
  <div id="islandora-solr-search-prev-link">
    <a href="<?php print $previous;?>" title="<?php print t("Last Object");?>"><i class="font fontello icon-left-bold"></i></a>
  </div>
  <div id="islandora-solr-search-return-link">
    <a href="<?php print $return;?>" title="<?php print t("Return to search results");?>"><i class="font fontello icon-back"></i></a>
  </div>
  <div id="islandora-solr-search-next-link">
    <a href="<?php print $next;?>" title="<?php print t("Next Object");?>"><i class="font fontello icon-right-bold"></i></a>
  </div>
</div>
