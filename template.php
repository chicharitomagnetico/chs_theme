<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 */

/**
 * Implements hook_preprocess_page().
 */
function chs_theme_preprocess_page(&$variables) {
  $path = current_path();
  $path_array = explode("/", $path);
  if (count($path_array) >= 2) {
    if ($path_array[0] == 'islandora' && $path_array[1] == 'search'){
      drupal_set_title("Items");
    }
  }
}

/**
 * Implements hook_page_alter().
 */
function chs_theme_page_alter(&$variables) {
  $object = menu_get_object('islandora_object', 2);
  if (!in_array("islandora:collectionCModel", $object->models)) {
    $region_name = 'sidebar_first';
    $block_name = 'menu_menu-quick-links';
    if (isset($variables[$region_name][$block_name])) {
      $variables[$region_name][$block_name]['#access'] = FALSE;
    }
  }
}

/**
 * Theme function to create a clipper link.
 */
function chs_theme_islandora_openseadragon_clipper(&$variables) {
  return l(
    "Clip Image",
    "islandora/object/{$variables['pid']}/print",
    array(
      'attributes' => array(
        'title' => t('Clip Image'),
        'id' => 'clip',
      ),
      'html' => TRUE,
    )
  );
}

/**
 * Implements hook_form_alter().
 */
function chs_theme_form_islandora_solr_simple_search_form_alter(&$form, &$form_state, $form_id) {
  $link = array(
    '#markup' => l(t("Advanced Search"), "advanced-search", array('attributes' => array('class' => array('adv_search')))),
  );
  $form['simple']['advanced_link'] = $link;
  $form['simple']['islandora_simple_search_query']['#attributes']['placeholder'] = t("Search Repository");
}

/**
 * Implements hook_preprocess().
 */
function chs_theme_preprocess_islandora_basic_collection(&$variables) {
  foreach ($variables['associated_objects_array'] as $key => $value) {
    $variables['associated_objects_array'][$key]['classes'] = array();
    if (in_array("islandora:collectionCModel", $value['object']->models)) {
      array_push($variables['associated_objects_array'][$key]['classes'], 'islandora-default-thumb');
    }
  }
}

/**
 * Implements hook_preprocess().
 */
function chs_theme_preprocess_islandora_basic_collection_grid(&$variables) {
  foreach ($variables['associated_objects_array'] as $key => $value) {
    $variables['associated_objects_array'][$key]['classes'] = array();
    if (in_array("islandora:collectionCModel", $value['object']->models)) {
      array_push($variables['associated_objects_array'][$key]['classes'], 'islandora-default-thumb');
    }
  }
}

/**
 * Implements hook_menu_tree().
 */
function chs_theme_menu_tree__menu_site_navigation($variables) {
  return '<ul class="menu primary-nav">' . $variables['tree'] . '</ul>';
}

/**
 * Implements hook_preprocess().
 */
function chs_theme_preprocess_islandora_basic_collection_wrapper(&$variables) {
  if (theme_get_setting('chs_theme_collection_search') && module_exists('islandora_collection_search')) {
    $block = module_invoke('islandora_collection_search', 'block_view', 'islandora_collection_search');
    $variables['islandora_collection_search_block'] = render($block['content']);
  }
}

/**
 * Implements hook_islandora_solr_query_alter().
 */
function chs_theme_islandora_solr_query_alter($islandora_solr_query) {
  // Remove objects with the content model islandora:collectionCModel
  // from the search results page.
  if (theme_get_setting('chs_theme_omit')) {
    $path = current_path();
    $path_array = explode("/", $path);
    if (count($path_array) >= 2){
      if ($path_array[0] == "islandora" && $path_array[1] == "search") {
        $islandora_solr_query->{'solrParams'}['fq'][] = "-RELS_EXT_hasModel_uri_ms:info\:fedora/islandora\:collectionCModel";
      }
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function chs_theme_block_view_islandora_usage_stats_recent_activity_alter(&$data, $block) {
  foreach($data['content']['#items'] as $key => $value) {
    $pid = $value['data-pid'];
    $new_content = "<div class='new-collections-item-wrapper popular-resources'><a href='/islandora/object/$pid'>"
      . "<img src='/islandora/object/$pid/datastream/TN/view'></img></a>"
      . $data['content']['#items'][$key]['data'] . "</div>";
    $data['content']['#items'][$key]['data'] = $new_content;
  }
}
