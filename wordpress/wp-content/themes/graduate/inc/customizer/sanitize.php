<?php
/**
 * Customizer sanitization functions
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_sanitize_select' ) ) :
	/**
	 * Sanitize select, radio.
	 *
	 * @since Graduate 0.1
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function graduate_sanitize_select( $input, $setting ) {
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

if ( ! function_exists( 'graduate_sanitize_number_range' ) ) :
	/**
	 * Number Range sanitization callback example.
	 *
	 * - Sanitization: number_range
	 * - Control: number, tel
	 *
	 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
	 * `$number` as an absolute integer within a defined min-max range.
	 *
	 * @see absint() https://developer.wordpress.org/reference/functions/absint/
	 *
	 * @param int                  $number  Number to check within the numeric range defined by the setting.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
	 *                    the setting default.
	 */
	function graduate_sanitize_number_range( $number, $setting ) {
		// Ensure input is an absolute integer.
		$number = absint( $number );

		// Get the input attributes associated with the setting.
		$atts = $setting->manager->get_control( $setting->id )->input_attrs;

		// Get minimum number in the range.
		$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

		// Get maximum number in the range.
		$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

		// Get step.
		$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

		// If the number is within the valid range, return it; otherwise, return the default
		return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
	}
endif;

if ( ! function_exists( 'graduate_sanitize_page' ) ) :
	/**
	* Sanitizes page/post
	* @param  $input entered value
	* @return sanitized output
	*
	* @since Graduate 0.1
	*/
	function graduate_sanitize_page( $input ) {

		// Ensure $input is an absolute integer.
		$page_id = absint( $input );

		// If $page_id is an ID of a published page, return it; otherwise, return false
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	}
endif;

if ( ! function_exists( 'graduate_sanitize_checkbox' ) ) :
	/**
	 * Sanitize checkbox.
	 *
	 * @since Graduate 0.1
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function graduate_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true == $checked ) ? true : false );

	}
endif;

if ( ! function_exists( 'graduate_santize_allow_tag' ) ) :
	/**
	 * Text field with allowed tag anchor sanitization callback example.
	 *
	 * @see absint() https://developer.wordpress.org/reference/functions/absint/
	 *
	 * @param string  $input  
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string The input with only allowed tag i.e. anchor
	 */
	function graduate_santize_allow_tag( $input ) {
		$input = wp_kses( $input, array(
			'br' => array(),
			'a' => array(
				'target' => array(),
				'href' => array(),
				)
			) );

		return $input;
	}
endif;