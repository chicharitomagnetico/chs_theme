<?php

/**
 * @file
 * islandora-basic-collection-wrapper.tpl.php
 *
 * @TODO: needs documentation about file and variables
 */
?>

<div class="islandora-basic-collection-wrapper">
  <?php if (isset($islandora_collection_search_block)): ?>
    <div class="collection-search-wrapper"><?php print $islandora_collection_search_block; ?></div>
  <?php endif; ?>
  <?php if ($display_metadata): ?>
    <div class="islandora-collection-metadata">
      <?php if ($show_description):?>
        <?php print $description; ?>
      <?php endif;?>
      <div class="islandora-collection-metadata">
      <?php if ($parent_collections): ?>
        <div>
          <h2><?php print t('In collections'); ?></h2>
          <ul>
            <?php foreach ($parent_collections as $collection): ?>
              <li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      </div>
      <?php print $metadata; ?>
    </div>
  <?php endif; ?>
  <?php if (isset($islandora_object['OBJ'])): ?>
    <div class="islandora-basic-collection-image-obj-wrapper"><img src="/islandora/object/<?php print $islandora_object->id; ?>/datastream/OBJ/view"></img></div>
  <?php endif; ?>
  <div class="islandora-basic-collection clearfix">
    <span class="islandora-basic-collection-display-switch">
      <ul class="links inline">
        <?php foreach ($view_links as $link): ?>
          <li>
            <a <?php print drupal_attributes($link['attributes']) ?>><?php print filter_xss($link['title']) ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </span>
    <?php print $collection_pager; ?>
    <?php print $collection_content; ?>
    <?php print $collection_pager; ?>
  </div>
</div>
