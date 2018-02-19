<?php
/**
* Customizer validation functions
*
* @package Graduate
* @since Graduate 0.1
*/

if ( ! function_exists( 'graduate_validate_long_excerpt' ) ) :
    /**
     * Check the value for number of excerpt to show
     *
     * @since Graduate 0.1
     * @return string A source value for use
     */
    function graduate_validate_long_excerpt( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'graduate' ) );
        } elseif ( $value < 5 ) {
            $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'graduate' ) );
        } elseif ( $value > 100 ) {
            $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'graduate' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'graduate_validate_no_of_slider' ) ) :
    /**
     * Check the value for number of slider to show
     *
     * @since Graduate 0.1
     * @return string A source value for use
     */
    function graduate_validate_no_of_slider( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'graduate' ) );
        } elseif ( $value < 1 ) {
            $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of slide is 1', 'graduate' ) );
        } elseif ( $value > 5 ) {
            $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of slide is 5', 'graduate' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'graduate_validate_trending_course_count' ) ) :
    /**
     * Check the value for no of content in trending course
     *
     * @since Graduate 0.1
     * @return string A source value for use
     */
    function graduate_validate_trending_course_count( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'graduate' ) );
        } elseif ( $value < 2 ) {
            $validity->add( 'min_no_of_trending_course', esc_html__( 'Minimum no of posts is 2', 'graduate' ) );
        } elseif ( $value > 8 ) {
            $validity->add( 'max_no_of_trending_course', esc_html__( 'Maximum no of posts is 8', 'graduate' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'graduate_validate_top_destination_count' ) ) :
    /**
     * Check the value for no of content in top destination
     *
     * @since Graduate 0.1
     * @return string A source value for use
     */
    function graduate_validate_top_destination_count( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'graduate' ) );
        } elseif ( $value < 6 ) {
            $validity->add( 'min_no_of_top_destination', esc_html__( 'Minimum no of posts is 6', 'graduate' ) );
        } elseif ( $value > 12 ) {
            $validity->add( 'max_no_of_top_destination', esc_html__( 'Maximum no of posts is 12', 'graduate' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'graduate_validate_client_section_count' ) ) :
    /**
     * Check the value for no of content in client section
     *
     * @since Graduate 0.1
     * @return string A source value for use
     */
    function graduate_validate_client_section_count( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'graduate' ) );
        } elseif ( $value < 1 ) {
            $validity->add( 'min_no_of_clients', esc_html__( 'Minimum no of Clients is 1', 'graduate' ) );
        } elseif ( $value > 15 ) {
            $validity->add( 'max_no_of_clients', esc_html__( 'Maximum no of Clients is 15', 'graduate' ) );
        }
        return $validity;
    }
endif;