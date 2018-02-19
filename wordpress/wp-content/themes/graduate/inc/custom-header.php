<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Graduate
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses graduate_header_style()
 */
function graduate_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'graduate_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'e84a4c',
		'width'                  => 1000,
		'height'                 => 300,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'graduate_custom_header_setup' );

if ( ! function_exists( 'graduate_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see graduate_custom_header_setup().
	 */
	function graduate_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
			// Has the text been hidden?
		if ( ! display_header_text() ) :
			$css = ".site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}";
		// If the user has set a custom color for the text use that.
		else :
			$css = ".site-title a,
			.site-description {
				color: #" . esc_attr( $header_text_color ) . "}";
		endif; 

		wp_add_inline_style( 'graduate-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'graduate_header_style', 10 );

if ( ! function_exists( 'graduate_custom_header' ) ) :
	/**
	 * Custom Header Codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_custom_header() {
		
		/**
		 * Filter the default twentysixteen custom header sizes attribute.
		 *
		 * @since Graduate 0.1
		 *
		 */
		$header_image_meta = graduate_header_image_meta_option();

		if ( ( '' == $header_image_meta && ! get_header_image() ) || ! $header_image_meta ) {
			return;
		}

		if ( is_array( $header_image_meta ) ) {
			$header_image = $header_image_meta[0];
		} else {
			$header_image = $header_image_meta;
		}
		?>
		<section id="banner-image" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
			<div class="black-overlay"></div>
			<h2 class="page-title"><?php graduate_title_as_per_template();?></h2>

			<?php
			/**
		     * graduate_add_breadcrumb hook
		     *
		     * @hooked graduate_add_breadcrumb -  10
		     *
		     */
		    do_action( 'graduate_add_breadcrumb' );
		    ?>
		</section><!--#banner-->
		<?php
	}
endif;
add_action( 'graduate_content_start_action', 'graduate_custom_header', 20 );