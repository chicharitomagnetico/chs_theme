<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 */

/**
 * Implements hook_preprocess().
 */
function chs_theme_preprocess_islandora_book_book(&$variables) {
  unset($variables['description']);
  unset($variables['parent_collections']);
}

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
  if (isset($object) && !is_null($object))
  if (!in_array("islandora:collectionCModel", $object->models)) {
    $region_name = 'sidebar_first';
    $block_name = 'menu_menu-quick-links';
    if (isset($variables[$region_name][$block_name])) {
      $variables[$region_name][$block_name]['#access'] = FALSE;
    }
  }
}

/**
 * Implement hook_preprocess().
 */
function chs_theme_preprocess_islandora_solr_search_navigation_block(&$variables) {
  $variables['previous'] = $variables['prev_link'];
  $variables['return'] = $variables['return_link'];
  $variables['next'] = $variables['next_link'];
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
 * Implements theme_menu_link().
 */
function chs_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  if ($variables['theme_hook_original'] = 'menu_link__menu_chs_links' &&
    $variables['element']['#title'] == t('Order Images & Permissions')) {
    $object = menu_get_object('islandora_object', 2);
    if (!is_null($object)) {
      $cmodels = explode(',', theme_get_setting('chs_theme_order_images_permissions'));
      foreach ($cmodels as $model) {
        if (in_array($model, $object->models)) {
          return '';
        }
      }
    } else {
      return '';
    }
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
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
 * Implements hook_preprocess().
 */
function chs_theme_preprocess_islandora_solr_metadata_display(&$variables) {
  $elevated = explode(",", theme_get_setting('chs_theme_elevated_collections'));

  if (in_array($variables['islandora_object']->id, $elevated)) {
    $variables['theme_hook_suggestions'][] = "islandora_solr_metadata_display__elevated_collections";
  }

  if (isset($variables['solr_fields']['mods_accessCondition_rightsStatement_ms'])) {
    $variables['solr_fields']['mods_accessCondition_rightsStatement_xlinkhref_ms'] = array();
  }
}

/**
 * Implements hook_process().
 */
function chs_theme_process_islandora_solr_metadata_display(&$variables) {
  $solr_fields = $variables['solr_fields'];

  if (isset($solr_fields['mods_accessCondition_rightsStatement_ms'])) {
    // Take the xlink and node values and create an anchor out of them.
    $link = reset($solr_fields['mods_accessCondition_rightsStatement_xlinkhref_ms']['value']);
    $text = reset($solr_fields['mods_accessCondition_rightsStatement_ms']['value']);

    if (!empty($text) && !empty($link)) {
      $variables['solr_fields']['mods_accessCondition_rightsStatement_ms']['value'] = array(
        0 => l($text, $link),
      );
    }
    // Unset value as we no longer need it.
    unset($variables['solr_fields']['mods_accessCondition_rightsStatement_xlinkhref_ms']);
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

  $variables['show_description'] = TRUE;
  $show_description = theme_get_setting('chs_theme_elevated_collections_description');
  if ($show_description) {
    $elevated = explode(",", theme_get_setting('chs_theme_elevated_collections'));
    if (!in_array($variables['islandora_object']->id, $elevated)) {
      $variables['show_description'] = FALSE;
    }
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
