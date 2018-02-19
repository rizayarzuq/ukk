<?php
/**
 * graduate options
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_enable_disable_options' ) ) :
    /**
     * Section Enable Disable
     * @return array Enable Disable options
     */
    function graduate_enable_disable_options() {
      $graduate_enable_disable_options = array(
        'static-frontpage'  => esc_html__( 'Static Frontpage', 'graduate' ),
        'disabled'          => esc_html__( 'Disabled', 'graduate' ),
      );

      $output = apply_filters( 'graduate_enable_disable_options', $graduate_enable_disable_options );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_top_bar_enable_options' ) ) :
    /**
     * Section Enable Disable
     * @return array Enable Disable options
     */
    function graduate_top_bar_enable_options() {
      $graduate_top_bar_enable_options = array(
        'enabled'     => esc_html__( 'Enabled', 'graduate' ),
        'disabled'    => esc_html__( 'Disabled', 'graduate' ),
      );

      $output = apply_filters( 'graduate_top_bar_enable_options', $graduate_top_bar_enable_options );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function graduate_site_layout() {
      $graduate_site_layout = array(
        'wide'  => esc_html__( 'Wide', 'graduate' ),
      );

      $output = apply_filters( 'graduate_site_layout', $graduate_site_layout );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function graduate_sidebar_position() {
      $graduate_sidebar_position = array(
        'right-sidebar' => esc_html__( 'Right', 'graduate' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'graduate' ),
      );

      $output = apply_filters( 'graduate_sidebar_position', $graduate_sidebar_position );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_sidebar' ) ) :
    /**
     * Sidebar
     * @return array Sidebar
     */
    function graduate_sidebar() {
      $graduate_sidebar = array(
        'sidebar-1'                   => esc_html__( 'Primary Sidebar', 'graduate' ),
        'graduate-optional-sidebar'   => esc_html__( 'Optional Sidebar 1', 'graduate' ),
      );

      $output = apply_filters( 'graduate_sidebar', $graduate_sidebar );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_header_image_options' ) ) :
    /**
     * Header image options
     * @return array Header image options
     */
    function graduate_header_image_options() {
      $graduate_header_image_options = array(
        'show-both' => esc_html__( 'Show Both( Featured and Header Image )', 'graduate' ),
        'enable'    => esc_html__( 'Enable( Featured Image )', 'graduate' ),
        'default'   => esc_html__( 'Default ( Customizer Header Image )', 'graduate' ),
        'disable'   => esc_html__( 'Disable', 'graduate' ),
      );

      $output = apply_filters( 'graduate_header_image_options', $graduate_header_image_options );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function graduate_pagination_options() {
        $graduate_pagination_options = array(
            'default'  => esc_html__( 'Default(Older/Newer)', 'graduate' ),
        );

      $output = apply_filters( 'graduate_pagination_options', $graduate_pagination_options );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_common_content_type' ) ) :
    /**
     * Common content types
     * @return array Content types
     */
    function graduate_common_content_type() {
      $graduate_content_type = array(
        'page'      => esc_html__( 'Page', 'graduate' ),
      ); 

      $output = apply_filters( 'graduate_common_content_type', $graduate_content_type );

      // Sort array in ascending order, according to the key:
      if ( ! empty( $output ) ) {
        ksort( $output );
      }

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_about_content_type' ) ) :
    /**
     * About content types
     * @return array Content types
     */
    function graduate_about_content_type() {
      $graduate_content_type = array(
        'page'      => esc_html__( 'Page', 'graduate' ),
      ); 

      $output = apply_filters( 'graduate_about_content_type', $graduate_content_type );

      // Sort array in ascending order, according to the key:
      if ( ! empty( $output ) ) {
        ksort( $output );
      }

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_trending_course_column' ) ) :
    /**
     * About content types
     * @return array Content types
     */
    function graduate_trending_course_column() {
      $graduate_trending_course_column = array(
        '3'     => esc_html__( 'Three Columns', 'graduate' ),
        '4'     => esc_html__( 'Four Columns', 'graduate' ),
      ); 

      $output = apply_filters( 'graduate_trending_course_column', $graduate_trending_course_column );

      // Sort array in ascending order, according to the key:
      if ( ! empty( $output ) ) {
        ksort( $output );
      }

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_trending_taxonomy_content_type' ) ) :
    /**
     * Category and Taxonomy content types
     * @return array Content types
     */
    function graduate_trending_taxonomy_content_type() {
      $graduate_trending_taxonomy_content_type = array(
        'category'  => esc_html__( 'Category', 'graduate' ),
      ); 

      $taxonomies = get_taxonomies( array( '_builtin' => false ) , 'objects' );
      if ( count( $taxonomies ) > 0 ) {
        foreach ( $taxonomies as $taxonomy ) :
          $graduate_trending_taxonomy_content_type = array_merge( $graduate_trending_taxonomy_content_type, array( $taxonomy->name => $taxonomy->labels->name ) );
        endforeach;
      }

      $output = apply_filters( 'graduate_trending_taxonomy_content_type', $graduate_trending_taxonomy_content_type );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_news_taxonomy_content_type' ) ) :
    /**
     * Recent content types
     * @return array Content types
     */
    function graduate_news_taxonomy_content_type() {
      $graduate_news_taxonomy_content_type = array(
        'recent'  => esc_html__( 'Recent', 'graduate' ),
      ); 

      $output = apply_filters( 'graduate_news_taxonomy_content_type', $graduate_news_taxonomy_content_type );

      return $output;
    }
endif;

if ( ! function_exists( 'graduate_client_content_type' ) ) :
    /**
     * Client Section content types
     * @return array Content types
     */
    function graduate_client_content_type() {
      $graduate_content_type = array(
        'page'      => esc_html__( 'Page', 'graduate' ),
      ); 

      $output = apply_filters( 'graduate_client_content_type', $graduate_content_type );

      // Sort array in ascending order, according to the key:
      if ( ! empty( $output ) ) {
        ksort( $output );
      }

      return $output;
    }
endif;