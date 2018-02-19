<?php
/**
 * The template for displaying search form
 *
 * @package Graduate
 * @since Graduate 0.1
 */

$options = graduate_get_theme_options();
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'graduate' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options['search_text'] ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'graduate' ); ?></span><i class="fa fa-search"></i></button>
</form><!--.search-form-->