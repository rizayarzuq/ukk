<?php
/**
 * Header Image metabox file.
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_header_image_callback' ) ) :
    /**
     * Outputs the content of the header image option
     */
    function graduate_header_image_callback( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'graduate_nonce' );
        $stored_header_image_option = get_post_meta( $post->ID, 'graduate-header-image', true );

        $header_image_options       = graduate_header_image_options();
        ?>

        <p>
         <label for="graduate-header-image" class="graduate-row-title"><?php esc_html_e( 'Header Image', 'graduate' )?></label>
         <select name="graduate-header-image" id="graduate-header-image">

            <?php foreach ( $header_image_options as $header_image_option => $value ) { ?>
             <option value="<?php echo esc_attr( $header_image_option );?>" <?php if ( isset ( $stored_header_image_option ) ) selected( $stored_header_image_option, $header_image_option ); ?>><?php echo esc_html( $value ); ?></option>
            <?php } ?>
         </select>
        </p>
        <?php
    }
endif;

if ( ! function_exists( 'graduate_header_image_save' ) ) :
    /**
     * Saves the header option
     */
    function graduate_header_image_save( $post_id ) {

        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'graduate_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'graduate_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }

        // Checks for input and sanitizes/saves if needed
        if( isset( $_POST[ 'graduate-header-image' ] ) ) {
            update_post_meta( $post_id, 'graduate-header-image', sanitize_text_field( wp_unslash( $_POST[ 'graduate-header-image' ] ) ) );
        }

    }
endif;
add_action( 'save_post', 'graduate_header_image_save' );