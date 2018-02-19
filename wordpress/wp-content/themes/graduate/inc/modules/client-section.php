<?php
/**
 * client_section section
 *
 * This is the template for the content of client_section section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_client_section_section' ) ) :
  /**
   * Add client_section section
   *
   *@since Graduate 0.1
   */
  function graduate_add_client_section_section() {

    // Check if client_section is enabled on frontpage
    $client_section_enable = apply_filters( 'graduate_section_status', true, 'client_section_enable' );
    if ( true !== $client_section_enable ) {
      return false;
    }

    // Get client_section section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_client_section_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render client_section section now.
    graduate_render_client_section_section( $section_details );
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_client_section_section', 80 );


if ( ! function_exists( 'graduate_get_client_section_section_details' ) ) :
  /**
   * client_section section details.
   *
   * @since Graduate 0.1
   * @param array $input client_section section details.
   */
  function graduate_get_client_section_section_details( $input ) {
    $options = graduate_get_theme_options();

    // client_section type
    $client_section_type  = $options['client_section_content_type'];

    $content = array();
    switch ( $client_section_type ) {

        case 'page':
            $ids = array();

            for ( $i = 1; $i <= $options['client_section_count']; $i++ ) {
                $id = null;
                if ( isset( $options[ 'client_section_page_'.$i ] ) ) {
                    $id = $options[ 'client_section_page_'.$i ];
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

    $i = 1;
      foreach ( $posts as $key => $post ) {
          $page_id = $post->ID;
          $img_array = null;
      if ( has_post_thumbnail( $page_id ) ) {
          $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
      } else {
          $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-200x200.jpg';
      }

      if ( isset( $img_array ) ) {
          $content[$i]['img_array'] = $img_array;
      }

      $content[$i]['url']      = get_permalink( $page_id );
      $content[$i]['alt']      = get_the_title( $page_id );

      $i++;
    }
    wp_reset_postdata();

    if ( ! empty( $content ) ) {
      $input = $content;
    }
    return $input;
  }
endif;
// client_section section content details.
add_filter( 'graduate_filter_client_section_section_details', 'graduate_get_client_section_section_details' );


if ( ! function_exists( 'graduate_render_client_section_section' ) ) :
  /**
   * Start client_section section
   *
   * @return string client_section content
   * @since Graduate 0.1
   *
   */
   function graduate_render_client_section_section( $content_details = array() ) {
        $options        = graduate_get_theme_options();
        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="logo-slider">
            <div class="container wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
                <div class="entry-content regular" data-slick='{"slidesToShow": 6, "slidesToScroll": 1, "infinite": false, "speed": 800,  "draggable": true, "dots": true, "arrows": false, "autoplay": true, "fade": false }'>
                    <?php $i = 1;
                    foreach( $content_details as $content_detail ) : ?>
                        <div class="logo-slider-item <?php echo ( $i == 1 ) ? 'display-block' : 'display-none'; ?>">
                            <a href="<?php echo esc_url( $content_detail['url'] ); ?>" title="<?php echo esc_attr( $content_detail['alt'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>"></a>
                        </div><!--.slider-item-->
                    <?php $i++;
                    endforeach; ?>
                </div><!--.entry-content-->
            </div><!--.container-->
        </section><!--#logo-slider-->
<?php 
    }
endif;