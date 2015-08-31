<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function tul_theme_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  $form['tul_theme_custom'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom Settings'),
    '#weight' => 5,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['tul_theme_custom']['tul_theme_omit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Remove collections from search results.'),
    '#default_value' => theme_get_setting('tul_theme_omit'),
    '#description' => t("If checked, this option will automatically omit objects with a collection content model from search results."),
  );
  $form['tul_theme_custom']['tul_theme_background_image_datastream'] = array(
    '#type' => 'textfield',
    '#title' => t('Frontpage Slideshow Datastream'),
    '#default_value' => theme_get_setting('tul_theme_background_image_datastream'),
    '#description' => t("Set the default background image datastream used in the front page slideshow. Defaults to 'TN'."),
  );
}
