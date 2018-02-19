<?php
/**
 * Sidebar Position metabox file.
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_sidebar_position_callback' ) ) :
    /**
     * Outputs the content of the sidebar position
     */
    function graduate_sidebar_position_callback( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'graduate_nonce' );
        $stored_sidebar_position = get_post_meta( $post->ID, 'graduate-sidebar-position', true );
        $stored_sidebar          = get_post_meta( $post->ID, 'graduate-sidebar', true );

        $sidebar_positions   = graduate_sidebar_position();
        $sidebar             = graduate_sidebar();
        ?>

        <p>
         <label for="graduate-sidebar-position" class="graduate-row-title"><?php esc_html_e( 'Sidebar Position', 'graduate' )?></label>
         <select name="graduate-sidebar-position" id="graduate-sidebar-position">
          <option value=""><?php esc_html_e( 'Default ( to customizer option )', 'graduate' ); ?></option>

            <?php foreach ( $sidebar_positions as $sidebar_position => $value ) { ?>
             <option value="<?php echo esc_attr( $sidebar_position );?>" <?php if ( isset ( $stored_sidebar_position ) ) selected( $stored_sidebar_position, $sidebar_position ); ?>><?php echo esc_html( $value ); ?></option>
            <?php } ?>
         </select>
        </p>

        <p>
         <label for="graduate-sidebar" class="graduate-row-title"><?php esc_html_e( 'Select Sidebar', 'graduate' )?></label>
         <select name="graduate-sidebar" id="graduate-sidebar">
            <?php foreach ( $sidebar as $sidebar => $value ) { ?>
             <option value="<?php echo esc_attr( $sidebar );?>" <?php if ( isset ( $stored_sidebar ) ) selected( $stored_sidebar, $sidebar ); ?>><?php echo esc_html( $value ); ?></option>
            <?php } ?>
         </select>
        </p>
        <?php
    }
endif;

if ( ! function_exists( 'graduate_meta_save' ) ) :
    /**
     * Saves the sidebar position input
     */
    function graduate_meta_save( $post_id ) {

        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'graduate_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'graduate_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }

        // Checks for input and sanitizes/saves if needed
        if( isset( $_POST[ 'graduate-sidebar-position' ] ) ) {
            update_post_meta( $post_id, 'graduate-sidebar-position', sanitize_text_field( wp_unslash( $_POST[ 'graduate-sidebar-position' ] ) ) );
        }

        if( isset( $_POST[ 'graduate-sidebar' ] ) ) {
            update_post_meta( $post_id, 'graduate-sidebar', sanitize_text_field( wp_unslash( $_POST[ 'graduate-sidebar' ] ) ) );
        }

    }
endif;
add_action( 'save_post', 'graduate_meta_save' );