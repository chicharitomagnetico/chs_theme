<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function chs_theme_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  $form['chs_theme_custom'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom Settings'),
    '#weight' => 5,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['chs_theme_custom']['chs_theme_omit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Remove collections from search results.'),
    '#default_value' => theme_get_setting('chs_theme_omit'),
    '#description' => t("If checked, this option will automatically omit objects with a collection content model from search results."),
  );
  $form['chs_theme_custom']['chs_theme_background_image_datastream'] = array(
    '#type' => 'textfield',
    '#title' => t('Frontpage Slideshow Datastream'),
    '#default_value' => theme_get_setting('chs_theme_background_image_datastream'),
    '#description' => t("Set the default background image datastream used in the front page slideshow. Defaults to 'TN'."),
  );
  $form['chs_theme_custom']['chs_theme_order_images_permissions'] = array(
    '#type' => 'textfield',
    '#title' => t('Order Images & Permissions'),
    '#default_value' => theme_get_setting('chs_theme_order_images_permissions'),
    '#description' => t("Omit the 'Order Images & Permissions' link in the 'CHS Links' menu for the configured comma seperated list of content models. Defaults to 'islandora:collectionCModel'"),
  );
  $form['chs_theme_custom']['chs_theme_elevated_collections'] = array(
    '#type' => 'textfield',
    '#title' => t('Elevated Collection PIDs'),
    '#default_value' => theme_get_setting('chs_theme_elevated_collections'),
    '#description' => t("Comma seperated list of elevated collection PIDS. These objects (collections) will be presented with a view description and title above the fold, and not show its default metadata fieldset."),
  );
  $form['chs_theme_custom']['chs_theme_elevated_collections_view'] = array(
    '#type' => 'textfield',
    '#title' => t('Elevated collections view machine name'),
    '#default_value' => theme_get_setting('chs_theme_elevated_collections_view'),
    '#description' => t("Machine name of the view to use at the top of elevated collections."),
  );
  $form['chs_theme_custom']['chs_theme_elevated_collections_description'] = array(
    '#type' => 'select',
    '#title' => t('Show collection description only on elevated collections.'),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => theme_get_setting('chs_theme_elevated_collections_description'),
    '#description' => t("Show description fields only for previously configured elevated collections."),
  );
  $form['chs_theme_custom']['chs_theme_collection_search'] = array(
    '#type' => 'select',
    '#title' => t('Collection Search Box'),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => theme_get_setting('chs_theme_collection_search'),
    '#description' => t("Enable to display collection search on collection object pages"),
  );
}
