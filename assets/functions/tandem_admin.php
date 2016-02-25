<?php
// This file handles the Tandem admin area and functions.

/************* ACF FIELD MODIFICATIONS *****************/

 /*
  * Source: http://support.advancedcustomfields.com/forums/topic/customise-color-picker-swatches/
  */

// Adds client custom colors to WYSIWYG editor and ACF color picker.
$client_colors = array(
    "fde1c7", // Salmon I (webguide)
    "fffbdb", // Yellow I (webguide)
    "dceff0", // Blue I (webguide)
    "e07856", // Salmon IV
    "F0C063", // Yellow II
    "0f9fd6" // Blue III
);

global $client_colors;
array_push($client_colors, "FFFFFF", "000000");

function change_acf_color_picker() {

  global $parent_file;
  global $client_colors;
  $client_colors_acf = array();

  foreach ( $client_colors as $value ) {
    $client_colors_acf[] = '#'.$value;
  }

  $client_colors_acf_jquery = json_encode($client_colors_acf);

  echo "<script>
  (function($){
    acf.add_action('ready append', function() {
      acf.get_fields({ type : 'color_picker'}).each(function() {
        $(this).iris({
          color: $(this).find('.wp-color-picker').val(),
          mode: 'hsv',
          palettes: ".$client_colors_acf_jquery.",
          change: function(event, ui) {
            $(this).find('.wp-color-result').css('background-color', ui.color.toString());
            $(this).find('.wp-color-picker').val(ui.color.toString());
          }
        });
      });
    });
  })(jQuery);
</script>";
}

add_action( 'acf/input/admin_head', 'change_acf_color_picker' );
