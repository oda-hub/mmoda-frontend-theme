<?php

/*
 * Prefix your custom functions with bootstrap_mmoda. For example:
 * bootstrap_mmoda_form_alter(&$form, &$form_state, $form_id) { ... }
 */

// function bootstrap_mmoda_form_alter(&$form, &$form_state, $form_id)
// {
// switch ($form_id) {
// case 'user_profile_form':
// unset($form['contact']);
// unset($form['mimemail']);
// break;
// }
// }
function bootstrap_mmoda_form_element($variables)
{
  $element = &$variables['element'];

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before'
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && ! empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Add element's #type and #name as class to aid with JS/CSS selectors.
  $attributes['class'] = array(
    'form-item'
  );

  if (! empty($element['#parent_classes'])) {
    $attributes['class'][] = implode(' ', $element['#parent_classes']);
  }

  if (! empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (! empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(
      ' ' => '-',
      '_' => '-',
      '[' => '-',
      ']' => ''
    ));
  }

  // Add a class for disabled elements to facilitate cross-browser styling.
  if (! empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (! isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';
  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
    case 'after':
      $output .= ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;
    case 'none':
    case 'attribute':

      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }
  if (! empty($element['#description'])) {
    $output .= '<div class="description">' . $element['#description'] . "</div>\n";
  }
  $output .= "</div>\n";
  return $output;
}

function bootstrap_mmoda_form_element_label($variables)
{
  $element = $variables['element'];

  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if ((! isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = ! empty($element['#required']) ? theme('form_required_marker', array(
    'element' => $element
  )) : '';
  $title = filter_xss_admin($element['#title']);
  $attributes = array();

  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'] = 'option';
  } elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  $pattern = '/^field_category/';
  if (array_key_exists('#name', $element) and preg_match($pattern, $element['#name']) and isset($element['#return_value'])) {
    $attributes['class'].= ' mmoda-event-category mmoda-event-' . $element['#return_value'];
  }

  if (! empty($element['#label_classes'])) {
    $attributes['class'][] = implode(' ', $element['#label_classes']);
  }

  if (! empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $t('!title !required', array(
    '!title' => $title,
    '!required' => $required
  )) . "</label>\n";
}

function bootstrap_mmoda_preprocess_page(&$variables)
{
  if (isset($variables['node']->type)) {
    // If the content type's machine name is "my_machine_name" the file
    // name will be "page--my-machine-name.tpl.php".
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}

/**
 * Overrides theme_menu_tree() for book module.
 *
 * @param array $variables
 *   An associative array containing:
 *   - tree: An HTML string containing the tree's items.
 *
 * @return string
 *   The constructed HTML.
 */
function bootstrap_mmoda_menu_tree__book_toc(array &$variables) {
  $output = '<div class="book-toc btn-group pull-right">';
  $output .= '  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown">';
  $output .= t('!icon Help outline !caret', array(
    '!icon' => _bootstrap_icon('list'),
    '!caret' => '<span class="caret"></span>',
  ));
  $output .= '</button>';
  $output .= '<ul class="dropdown-menu" role="menu">' . $variables['tree'] . '</ul>';
  $output .= '</div>';
  return $output;
}


/*
function bootstrap_mmoda_button($variables) {
  $element = $variables['element'];
  $type = strtolower($element['#button_type']);
  switch($type){
    case 'submit':
    case 'reset':
    case 'button':
      break;
    default:
      $type = 'submit';
      break;
  }
  $element['#attributes']['type'] = $type;

  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}
*/
