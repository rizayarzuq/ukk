<?php
/**
 * map_section section
 *
 * This is the template for the content of map_section section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_map_section_section' ) ) :
  /**
   * Add map_section section
   *
   *@since Graduate 0.1
   */
  function graduate_add_map_section_section() {

    // Check if map_section is enabled on frontpage
    $map_section_enable = apply_filters( 'graduate_section_status', true, 'map_section_enable' );
    if ( true !== $map_section_enable ) {
      return false;
    }

    // Render map_section section now.
    graduate_render_map_section_section();
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_map_section_section', 70 );

if ( ! function_exists( 'graduate_render_map_section_section' ) ) :
  /**
   * Start map_section section
   *
   * @return string map_section content
   * @since Graduate 0.1
   *
   */
   function graduate_render_map_section_section() {
        $options                = graduate_get_theme_options();
        $map_section_title      = ! empty( $options['map_section_title'] ) ? $options['map_section_title'] : '';
        $map_section_shortcode  = ! empty( $options['map_section_shortcode'] ) ? $options['map_section_shortcode'] : '';
        ?>

        <section id="map-section">
            <?php if( ! empty( $map_section_title ) ) : ?>
                <header class="entry-header wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.3s">
                    <h2 class="entry-title color-black"><?php echo esc_html( $map_section_title ); ?></h2>
                </header><!--.entry-header-->
            <?php endif; 
            if( ! empty( $map_section_shortcode ) ) : ?>
                <div class="entry-content">
                    <div class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
                        <?php echo do_shortcode( wp_kses_post( $map_section_shortcode ) ); ?>
                    </div>
                </div><!--.entry-content-->
            <?php endif; ?>
        </section><!--#map-section-->
<?php 
    }
endif;