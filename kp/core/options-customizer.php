<?php
/**
 * Title: Options customizer
 *
 * Description: Defines option fields for theme customizer.
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

add_action( 'customize_register', 'cyberchimps_customize' );
function cyberchimps_customize( $wp_customize ) {

	/**
	 * Class Cyberchimps_Form
	 *
	 * Creates a form input type with the option to add description and placeholders
	 */
	class Cyberchimps_Form extends WP_Customize_Control {

		public function render_content() {
			switch ( $this->type ) {
				case 'textarea':
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<textarea value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> style="width: 97%; height: 200px;"></textarea>
					</label>
					<?php
					break;
			}
		}
	}

	class Cyberchimps_Typography_Size extends WP_Customize_Control {
		public $type = 'select';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $this->choices as $value => $label ) {
						echo '<option value="' . esc_attr( $label ) . 'px"' . selected( $this->value(), $value, false ) . '>' . esc_attr( $label ) . 'px</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}

	class Cyberchimps_Posts_Category extends WP_Customize_Control {
		public $type = 'select';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $this->choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_attr( $label ) . '</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}

	/********** Class for background image option starts *************/
	class Cyberchimps_Background_Image extends WP_Customize_Control {
		public $type = 'radio';

		public function render_content() {
			?>
			<style>
				.images-radio-subcontainer img {
					margin-top: 5px;
					padding: 2px;
					border: 5px solid #eee;
				}

				.images-radio-subcontainer img.of-radio-img-selected {
					border: 5px solid #5DA7F2;
				}

				.images-radio-subcontainer img:hover {
					cursor: pointer;
					border: 5px solid #5DA7F2;
				}
				#accordion-section-cyberchimps_header_section .customize-control-image img{ width: auto;}
				#accordion-section-cyberchimps_social_media .images-skin-subcontainer img{ height: auto;}
			</style>

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<em>
				<small><?php _e( 'make sure you have removed the image above before selecting one of these', 'cyberchimps_core' ); ?></small>
			</em>
			<?php
			foreach ( $this->choices as $value => $label ) :

				//if get theme mod background image has a value then we need to set cyberchimps bg to none
				$test_bg  = $this->value();
				$test_bg  = ( get_theme_mod( 'background_image' ) ) ? 'none' : $test_bg;
				$name     = '_customize-radio-' . $this->id;
				$selected = ( $test_bg == $value ) ? 'of-radio-img-selected' : '';
				?>
				<div class="images-radio-subcontainer">
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" 
																<?php
																$this->link();
																checked( $test_bg, $value );
						?>
						 style="display:none;"/>
						<img src="<?php echo esc_html( $label ); ?>" class="of-radio-img-img <?php echo esc_attr( $selected ); ?>" alt="<?php echo esc_attr( $value ) . '-background-image'; ?>" /><br/>
					</label>
				</div>
				<?php
			endforeach;
		}
	}

	/********** Class for background image option ends *************/

	/********** Class for skin color selection option starts *************/
	class Cyberchimps_skin_selector extends WP_Customize_Control {
		public $type = 'radio';

		public function render_content() {
			?>
			<style>
				.images-skin-subcontainer, .images-radio-subcontainer {
					display: inline-block;
				}

				#customize-control-cyberchimps_background em {
					display: block;
				}

				.images-skin-subcontainer img {
					margin-top: 5px;
					padding: 2px;
					border: 5px solid #eee;
					width: 80px;
				}

				.images-skin-subcontainer img.of-radio-img-selected {
					border: 5px solid #5DA7F2;
				}

				.images-skin-subcontainer img:hover {
					cursor: pointer;
					border: 5px solid #5DA7F2;
				}
				#accordion-section-cyberchimps_header_section .customize-control-image img{ width: auto;}
				#accordion-section-cyberchimps_social_media .images-skin-subcontainer img{ height: auto;}
			</style>

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
			foreach ( $this->choices as $value => $label ) :

				//if get theme mod background image has a value then we need to set cyberchimps bg to none
				$test_skin = $this->value();
				$name      = '_customize-radio-' . $this->id;
				$selected  = ( $test_skin == $value ) ? 'of-radio-img-selected' : '';
				?>
				<div class="images-skin-subcontainer">
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" 
																<?php
																$this->link();
																checked( $test_skin, $value );
						?>
						 style="display:none;"/>
						<img src="<?php echo esc_html( $label ); ?>" class="of-radio-img-img <?php echo esc_attr( $selected ); ?>" alt="<?php echo esc_attr( $value ) . '-skin'; ?>" />
					</label>
				</div>
				<?php
			endforeach;
		}
	}
	?>

			<?php
			/*     * ******** Class for skin color selection option ends ************ */
			$imagepath = get_template_directory_uri() . '/core/lib/images/';

			/* --------------------------------------------------------------
			// HEADER SECTION options in default Site Identity section
			-------------------------------------------------------------- */

			//custom logo url
			$wp_customize->add_setting(
				'custom_logo_url', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'custom_logo_url', array(
					'label' => __( 'Custom Logo URL', 'cyberchimps_core' ),
					'section' => 'title_tagline',
					'settings' => 'custom_logo_url',
					'type' => 'checkbox',
				)
			);

			//custom logo url link
			$wp_customize->add_setting(
				'custom_logo_url_link', array(
					'default' => home_url(),
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				'custom_logo_url_link', array(
					'label' => __( 'Enter Custom Logo URL', 'cyberchimps_core' ),
					'section' => 'title_tagline',
					'settings' => 'custom_logo_url_link',
					'type' => 'text',
				)
			);

			/* --------------------------------------------------------------
			// SOCIAL MEDIA SECTION
			-------------------------------------------------------------- */
			$wp_customize->add_section(
				'cyberchimps_social_media', array(
					'priority' => 40,
					'capability' => 'edit_theme_options',
					'theme_supports' => '',
					'title' => __( 'Social Option', 'cyberchimps_core' ),
				)
			);

			//Select social Icon Style
			$social_choices = apply_filters(
				'cyberchimps_social_icon_options', array(
					'default' => $imagepath . 'social/thumbs/icons-default.png',
					'legacy' => $imagepath . 'social/thumbs/icons-classic.png',
					'round' => $imagepath . 'social/thumbs/icons-round.png',
				)
			);
			if ( count( $social_choices ) > 1 ) {
				$wp_customize->add_setting(
					'theme_backgrounds', array(
						'default' => apply_filters( 'cyberchimps_social_icon_default', 'default' ),
						'sanitize_callback' => 'cyberchimps_text_sanitization',
					)
				);

				$wp_customize->add_control(
					new Cyberchimps_skin_selector(
						$wp_customize, 'theme_backgrounds', array(
							'label' => __( 'Choose your icon style', 'cyberchimps_core' ),
							'section' => 'cyberchimps_social_media',
							'settings' => 'theme_backgrounds',
							'choices' => $social_choices,
						)
					)
				);
			}
			// Add Facebook Setting
			$wp_customize->add_setting(
				'social_facebook', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_facebook', array(
						'label' => __( 'Display Facebook?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_facebook',
						'type' => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'facebook_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'facebook_url', array(
						'label' => __( 'Facebook URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'facebook_url',
					)
				)
			);

			// Add Twitter Setting
			$wp_customize->add_setting(
				'social_twitter', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_twitter', array(
						'label' => __( 'Display Twitter?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_twitter',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'twitter_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'twitter_url', array(
						'label' => __( 'Twitter URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'twitter_url',
					)
				)
			);

			// Add Google+ Setting
			$wp_customize->add_setting(
				'social_google', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_google', array(
						'label' => __( 'Display Google?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_google',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'google_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'google_url', array(
						'label' => __( 'Google+ URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'google_url',
					)
				)
			);

			// Add LinkedIn Setting
			$wp_customize->add_setting(
				'social_linkedin', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_linkedin', array(
						'label' => __( 'Display LinkedIn?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_linkedin',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'linkedin_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'linkedin_url', array(
						'label' => __( 'LinkedIn URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'linkedin_url',
					)
				)
			);

			// Add Youtube Setting
			$wp_customize->add_setting(
				'social_youtube', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_youtube', array(
						'label' => __( 'Display Youtube?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_youtube',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'youtube_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'youtube_url', array(
						'label' => __( 'Youtube URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'youtube_url',
					)
				)
			);

			// Add Flickr Setting
			$wp_customize->add_setting(
				'social_flickr', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_flickr', array(
						'label' => __( 'Display Flickr?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_flickr',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'flickr_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'flickr_url', array(
						'label' => __( 'Flickr URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'flickr_url',
					)
				)
			);

			// Add Pinterest Setting
			$wp_customize->add_setting(
				'social_pinterest', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_pinterest', array(
						'label' => __( 'Display Pinterest?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_pinterest',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'pinterest_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'pinterest_url', array(
						'label' => __( 'Pinterest URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'pinterest_url',
					)
				)
			);

			// Add GoogleMap Setting
			$wp_customize->add_setting(
				'social_googlemaps', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_googlemaps', array(
						'label' => __( 'Display Google Maps?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_googlemaps',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'googlemaps_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'googlemaps_url', array(
						'label' => __( 'Google Maps URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'googlemaps_url',
					)
				)
			);

			// Add Email Setting
			$wp_customize->add_setting(
				'social_email', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_email', array(
						'label' => __( 'Display Email?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_email',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'email_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'email_url', array(
						'label' => __( 'Email Address', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'email_url',
					)
				)
			);

			// Add RSS Setting
			$wp_customize->add_setting(
				'social_rss', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_rss', array(
						'label' => __( 'Display RSS?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_rss',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'rss_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'rss_url', array(
						'label' => __( 'RSS URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'rss_url',
					)
				)
			);

			// Add Instagram Setting
			$wp_customize->add_setting(
				'social_instagram', array(
					'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'social_instagram', array(
						'label' => __( 'Display Instagram?', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'social_instagram',
						'type' => 'checkbox',
					)
				)
			);
			$wp_customize->add_setting(
				'instagram_url', array(
					'sanitize_callback' => 'esc_url_raw',
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize, 'instagram_url', array(
						'label' => __( 'Instagram URL', 'cyberchimps_core' ),
						'section' => 'cyberchimps_social_media',
						'settings' => 'instagram_url',
					)
				)
			);

			/* --------------------------------------------------------------
			// FOOTER SECTION
			-------------------------------------------------------------- */

			$wp_customize->add_section(
				'cyberchimps_footer_section', array(
					'title' => __( 'Footer', 'cyberchimps_core' ),
					'priority' => 60,
				)
			);

			$wp_customize->add_setting(
				'footer_copyright_text', array(
					'default' => '',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);
			$wp_customize->add_control(
				'footer_copyright_text', array(
					'label' => __( 'Footer Copyright Text', 'cyberchimps_core' ),
					'section' => 'cyberchimps_footer_section',
					'settings' => 'footer_copyright_text',
					'type' => 'text',
				)
			);

			/* --------------------------------------------------------------
			// DESIGN SECTION options under default Colors section
			-------------------------------------------------------------- */

			// text color
			$wp_customize->add_setting(
				'text_colorpicker', array(
					'default' => apply_filters( 'cyberchimps_text_color_default', '#000' ),
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'text_colorpicker', array(
						'label' => __( 'Text Color', 'cyberchimps_core' ),
						'section' => 'colors',
						'settings' => 'text_colorpicker',
					)
				)
			);

			// link color
			$wp_customize->add_setting(
				'link_colorpicker', array(
					'default' => apply_filters( 'cyberchimps_link_color_default', '#000' ),
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'link_colorpicker', array(
						'label' => __( 'Link Color', 'cyberchimps_core' ),
						'section' => 'colors',
						'settings' => 'link_colorpicker',
					)
				)
			);

			// link hover color
			$wp_customize->add_setting(
				'link_hover_colorpicker', array(
					'default' => apply_filters( 'cyberchimps_link_hover_color_default', '#000' ),
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'link_hover_colorpicker', array(
						'label' => __( 'Link Hover Color', 'cyberchimps_core' ),
						'section' => 'colors',
						'settings' => 'link_hover_colorpicker',
					)
				)
			);

			/* --------------------------------------------------------------
			// TYPOGRAPHY SECTION
			-------------------------------------------------------------- */
			$wp_customize->add_section(
				'cyberchimps_typography_section', array(
					'title' => __( 'Typography', 'cyberchimps_core' ),
					'priority' => 40,
				)
			);

			// typography sizes
			$wp_customize->add_setting(
				'customize_options[typography_options][size]', array(
					'default' => '14px',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				new Cyberchimps_Typography_Size(
					$wp_customize, 'typography_size', array(
						'label' => __( 'Typography Size', 'cyberchimps_core' ),
						'section' => 'cyberchimps_typography_section',
						'type' => 'select',
						'settings' => 'customize_options[typography_options][size]',
						'choices' => apply_filters( 'cyberchimps_typography_sizes', '' ),
					)
				)
			);

			// typography style
			$wp_customize->add_setting(
				'customize_options[typography_options][style]', array(
					'default' => 'normal',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				'typography_style', array(
					'label' => __( 'Typography Style', 'cyberchimps_core' ),
					'section' => 'cyberchimps_typography_section',
					'type' => 'select',
					'settings' => 'customize_options[typography_options][style]',
					'choices' => apply_filters( 'cyberchimps_typography_styles', '' ),
				)
			);

			// typography face
			/* Default font faces */
			$faces = array(
				'Arial, Helvetica, sans-serif' => 'Arial',
				'Arial Black, Gadget, sans-serif' => 'Arial Black',
				'Comic Sans MS, cursive' => 'Comic Sans MS',
				'Courier New, monospace' => 'Courier New',
				'Georgia, serif' => 'Georgia',
				'"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue",Helvetica, Arial, "Lucida Grande", sans-serif' => 'Helvetica Neue',
				'Impact, Charcoal, sans-serif' => 'Impact',
				'Lucida Console, Monaco, monospace' => 'Lucida Console',
				'Lucida Sans Unicode, Lucida Grande, sans-serif' => 'Lucida Sans Unicode',
				'"Open Sans", sans-serif' => 'Open Sans',
				'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
				'Tahoma, Geneva, sans-serif' => 'Tahoma',
				'Times New Roman, Times, serif' => 'Times New Roman',
				'Trebuchet MS, sans-serif' => 'Trebuchet MS',
				'Verdana, Geneva, sans-serif' => 'Verdana',
				'Symbol' => 'Symbol',
				'Webdings' => 'Webdings',
				'Wingdings, Zapf Dingbats' => 'Wingdings',
				'MS Sans Serif, Geneva, sans-serif' => 'MS Sans Serif',
				'MS Serif, New York, serif' => 'MS Serif',
				'Google Fonts' => 'Google Fonts',
			);
			// Font family for text
			$wp_customize->add_setting(
				'customize_options[typography_options][face]', array(
					'default' => 'Arial Black, Gadget, sans-serif',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				'typography_face', array(
					'label' => __( 'Typography Face', 'cyberchimps_core' ),
					'section' => 'cyberchimps_typography_section',
					'type' => 'select',
					'settings' => 'customize_options[typography_options][face]',
					'choices' => apply_filters( 'cyberchimps_typography_faces', $faces ),
				)
			);

			// Google Font family for text
			$wp_customize->add_setting(
				'customize_options[google_font_field]', array(
					'default' => 'Arial',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				'google_font_field', array(
					'label' => __( 'Enter Google font', 'cyberchimps_core' ),
					'section' => 'cyberchimps_typography_section',
					'type' => 'text',
					'settings' => 'customize_options[google_font_field]',
				)
			);

			// Font family for headings
			$wp_customize->add_setting(
				'customize_options[font_family_headings][face]', array(
					'default' => 'Arial, Helvetica, sans-serif',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				'font_family_headings', array(
					'label' => __( 'Font Family for headings', 'cyberchimps_core' ),
					'section' => 'cyberchimps_typography_section',
					'type' => 'select',
					'settings' => 'customize_options[font_family_headings][face]',
					'choices' => apply_filters( 'cyberchimps_typography_faces', $faces ),
				)
			);

			// Google Font family for headings
			$wp_customize->add_setting(
				'customize_options[google_font_headings]', array(
					'default' => 'Arial',
					'sanitize_callback' => 'cyberchimps_text_sanitization',
				)
			);

			$wp_customize->add_control(
				'google_font_headings', array(
					'label' => __( 'Google font for headings', 'cyberchimps_core' ),
					'section' => 'cyberchimps_typography_section',
					'type' => 'text',
					'settings' => 'customize_options[google_font_headings]',
				)
			);

			// background image
			/*  $wp_customize->add_setting( 'cyberchimps_background', array(
			'default' => 'none',
			'type' => 'theme_mod',
			'sanitize_callback' => 'cyberchimps_file_sanitization'
			) );

			$wp_customize->add_control( new Cyberchimps_Background_Image( $wp_customize, 'cyberchimps_background', array(
			'label' => 'CyberChimps ' . __( 'Background Image', 'cyberchimps_core' ),
			'section' => 'background_image',
			'settings' => 'cyberchimps_background',
			'choices' => apply_filters( 'cyberchimps_background_image', '' ),
			) ) ); */
}

/**
 * Text field sanitization
 *
 * @param $text
 *
 * @return string
 */
function cyberchimps_text_sanitization( $text ) {
	return sanitize_text_field( $text );
}

/**
 * File sanitization
 *
 * @param $text
 *
 * @return string
 */
function cyberchimps_file_sanitization( $name ) {
	return sanitize_file_name( $name );
}