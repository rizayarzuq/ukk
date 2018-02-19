<?php
/**
 * about_content section
 *
 * This is the template for the content of about_content section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_about_content_section' ) ) :
  /**
   * Add about_content section
   *
   *@since Graduate 0.1
   */
  function graduate_add_about_content_section() {

    // Check if about_content is enabled on frontpage
    $about_content_enable = apply_filters( 'graduate_section_status', true, 'about_content_enable' );
    if ( true !== $about_content_enable ) {
      return false;
    }

    // Get about_content section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_about_content_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render about_content section now.
    graduate_render_about_content_section( $section_details );
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_about_content_section', 20 );


if ( ! function_exists( 'graduate_get_about_content_section_details' ) ) :
  /**
   * about_content section details.
   *
   * @since Graduate 0.1
   * @param array $input about_content section details.
   */
  function graduate_get_about_content_section_details( $input ) {
    $options = graduate_get_theme_options();

    // about_content type
    $about_content_type  = $options['about_content_type'];

    $content = array();
    switch ( $about_content_type ) {

      case 'page':
        $id = null;
        if ( isset( $options[ 'about_content_page'] ) ) {
            $id = $options[ 'about_content_page'];
        }

        // Bail if no valid pages are selected.
        if ( empty( $id ) ) {
            return $input;
        }

        $args = array(
            'no_found_rows'  => true,
            'orderby'        => 'post__in',
            'post_type'      => 'page',
            'post__in'       => array( absint( $id ) ),
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
              $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'graduate_about_content' );
            } else {
              $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-600x522.jpg';
            }

            if ( isset( $img_array ) ) {
                $content[$i]['img_array'] = $img_array;
            }

            $content[$i]['url']      = get_permalink( $page_id );
            $content[$i]['title']    = get_the_title( $page_id );
            $content[$i]['excerpt']  = graduate_trim_content( 28, $post  );
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
// about_content section content details.
add_filter( 'graduate_filter_about_content_section_details', 'graduate_get_about_content_section_details' );


if ( ! function_exists( 'graduate_render_about_content_section' ) ) :
  /**
   * Start about_content section
   *
   * @return string about_content content
   * @since Graduate 0.1
   *
   */
   function graduate_render_about_content_section( $content_details = array() ) {
        $options  = graduate_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="featured-content" class="two-columns">
            <div class="container">
                <?php foreach ( $content_details as $content_detail ) : ?>
                    <div class="column-wrapper">
                        <div class="featured-image wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
                            <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>"></a>
                        </div><!--.featured-image-->
                    </div><!--.column-wrapper-->

                    <div class="column-wrapper">
                        <div class="featured-text wow fadeInDown" data-wow-delay="0.3s" data-wow-duration="0.3s">
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html( $content_detail['title'] ); ?></h2>
                            </header><!--.entry-header-->
                            <div class="entry-content">
                                <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="view-more"><?php echo esc_html( $options['read_more_text'] ); ?></a>
                            </div><!--.entry-content-->
                        </div><!--.featured-text-->
                    </div><!--.column-wrapper-->
                <?php endforeach; ?>
            </div><!--.container-->
        </section><!--#featured-content-->
<?php 
    }
endif;