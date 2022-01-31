<?php

/**
 * @file
 * Views Slideshow cycle: Main frame row.
 *
 * - $variables: Contains theme variables.
 * - $classes: Classes.
 * - $rendered_items: Rendered items.
 *
 * @ingroup vss_templates
 */
?>

<?php
$mmoda_event_category = $variables['view']->result[$variables['count']]->field_field_category[0]['raw']['value'];
?>

<div
  id="views_slideshow_cycle_div_<?php print $variables['vss_id']; ?>_<?php print $variables['count']; ?>"
  class="<?php print $classes; ?>" <?php print $aria; ?>>
  <div class="mmoda-event-content category-<?=$mmoda_event_category?>">
  <?php print $rendered_items; ?>
  </div>
</div>
