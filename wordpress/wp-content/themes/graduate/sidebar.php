<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Graduate
 */
$post_sidebar = get_post_meta( get_the_ID(), 'graduate-sidebar', true );
$post_sidebar = ! empty( $post_sidebar ) ? $post_sidebar : 'sidebar-1';
if ( ! is_active_sidebar( $post_sidebar ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( $post_sidebar ); ?>
</aside><!-- #secondary -->
