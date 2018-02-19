<?php
/**
 * Core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Graduate
 * @since Graduate 0.1
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';

if ( ! function_exists( 'graduate_get_theme_options' ) ) :
  /**
   * Merge values from default options array and values from customizer
   *
   * @return array Values returned from customizer
   * @since Graduate 0.1
   */
  function graduate_get_theme_options() {
    $graduate_default_options = graduate_get_default_theme_options();

    return array_merge( $graduate_default_options , get_theme_mod( 'graduate_theme_options', $graduate_default_options ) ) ;
  }
endif;

if ( ! function_exists( 'graduate_slider_image_instruction' ) ) :
  /**
    * Write message for featured image upload
    *
    * @return array Values returned from customizer
    * @since Graduate 0.1
  */
  function graduate_slider_image_instruction( $content, $post_id ) {
    $allowed = array( 'page' );
    if ( in_array( get_post_type( $post_id ), $allowed ) ) {
      return $content .= '<p><b>' . esc_html__( 'Note', 'graduate' ) . ':</b>' . esc_html__( ' The recommended size for image is 1200px by 500px while using it for slider', 'graduate' ) . '</p>';
    } 
    return $content;
  }
endif;
add_filter( 'admin_post_thumbnail_html', 'graduate_slider_image_instruction', 10, 2);

/**
 * Add breadcrumb functions.
 */
require get_template_directory() . '/inc/breadcrumb-class.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Modules additions.
 */
require get_template_directory() . '/inc/modules/modules.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
* WooCommerce Hook.
*/
require get_template_directory() . '/inc/woocommerce.php';

/**
* tp-education Hook.
*/
require get_template_directory() . '/inc/tp-education.php';