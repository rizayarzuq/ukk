<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Graduate 0.1
    */
    function graduate_add_slider_section() {

    // Check if slider is enabled on frontpage
    $slider_enable = apply_filters( 'graduate_section_status', true, 'slider_enable' );
    if ( true !== $slider_enable ) {
      return false;
    }

    // Get slider section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_slider_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render slider section now.
    graduate_render_slider_section( $section_details );
    }
endif;
add_action( 'graduate_primary_content', 'graduate_add_slider_section', 10 );


if ( ! function_exists( 'graduate_get_slider_section_details' ) ) :
  /**
   * Slider section details.
   *
   * @since Graduate 0.1
   * @param array $input Slider section details.
   */
  function graduate_get_slider_section_details( $input ) {
    $options = graduate_get_theme_options();

    // Slider type
    $slider_content_type  = $options['slider_content_type'];

    $content = array();
    switch ( $slider_content_type ) {

        case 'page':
            $ids = array();

            for ( $i = 1; $i <= $options['no_of_slider']; $i++ ) {
                $id = null;
                if ( isset( $options[ 'slider_content_page_'.$i ] ) ) {
                    $id = $options[ 'slider_content_page_'.$i ];
                }
                if ( ! empty( $id ) ) {
                    $ids[] = absint( $id );
                }
            }

            // Bail if no valid pages are selected.
            if ( empty( $ids ) ) {
                return $input;
            }

            $args = array(
                'no_found_rows'  => true,
                'orderby'        => 'post__in',
                'post_type'      => 'page',
                'post__in'       => $ids,
            );
        break;

        default:
        break;
    }

    // Fetch posts.
    $posts = get_posts( $args );

    if ( ! empty( $posts ) ) {
        $i = 1;
        foreach ( $posts as $key => $post ) {

            $page_id = $post->ID;
            $img_array = null;
            if ( has_post_thumbnail( $page_id ) ) {
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            } else {
                $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-1200x500.jpg';
            }

            if ( isset( $img_array ) ) {
                $content[$i]['img_array'] = $img_array;
            }

            $content[$i]['url']      = get_permalink( $page_id );
            $content[$i]['title']    = get_the_title( $page_id );
            $content[$i]['excerpt']  = graduate_trim_content( 6, $post  );
            $content[$i]['alt']      = get_the_title( $page_id );

            $i++;
        }
        wp_reset_postdata();
    }

    if ( ! empty( $content ) ) {
        $input = $content;
    }
    return $input;
}
endif;
// Slider section content details.
add_filter( 'graduate_filter_slider_section_details', 'graduate_get_slider_section_details' );


if ( ! function_exists( 'graduate_render_slider_section' ) ) :
    /**
    * Start slider section
    *
    * @return string Slider content
    * @since Graduate 0.1
    *
    */
    function graduate_render_slider_section( $content_details = array() ) {
        $options          = graduate_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="main-slider" data-effect="linear" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":true, "autoplay": true, "fade": true, "pauseOnHover": true }'>
            <?php 
            $i = 1;
            foreach ( $content_details as $content_detail ) : ?>
                <div class="slider-item <?php echo ( $i == 1 ) ? 'display-block' : 'display-none'; ?>" style="background-image: url('<?php echo esc_url( $content_detail['img_array'][0] ); ?>')">
                    <div class="main-slider-contents wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.3s">
                        <div class="container">
                            <h2 class="title"><a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="color-white"><?php echo esc_html( $content_detail['title'] ); ?></a></h2>  
                            <p class="desc"><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                        </div><!-- end .container -->
                    </div><!-- end .main-slider-contents -->
                </div><!-- end .slider-item -->
            <?php 
            $i++;
            endforeach; ?>
        </section><!-- end #main-slider -->

<?php 
    }
endif;