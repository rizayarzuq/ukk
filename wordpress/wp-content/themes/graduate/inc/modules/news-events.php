<?php
/**
 * news_events section
 *
 * This is the template for the content of news_events section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_news_events_section' ) ) :
  /**
   * Add news_events section
   *
   *@since Graduate Pro 1.0
   */
  function graduate_add_news_events_section() {

    // Check if news_events is enabled on frontpage
    $news_events_enable = apply_filters( 'graduate_section_status', true, 'news_events_enable' );
    if ( true !== $news_events_enable ) {
      return false;
    }

    // Get news_events section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_news_events_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render news_events section now.
    graduate_render_news_events_section( $section_details );
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_news_events_section', 100 );


if ( ! function_exists( 'graduate_get_news_events_section_details' ) ) :
  /**
   * news_events section details.
   *
   * @since Graduate Pro 1.0
   * @param array $input news_events section details.
   */
  function graduate_get_news_events_section_details( $input ) {
    $options = graduate_get_theme_options();

    // news_events type
    $news_events_type  = $options['news_events_content_type'];

    $content = array();
    switch ( $news_events_type ) {

        case 'recent':
            $args = array(
                'no_found_rows'  => true,
                'post_type'      => 'post',
                'posts_per_page' => absint( $options['news_events_count'] ),
            );
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
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'graduate_trending_courses' );
            } else {
                $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg';
            }

            if ( isset( $img_array ) ) {
                $content[$i]['img_array'] = $img_array;
            }
            $content[$i]['date']     = get_the_date( 'F d, Y', $page_id );
            $content[$i]['date_url'] = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
            $content[$i]['url']      = get_permalink( $page_id );
            $content[$i]['title']    = get_the_title( $page_id );
            $content[$i]['excerpt']  = graduate_trim_content( 12, $post  );
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
// news_events section content details.
add_filter( 'graduate_filter_news_events_section_details', 'graduate_get_news_events_section_details' );


if ( ! function_exists( 'graduate_render_news_events_section' ) ) :
  /**
   * Start news_events section
   *
   * @return string news_events content
   * @since Graduate Pro 1.0
   *
   */
   function graduate_render_news_events_section( $content_details = array() ) {
        $options  = graduate_get_theme_options();
        $title_visible  = $options['news_events_display_title'];
        $title          = ! empty( $options['news_events_title'] ) ? $options['news_events_title'] : '';
        $content_type   = $options['news_events_content_type'];
        $column         = ( $options['news_events_column'] == 4 ) ? 'four' : 'three';

        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="news-section" class="<?php echo esc_attr( $column ); ?>-columns">
            <div class="container">
                <div class="row">

                    <?php if( $title_visible === true ) : ?>
                        <div class="column-wrapper">
                            <?php if( ! empty( $title ) ) : ?>
                                <header class="entry-header wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.3s">
                                    <h2 class="entry-title color-black"><?php echo esc_html( $title ); ?></h2>
                                </header><!--.entry-header-->
                            <?php endif;
                            if( ! empty( $description ) ) : ?>
                                <div class="entry-content no-margin-top">
                                    <p><?php echo esc_html( strip_tags( htmlspecialchars_decode( $description ) ) ); ?></p>
                                </div><!--.entry-content-->
                            <?php endif; ?>
                        </div><!--.column-wrapper-->
                    <?php endif; ?>

                    <?php foreach( $content_details as $content_detail ) : ?>
                        <div class="column-wrapper wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.3s">
                            <div class="news-image">
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>"></a>
                            </div>
                            <div class="news-content">
                                <a href="<?php echo esc_url( $content_detail['date_url'] ); ?>" class="date"><time><?php echo date_i18n( esc_html__( "F d, Y", 'graduate' ), strtotime( $content_detail['date'] ) ); ?></time></a>
                                <h3><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h3>
                                <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                            </div><!--.course-image-->
                        </div><!--.column-wrapper-->
                    <?php endforeach; ?>

                </div><!--.row-->
            </div><!--.container-->
        </section><!--.news-section-->

<?php 
    }
endif;