<?php
/**
 * Custom functions template
 *
 * @package compact-one
 */

/**
 * Modify footer
 */
function compact_one_custom_functions() {
	remove_action( 'cyberchimps_footer', 'cyberchimps_footer_credit' );
	add_action( 'cyberchimps_footer', 'compact_one_footer_credit' );
}
add_action( 'init', 'compact_one_custom_functions' );

/*================= Fonts =====================*/

/**
 * List for sizes
 *
 * @param array $sizes Typography sizes.
 */
function compact_one_typography_sizes( $sizes ) {
	$sizes = array( '8', '9', '10', '12', '14', '15', '16', '18', '20' );
	return $sizes;
}
add_filter( 'cyberchimps_typography_sizes', 'compact_one_typography_sizes' );

/**
 * List for styles
 *
 * @param array $styles Typography styles.
 */
function compact_one_typography_styles( $styles ) {
	$styles = array(
		'normal' => esc_html( 'Normal', 'compact-one' ),
		'bold' => esc_html( 'Bold', 'compact-one' ),
	);
	return $styles;
}
add_filter( 'cyberchimps_typography_styles', 'compact_one_typography_styles' );

/**
 * Adding raleway font to main list
 *
 * @param array $orig Typography faces.
 */
function compact_one_typography_faces( $orig ) {

	$new = array(
		'"Roboto", sans-serif' => 'Roboto',
	);

	$new = array_merge( $new, $orig );

	return $new;
}
add_filter( 'cyberchimps_typography_faces', 'compact_one_typography_faces' );

/**
 * Setting defaults - body
 */
function compact_one_typography_defaults() {
	$default = array(
		'size' => '16px',
		'face' => '"Roboto", sans-serif',
		'style' => 'normal',
		'color' => '',
	);

	return $default;
}
add_filter( 'cyberchimps_typography_defaults', 'compact_one_typography_defaults' );

/**
 * Setting defaults - menu
 */
function compact_one_menu_typography_style() {
	$default = array(
		'face' => '"Roboto", sans-serif',
	);
	return $default;
}
add_filter( 'cyberchimps_typography_menu_defaults', 'compact_one_menu_typography_style' );

/**
 * Footer area modified
 */
function compact_one_footer_credit() {
?>
	<footer class="container-full-width" id="after_footer">
		<div class="compact_one_footer_icons">
			<?php cyberchimps_header_social_icons(); ?>
		</div><!-- end of .compact_one_footer_icons -->

		<div class="compact_one_footer_copyright">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<!-- logo -->
						<?php $compact_one_footer_image = get_theme_mod( 'compact_one_footer_image' ); ?>
						<?php if ( ! empty( $compact_one_footer_image ) ) { ?>
							<img class="compact_one_footer_image" src="<?php echo esc_attr( $compact_one_footer_image ); ?>" alt="<?php esc_attr_e( 'footer image','compact-one' ); ?>" />
						<?php } ?>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<!--cyberchimps link -->
						<div id="credit">					
							<a href="<?php echo esc_url( __( 'http://cyberchimps.com/','cyberchimps_core' ) ); ?>" target="_blank" title="<?php echo esc_attr_e( 'CyberChimps Themes','compact-one' ); ?>" rel="noindex, nofollow">									
								<h4 class="cc-credit-text"><?php esc_html_e( 'CyberChimps WordPress Themes', 'cyberchimps_core' ); ?></h4>
								<span class="screen-reader-text"><?php esc_html_e( 'Theme home page (will open in a new window)', 'cyberchimps_core' ); ?></span>
							</a>								
						</div><!-- end of .credit -->
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">				
						<!-- copyright text -->
						<?php $copyright = ( get_theme_mod( 'footer_copyright_text' ) ) ? get_theme_mod( 'footer_copyright_text' ) : '&copy; ' . date( 'Y' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>'; ?>
						<div id="copyright">
							<?php echo wp_kses_post( $copyright ); ?>
						</div>
					</div>

				</div><!-- end of .row -->
			</div><!-- end of .container -->
		</div><!-- end of .compact_one_footer_copyright -->

	</footer><!-- end of #after_footer -->
		
	<div id="scroll-to-top"><span class="glyphicon glyphicon-chevron-up"></span></div>	
<?php
}

/**
 * Theme options compatibility
 */
function compact_one_theme_options_compatibility() {
	// link, text, heading colors.
	$text_colorpicker = get_theme_mod( 'text_colorpicker' );
	$link_colorpicker = get_theme_mod( 'link_colorpicker' );
	$link_hover_colorpicker = get_theme_mod( 'link_hover_colorpicker' );

?>
	<style type="text/css">
		
		/* text color */
		body, #compact_one_about_section .progress-title, #compact_one_testimonial_section .testimonial_abt, .text-muted
		{
			color:<?php echo esc_attr( $text_colorpicker ); ?>;
		}		
		/* link color */
		a, #compact_one_work_section .tw_portfolio_hover_layer a, #compact_one_team_section .team_member_details .tw_showcase_designation
		{
			color:<?php echo esc_attr( $link_colorpicker ); ?>;
		}
		/* link hover color */
		a:hover, #compact_one_work_section .tw_portfolio_hover_layer a:hover, #compact_one_team_section .team_member_details .tw_showcase_designation:hover
		{
			color:<?php echo esc_attr( $link_hover_colorpicker ); ?>;
		} 
	</style>
<?php
}
add_action( 'wp_head', 'compact_one_theme_options_compatibility' );

/**
 * Excerpt length for slider, features, work, team section
 *
 * @param array $length Excerpt length.
 */
function compact_one_sections_excerpt_length( $length ) {
	return 10;
}

/**
 * Replaces "[...]" with ... *
 */
function compact_one_excerpt_more() {
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'compact_one_excerpt_more' );

/**
 * Replaces "[...]" with Read More
 */
function compact_one_excerpt_read_more( $excerpt ){
    $post = get_post();
    $excerpt .= '<a class="excerpt-more" href="'. get_permalink($post->ID) . '">' . esc_html('Read More', 'compact-one') . '</a>';
    return $excerpt;
}


/**
 * Add upgrade button to the free theme customizer.
 */
function compact_one_add_upgrade_button() {

	// Get the upgrade link.
	$upgrade_link = esc_url_raw( 'https://cyberchimps.com/store/compact-one-pro-plugin/' );
	?>
	<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			jQuery( '#customize-info .accordion-section-title' ).append( '<a target="_blank" class="button btn-upgrade" href="<?php echo esc_url( $upgrade_link ); ?>"><?php esc_html_e( 'Upgrade To Pro', 'compact-one' ); ?></a>' );
			jQuery( '#customize-info .btn-upgrade' ).click( function( event ) {
				event.stopPropagation();
			} );
		} );
	</script>
	<style>
		.wp-core-ui .btn-upgrade {
			color: #fff;
			background: none repeat scroll 0 0 #5BC0DE;
			border-color: #CCCCCC;
			box-shadow: 0 1px 0 #5BC0DE inset, 0 1px 0 rgba(0, 0, 0, 0.08);
			float: right;
			margin-top: -23px;
		}
		.wp-core-ui .btn-upgrade:hover {
			color: #fff;
			background: none repeat scroll 0 0 #39B3D7;
			box-shadow: 0 1px 0 #39B3D7 inset, 0 1px 0 rgba(0, 0, 0, 0.08);
		}
		.wp-core-ui #customize-info .theme-name{
					word-break: break-all;
					padding-right: 120px;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'compact_one_add_upgrade_button' );

/**
 * Function to add rating link
 */
function compact_one_admin_notice() {

	$admin_check_screen = get_admin_page_title();

	if ( 'Manage Themes' == $admin_check_screen || 'Theme Options Page' == $admin_check_screen ) {
	?>
		<div class="notice notice-success is-dismissible">
				<b><p><?php echo esc_html( 'Liked this theme? ', 'compact-one' ); ?><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/compact-one/reviews/#new-post' ); ?>" target='_blank' ><?php echo esc_html( 'Share your rating. ', 'compact-one' ); ?></a><?php echo esc_html( 'Thank you!', 'compact-one' ); ?></p></b>
		</div>
		<?php
	}

}
add_action( 'admin_notices', 'compact_one_admin_notice' );

/**
 * Prints HTML for author link of the post.
 */
function compact_one_posted_by() {

					// Get url of all author archive( the page will contain all posts by the author).
		$auther_posts_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );

		// Set author title text which will appear on hover over the author link.
		/* translators: %s: Author name */
		$auther_link_title = esc_attr( sprintf( __( 'View all posts by %s', 'cyberchimps_core' ), get_the_author() ) );

		// Set the HTML for author link.
		$posted_by = sprintf(
			/* translators: %s: Author details */
			'<li><span class="byline"> %s ',
			'<span class="author vcard">
								<a class="url fn n" href="' . $auther_posts_url . '" title="' . $auther_link_title . '" rel="author">' . esc_html( get_the_author() ) . '</a>
							</span>
						</span></li>'
		);

		// If post byline author toggle is on then print HTML for author link.
		echo "<li class='author_img'>" . get_avatar( get_the_author_meta( 'ID' ), 48 ) . '</li>';
		echo apply_filters( 'cyberchimps_posted_by', $posted_by );
}

/**
 * Prints HTML for post date.
 */
function compact_one_posted_on() {

		// Get all data related to date.
		$date_url   = esc_url( get_permalink() );
		$date_title = esc_attr( get_the_time() );
		$date_time  = esc_attr( get_the_time() );
		$date_time  = esc_attr( get_the_date( 'c' ) );
		$date       = esc_html( get_the_date() );

		// Set the HTML for date link.
		$posted_on = sprintf(
			/* translators: %s: Date */
			__( '<li><i class="fa fa-calendar" aria-hidden="true"></i> Posted on %s', 'cyberchimps_core' ),
			'<a href="' . $date_url . '" title="' . $date_title . '" rel="bookmark">
							<time class="entry-date updated" datetime="' . $date_time . '">' . $date . '</time>
						</a></li>'
		);

		// If post byline date toggle is on then print HTML for date link.
		echo apply_filters( 'cyberchimps_posted_on', $posted_on );
}

/**
 * Prints HTML for post categories.
 */
function compact_one_posted_in() {
		global $post;

		$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) :
		/* translators: %s: Categories list */
		$cats = sprintf( __( 'Posted in %s', 'cyberchimps_core' ), $categories_list );
		?>
		<li><span class="cat-links">
		<?php echo apply_filters( 'cyberchimps_post_categories', $cats ); ?>
		</span>
		</li>
		<?php
		endif;
}

/**
 * Prints HTML for post comments.
 */
function compact_one_post_comments() {
		global $post;

		$leave_comment = ( is_single() || is_page() ) ? '' : __( 'Leave a comment', 'cyberchimps_core' );
	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
		?>
		<li><span class="comments-link"><?php comments_popup_link( $leave_comment, __( '<i class="fa fa-comment" aria-hidden="true"></i> 1 Comment', 'cyberchimps_core' ), '<i class="fa fa-comment" aria-hidden="true"></i> % ' . __( 'Comments', 'cyberchimps_core' ) ); ?></span></li>
		<?php
		endif;
}

/**
 * For Author Bio on Single Posts Page
 */
function compact_one_posts_author_bio() {
	global $post;
	$user_description = get_the_author_meta( 'user_description', $post->post_author );
	?>
			<div class="row">
			<div class="cyberchimps_author_bio col-md-12">
				<div class="author_bio_wrapper">
				<div class="avatar_author  col-md-2">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?> 
				</div>
				<div class="author_bio col-md-10">
					<?php
					// Get url of all author archive( the page will contain all posts by the author).
					$auther_posts_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );

					/* translators: %s: Author name */
					$auther_link_title = esc_attr( sprintf( __( 'View all posts by %s', 'cyberchimps_core' ), get_the_author() ) );

					echo '<div class="author vcard author_bio_name">
			<a class="url fn n" href="' . $auther_posts_url . '" title="' . $auther_link_title . '" rel="author">' . esc_html( get_the_author() ) . '</a>
		</div>';
					the_author_meta( 'user_description' );
					?>
				</div>
				</div>
			</div>
			</div>
<?php
}

/** 
 * Exclude post categories from the Category widget
*/ 
function compact_one_custom_category_widget( $arg ) {
	$cat = get_theme_mod( 'compact_one_exclude_post_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["exclude"] = $cat;
    }
	return $arg;
}
add_filter( "widget_categories_args", "compact_one_custom_category_widget" );
add_filter( "widget_categories_dropdown_args", "compact_one_custom_category_widget" );

/**
 * Exclude post categories from the Recent Post widget
 * 
 * @link http://blog.grokdd.com/exclude-recent-posts-by-category/
*/
function compact_one_exclude_post_cat_recentpost_widget(){
    $s = '';
    $i = 1;
    $cat = get_theme_mod( 'compact_one_exclude_post_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        foreach( $cat as $c ){
            $i++;
            $s .= '-'.$c;
            if( count($cat) >= $i )
            $s .= ', ';
        }
    }
    
    $exclude = array( 'cat' => $s );
    
    return $exclude;   
}
add_filter( "widget_posts_args", "compact_one_exclude_post_cat_recentpost_widget" );
