<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Graduate
 */

/**
 * graduate_content_end_action hook
 *
 * @hooked graduate_content_end -  10
 *
 */
do_action( 'graduate_content_end_action' );

/**
* graduate_footer hook
*
* @hooked graduate_footer_start -  10
* @hooked graduate_footer_widget -  20
* @hooked graduate_footer_site_info -  30
* @hooked graduate_footer_end -  40
*
*/
do_action( 'graduate_footer' );

/**
* graduate_back_to_top hook
*
* @hooked graduate_back_to_top -  10
*
*/
do_action( 'graduate_back_to_top' );

/**
 * graduate_page_end_action hook
 *
 * @hooked graduate_page_end -  10
 *
 */
do_action( 'graduate_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
