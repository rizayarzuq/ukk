<?php
/**
 * graduate custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion Pro
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if( ! function_exists( 'graduate_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Graduate 0.1
	 */
  	function graduate_check_enable_status( $input, $content_enable ){
		 $options = graduate_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'graduate_section_status', 'graduate_check_enable_status', 10, 2 );


if ( ! function_exists( 'graduate_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since Graduate 0.1
	 */
	function graduate_is_sidebar_enable() {
		$options               = graduate_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( ! empty( $post_id ) )
				$post_sidebar_position = get_post_meta( $post_id, 'graduate-sidebar-position', true );
			else
				$post_sidebar_position = '';
		} elseif ( is_archive() || is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_id = get_the_id();
			$post_sidebar_position = get_post_meta( $post_id, 'graduate-sidebar-position', true );
		}

		if ( ( $sidebar_position == 'no-sidebar' && $post_sidebar_position == "" ) || $post_sidebar_position == 'no-sidebar' ) {
			return false;
		} else {
			return true;
		}

	}
endif;


if ( ! function_exists( 'graduate_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function graduate_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = graduate_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'graduate_filter_frontpage_content_enable', 'graduate_is_frontpage_content_enable' );


add_action( 'graduate_simple_breadcrumb', 'graduate_simple_breadcrumb' , 10 );
if ( ! function_exists( 'graduate_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function graduate_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 */
		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


add_action( 'graduate_action_pagination', 'graduate_pagination', 10 );
if ( ! function_exists( 'graduate_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_pagination() {
		$options = graduate_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			endif;
		}
	}

endif;


add_action( 'graduate_action_post_pagination', 'graduate_post_pagination', 10 );
if ( ! function_exists( 'graduate_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_post_pagination() {
		$options = graduate_get_theme_options();
		if ( true === $options['post_pagination_enable'] ) :
			the_post_navigation();
		endif;
	}
endif;

add_action( 'graduate_action_testimonial_pagination', 'graduate_testimonial_pagination', 10 );
if ( ! function_exists( 'graduate_testimonial_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_testimonial_pagination() {
		$options = graduate_get_theme_options();
		if ( true === $options['post_pagination_enable'] ) :
			the_post_navigation( array(
				'prev_text'   => sprintf( '<span class="screen-reader-text"> %s</span>', esc_html__( '%title', 'graduate' ) ),
            	'next_text'   => sprintf( '<span class="screen-reader-text"> %s</span>', esc_html__( '%title', 'graduate' ) ),
				)
				);
		endif;
	}
endif;

if ( ! function_exists( 'graduate_excerpt_length' ) ) :
	/**
	 * long excerpt
	 * 
	 * @since Graduate 0.1
	 * @return  long excerpt value
	 */
	function graduate_excerpt_length( $length ){
		if ( is_admin() ) {
			return $length;
		}

		$options = graduate_get_theme_options();
		$length = $options['long_excerpt_length'];
		return (int) $length;
	}
endif;
add_filter( 'excerpt_length', 'graduate_excerpt_length', 999 );


if ( ! function_exists( 'graduate_excerpt_more' ) ) :
	// read more
	function graduate_excerpt_more( $more ){
		return '...';
	}
endif;
add_filter( 'excerpt_more', 'graduate_excerpt_more' );

if ( ! function_exists( 'graduate_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since Graduate 0.1
	 * @return  no of words to display
	 */
	function graduate_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'graduate_trim_content', $trimmed_content );
	}
endif;

if ( ! function_exists( 'graduate_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_custom_content_width() {

		global $content_width;
		$sidebar_position = graduate_layout();
		switch ( $sidebar_position ) {

		  case 'no-sidebar':
		    $content_width = 1170;
		    break;

		  case 'left-sidebar':
		  case 'right-sidebar':
		    $content_width = 819;
		    break;

		  default:
		    break;
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}

	}
endif;
add_action( 'template_redirect', 'graduate_custom_content_width' );


if ( ! function_exists( 'graduate_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Graduate 0.1
	 *
	 * @return string Theme Palace layout value
	 */
	function graduate_layout() {
		$options = graduate_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'graduate_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'graduate-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'graduate-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;


if ( ! function_exists( 'graduate_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Graduate 0.1
	 */
	function graduate_footer_sidebar_class() {
		$data = array();
		$active_id = array();
		$active_sidebar = array();
	   	$count = 0;

	   	if ( is_active_sidebar( 'graduate-footer-widget-area' ) ) {
	   		$active_id[] 		= '1';
	   		$active_sidebar[] 	= 'graduate-footer-widget-area';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'graduate-footer-widget-area-2' ) ){
	   		$active_id[] 		= '2';
	   		$active_sidebar[] 	= 'graduate-footer-widget-area-2';
	      	$count++;
		}

	   	if ( is_active_sidebar( 'graduate-footer-widget-area-3' ) ){
	   		$active_id[] 		= '3';
	   		$active_sidebar[] 	= 'graduate-footer-widget-area-3';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'graduate-footer-widget-area-4' ) ){
	   		$active_id[] 		= '4';
	   		$active_sidebar[] 	= 'graduate-footer-widget-area-4';
	      	$count++;
	   	}

	   	$class = '';

	   	switch ( $count ) {
        	case '1':
            $class = 'one-column';
            break;
        	case '2':
            $class = 'two-columns';
            break;
        	case '3':
            $class = 'three-columns';
            break;
            case '4':
            $class = 'four-columns';
            break;
	   	}

		$data['active_id'] 		= $active_id;
		$data['active_sidebar'] = $active_sidebar;
		$data['class']     		= $class;

	   	return $data;
	}
endif;


if ( ! function_exists( 'graduate_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since Graduate 0.1
	 *
	 * @return string Header image meta option
	 */
	function graduate_header_image_meta_option() {
		$header_image = get_header_image();
		if ( ! is_front_page() ) :		
			if ( is_archive() || is_404() || is_search() ) {
				if ( ! empty( $header_image ) )
					return $header_image;
				else
					return get_template_directory_uri() . '/assets/uploads/banner-1.jpg';
			} else {
				global $post;
				if( is_object( $post ) )
					$post_id = $post->ID;
				else
					$post_id = '';

				$header_image_meta = get_post_meta( $post_id, 'graduate-header-image', true );

				if ( 'enable' == $header_image_meta && has_post_thumbnail( $post_id ) ) {
					return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				} elseif ( 'default' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner-1.jpg';
				} elseif ( 'disable' == $header_image_meta ) {
					return false;
				} elseif ( 'show-both' == $header_image_meta ) {
					if ( ! empty( $header_image ) )
						$header_img = $header_image;
					else
						$header_img = get_template_directory_uri() . '/assets/uploads/banner-1.jpg';

					$header_image_both_flag = array( $header_img, 'show-both' );
					return $header_image_both_flag;
				} else {
					if ( ! empty( $header_image ) )
						return $header_image;
					else
						return get_template_directory_uri() . '/assets/uploads/banner-1.jpg';
				}
			}
		endif;
	}
endif;


if ( ! function_exists( 'graduate_title_as_per_template' ) ) :
	/**
	 * Return title as per template rendered
	 *
	 * @since Graduate 0.1
	 *
	 * @return string Template title
	 */
	function graduate_title_as_per_template() {
		if ( is_singular() ) {
			the_title();
		} elseif( is_404() ) {
			esc_html_e( '404', 'graduate' );
		} elseif( is_search() ){
			printf( esc_html__( 'Search Result for: %s', 'graduate' ), get_search_query() );
		} elseif ( is_archive() ) {
			if ( class_exists( 'WooCommerce' ) && is_shop() )
				woocommerce_page_title();
			else
				the_archive_title();
		} elseif ( is_home() ) {
			esc_html_e( 'Blogs', 'graduate' );
		}
	}
endif;

if ( ! function_exists( 'graduate_get_author_profile' ) ) :
	/*
	 * Function to get author profile
	 */           
	function graduate_get_author_profile(){
		$options = graduate_get_theme_options();
		if ( true === $options['author_box_enable'] ) : ?>
		    <div id="about-author" class="page-section wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
				<div class="entry-content">
					<div class="author-image">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 );  ?>
					</div><!-- .author-image -->
					<div class="author-content">
						<div class="author-name clear">
							<h6><?php the_author_posts_link(); ?></h6>
							<span class="author"><?php esc_html_e( 'Author', 'graduate' ); ?></span>
						</div><!--.author-name-->
						<div class="clear"></div>
						<?php 
						$author_description = get_the_author_meta( 'description');
						if( ! empty( $author_description ) ) : ?>
							<p><?php echo esc_html( $author_description ); ?></p>
						<?php endif; ?>
					</div><!-- .author-content -->
				</div><!-- .entry-content -->
			</div><!-- #about-author -->
		<?php
		endif;
	}
endif;
add_action( 'graduate_author_profile', 'graduate_get_author_profile' );

if ( ! function_exists( 'graduate_primary_menu_fallback' ) ) :

	/**
	 * Fallback for Primary menu.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_primary_menu_fallback( $args ){

		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'graduate' ) . '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 8,
		) );
		echo '</ul>';

	}
endif;
