<?php
/**
 * trending_courses section
 *
 * This is the template for the content of trending_courses section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_trending_courses_section' ) ) :
  /**
   * Add trending_courses section
   *
   *@since Graduate 0.1
   */
  function graduate_add_trending_courses_section() {

    // Check if trending_courses is enabled on frontpage
    $trending_courses_enable = apply_filters( 'graduate_section_status', true, 'trending_courses_enable' );
    if ( true !== $trending_courses_enable ) {
      return false;
    }

    // Get trending_courses section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_trending_courses_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render trending_courses section now.
    graduate_render_trending_courses_section( $section_details );
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_trending_courses_section', 40 );


if ( ! function_exists( 'graduate_get_trending_courses_section_details' ) ) :
  /**
   * trending_courses section details.
   *
   * @since Graduate 0.1
   * @param array $input trending_courses section details.
   */
  function graduate_get_trending_courses_section_details( $input ) {
    $options = graduate_get_theme_options();

    // trending_courses type
    $trending_courses_type  = $options['trending_courses_content_type'];

    $content = array();
    switch ( $trending_courses_type ) {

        case 'category':
            $cat_id = '';
            if ( !empty( $options['trending_courses_content_category'] ) ) {
                $cat_id = $options['trending_courses_content_category'];
            }

            // Bail if no valid pages are selected.
            if ( empty( $cat_id ) ) {
                return $input;
            }else{
                $cat_id = absint( $cat_id );
            }

            $args = array(
                'no_found_rows'  => true,
                'cat'            => $cat_id,
                'post_type'      => 'post',
                'posts_per_page' => absint( $options['trending_courses_count'] ),
            );
        break;

        default:
            $cat_id = '';
            if ( !empty( $options['trending_courses_'. $trending_courses_type ] ) ) {
                $cat_id = $options['trending_courses_'. $trending_courses_type ];
            }
            // Bail if no valid pages are selected.
            if ( empty( $cat_id ) ) {
                return $input;
            }else{
                $cat_id = absint( $cat_id );
            }

            $term = get_term_by('id', $cat_id , $trending_courses_type );
            $post_type = get_taxonomy( $term->taxonomy )->object_type[0];

            $args = array(
                'post_type'         => $post_type,
                'posts_per_page'    => absint( $options['trending_courses_count'] ),
                'tax_query'         => array(
                    array(
                        'taxonomy'  => $trending_courses_type,
                        'field'     => 'id',
                        'terms'     => $cat_id
                    )
                )
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
// trending_courses section content details.
add_filter( 'graduate_filter_trending_courses_section_details', 'graduate_get_trending_courses_section_details' );


if ( ! function_exists( 'graduate_render_trending_courses_section' ) ) :
  /**
   * Start trending_courses section
   *
   * @return string trending_courses content
   * @since Graduate 0.1
   *
   */
   function graduate_render_trending_courses_section( $content_details = array() ) {
        $options  = graduate_get_theme_options();
        $title_visible  = $options['trending_courses_display_title'];
        $title          = ! empty( $options['trending_courses_title'] ) ? $options['trending_courses_title'] : '';
        $content_type   = $options['trending_courses_content_type'];
        $column         = ( $options['trending_courses_column'] == 4 ) ? 'four' : 'three';
        $category_link  = '#'; 
        if ( $content_type == 'category' ) {
            $category_link  = get_category_link( $options['trending_courses_content_category'] );
            $cat_name       = get_the_category_by_ID( $options['trending_courses_content_category'] );
        } elseif ( $content_type != 'category' && $content_type != 'demo' ) {
            $category_link  = get_term_link( $options['trending_courses_'. $content_type ], $content_type );
            $term           = get_term_by('id', $options['trending_courses_'. $content_type ] , $content_type );
            $cat_name       = $term->name;
        }

        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="trending-courses" class="<?php echo esc_attr( $column ); ?>-columns">
            <div class="container">
                <div class="row">
                    <?php if( $title_visible === true ) : ?>
                        <div class="column-wrapper wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.3s">
                            <?php if( ! empty( $title ) ) : ?>
                                <header class="entry-header">
                                    <h2 class="entry-title color-white"><?php echo esc_html( $title ); ?></h2>
                                </header><!--.entry-header-->
                                <a href="<?php echo esc_url( $category_link ); ?>" class="view-more">
                                    <?php esc_html_e( 'VIEW ALL ', 'graduate' );
                                    echo !empty( $cat_name ) ? esc_html( $cat_name ) : esc_html__( 'Demo', 'graduate' ); ?>
                                </a>
                            <?php endif; ?>
                        </div><!--.column-wrapper-->
                    <?php endif; ?>

                    <?php foreach( $content_details as $content_detail ) : ?>
                        <div class="column-wrapper wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.3s">
                            <div class="course-image">
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>"></a>
                            </div>
                            <div class="course-content">
                                <h3><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h3>
                                <p><?php echo esc_html( $content_detail['excerpt'] ); ?></p>
                            </div><!--.course-image-->
                        </div><!--.column-wrapper-->
                    <?php endforeach; ?>
                </div><!--.row-->
            </div><!--.container-->
        </section><!--#trending-courses-->
<?php 
    }
endif;