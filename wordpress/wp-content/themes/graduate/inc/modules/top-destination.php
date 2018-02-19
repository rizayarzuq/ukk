<?php
/**
 * top_destination section
 *
 * This is the template for the content of top_destination section
 *
 * @package Graduate
 * @since Graduate 0.1
 */
if ( ! function_exists( 'graduate_add_top_destination_section' ) ) :
  /**
   * Add top_destination section
   *
   *@since Graduate 0.1
   */
  function graduate_add_top_destination_section() {

    // Check if top_destination is enabled on frontpage
    $top_destination_enable = apply_filters( 'graduate_section_status', true, 'top_destination_enable' );
    if ( true !== $top_destination_enable ) {
      return false;
    }

    // Get top_destination section details
    $section_details = array();
    $section_details = apply_filters( 'graduate_filter_top_destination_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render top_destination section now.
    graduate_render_top_destination_section( $section_details );
  }
endif;
add_action( 'graduate_primary_content', 'graduate_add_top_destination_section', 50 );


if ( ! function_exists( 'graduate_get_top_destination_section_details' ) ) :
  /**
   * top_destination section details.
   *
   * @since Graduate 0.1
   * @param array $input top_destination section details.
   */
  function graduate_get_top_destination_section_details( $input ) {
    $options = graduate_get_theme_options();

    // top_destination type
    $top_destination_type  = $options['top_destination_content_type'];

    $content = array();
    switch ( $top_destination_type ) {

        case 'category':
            $cat_id = '';
            if ( !empty( $options['top_destination_content_category'] ) ) {
                $cat_id = $options['top_destination_content_category'];
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
                'posts_per_page' => absint( $options['top_destination_count'] ),
            );
        break;

        default:
            $cat_id = '';
            if ( !empty( $options['top_destination_'. $top_destination_type ] ) ) {
                $cat_id = $options['top_destination_'. $top_destination_type ];
            }
            // Bail if no valid pages are selected.
            if ( empty( $cat_id ) ) {
                return $input;
            }else{
                $cat_id = absint( $cat_id );
            }

            $term = get_term_by('id', $cat_id , $top_destination_type );
            $post_type = get_taxonomy( $term->taxonomy )->object_type[0];

            $args = array(
                'post_type'         => $post_type,
                'posts_per_page'    => absint( $options['top_destination_count'] ),
                'tax_query'         => array(
                    array(
                        'taxonomy'  => $top_destination_type,
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
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
            } else {
                $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-200x200.jpg';
            }

            if ( isset( $img_array ) ) {
                $content[$i]['img_array'] = $img_array;
            }

            $content[$i]['url']      = get_permalink( $page_id );
            $content[$i]['title']    = get_the_title( $page_id );
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
// top_destination section content details.
add_filter( 'graduate_filter_top_destination_section_details', 'graduate_get_top_destination_section_details' );


if ( ! function_exists( 'graduate_render_top_destination_section' ) ) :
  /**
   * Start top_destination section
   *
   * @return string top_destination content
   * @since Graduate 0.1
   *
   */
   function graduate_render_top_destination_section( $content_details = array() ) {
        $options  = graduate_get_theme_options();
        $title_visible  = $options['top_destination_display_title'];
        $title          = ! empty( $options['top_destination_title'] ) ? $options['top_destination_title'] : '';
        $content_type   = $options['top_destination_content_type'];
        $category_link  = '#';
        if ( $content_type == 'category' ) {
            $category_link  = get_category_link( $options['top_destination_content_category'] );
            $cat_name       = get_the_category_by_ID( $options['top_destination_content_category'] );
        } elseif ( $content_type != 'category' && $content_type != 'demo' ) {
            $category_link  = get_term_link( $options['top_destination_'. $content_type ], $content_type );
            $term           = get_term_by('id', $options['top_destination_'. $content_type ] , $content_type );
            $cat_name       = $term->name;
        }

        if ( empty( $content_details ) ) {
          return;
        } ?>

        <section id="top-destinations" class="page-section <?php echo ( $title_visible === true ) ? 'two' : 'one'; ?>-columns">
            <div class="container bg-grey">
                <div class="column-wrapper <?php echo ( $title_visible === true ) ? 'first three' : 'six'; ?>-columns">
                    <div class="row">
                        <?php foreach( $content_details as $content_detail ) : ?>
                            <div class="column-wrapper wow fadeIn" data-wow-delay="0.3s" data-wow-duration="0.3s">
                                <div class="image-wrapper">
                                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>">
                                    <div class="black-overlay"></div></a>
                                    <h3 class="places"><a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="color-white"><?php echo esc_html( $content_detail['title'] ); ?></a></h3>
                                </div><!--.image-wrapper-->
                            </div><!--.column-wrapper-->
                        <?php endforeach; ?>
                    </div><!--.row-->
                </div><!--.column-wrapper/three-columns-->
                <?php if( $title_visible === true ) : ?>
                    <div class="column-wrapper last">
                        <div class="destinations-content wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.3s">
                            <?php if( ! empty( $title ) ) : ?>
                                <header class="entry-header">
                                    <h2 class="entry-title color-black"><?php echo esc_html( $title ); ?></h2>
                                </header><!--.entry-header-->
                                <a href="<?php echo esc_url( $category_link ); ?>" class="view-more">
                                        <?php esc_html_e( 'VIEW ALL ', 'graduate' );
                                        echo ! empty( $cat_name ) ? esc_html( $cat_name ) : esc_html__( 'Demo', 'graduate' ); ?>
                                    </a>
                            <?php endif; ?>
                        </div><!--.destinations-content-->
                    </div><!--.column-wrapper-->
                <?php endif; ?>
            </div><!--.container-->
        </section><!--top-destinations/two-columns-->
<?php 
    }
endif;