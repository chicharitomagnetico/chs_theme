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
