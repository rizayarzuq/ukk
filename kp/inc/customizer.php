<?php
/**
 * Theme options in customizer
 *
 * @package compact-one
 */

/**
 * Customizer options
 *
 * @param array $wp_customize Customizer options.
 */
function compact_one_free_customizer_register( $wp_customize ) {

	/**
	 * Class CyberChimps_Customize_Heading
	 *
	 * Creates a form heading to show headings for sub-sections
	 */
	class CyberChimps_Customize_Heading extends WP_Customize_Control {
		/**
		 * Heading for customizer options
		 *
		 * @var type.
		 */
		public $type = 'heading';

		/**
		 * Display content.
		 */
		public function render_content() {
			if ( ! empty( $this->label ) ) : ?>
				<h3 class="total-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
			<?php
			endif;

			if ( $this->description ) {
			?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php
			}
		}
	}

	/* Option list of all post */
	$options_posts = array();
	$options_posts_obj = new WP_Query(
		array(
			'posts_per_page' => 100,
		)
	);
	$options_posts[''] = esc_html( __( 'Choose Post', 'compact-one' ) );
	if ( $options_posts_obj->have_posts() ) {
		while ( $options_posts_obj->have_posts() ) :
			$options_posts_obj->the_post();
			$post_id = get_the_ID();
			$options_posts[ $post_id ] = get_the_title();
		endwhile;
		wp_reset_postdata();
	}

	/* Option list of all categories */
	$args = array(
		'type'         => 'post',
		'orderby'      => 'name',
		'order'        => 'ASC',
		'hide_empty'   => 1,
		'hierarchical' => 1,
		'taxonomy'     => 'category',
	);
	$option_categories = array();
	$category_lists = get_categories( $args );
	$option_categories[''] = esc_html( __( 'Choose Category', 'compact-one' ) );
	foreach ( $category_lists as $category ) {
		$option_categories[ $category->term_id ] = $category->name;
	}

	$option_all_post_cat = array();
    foreach( $category_lists as $category ){
        $option_all_post_cat[$category->term_id] = $category->name;
    }

	 /* Option list of all pages */
	$options_pages = array();
	$options_pages_obj = new WP_Query(
		array(
			'posts_per_page' => 100,
			'post_type' => 'page',
		)
	);
	$options_pages[''] = esc_html( __( 'Choose Page', 'compact-one' ) );
	if ( $options_pages_obj->have_posts() ) {
		while ( $options_pages_obj->have_posts() ) :
			$options_pages_obj->the_post();
			$post_id = get_the_ID();
			$options_pages[ $post_id ] = get_the_title();
		endwhile;
		wp_reset_postdata();
	}

	 $wp_customize->add_panel(
		 'home_page_settings', array(
			 'priority' => 46,
			 'capability' => 'edit_theme_options',
			 'theme_supports' => '',
			 'title' => esc_html( __( 'Home Page Settings', 'compact-one' ) ),
		 )
	 );

	/*============== setup guidelines =====================*/
	 $wp_customize->add_section(
		 'compact_one_homepage_setup_section', array(
			 'priority' => 10,
			 'capability' => 'edit_theme_options',
			 'theme_supports' => '',
			 'title' => esc_html( __( 'Home Page and menu setup guidelines', 'compact-one' ) ),
			 'panel' => 'home_page_settings',
			 'description' => '<p class="customize-control-title">' .__('How To Setup Compact One Theme:','compact-one'). '</p><h3>' .'<a target="_blank" href="https://cyberchimps.com/compact-one-tutorials/">'. __('Watch Step-by-Step Video Tutorials','compact-one'). '</a></h3>',    
		 )
	 );

	// home page setup.
	$wp_customize->add_setting(
		'compact_one_homepage_setup_guide',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_homepage_setup_guide',
				array(
					'settings'      => 'compact_one_homepage_setup_guide',
					'section'       => 'compact_one_homepage_setup_section',
					'label'         => esc_html( __( 'Steps to setup homepage :', 'compact-one' ) ),
					'description' => esc_html( __( 'Please create a page and choose "Home Template" from under "Page Attributes" > "Template" on the right side. These home page settings will apply to this page. To view this page as the front page, please go to "Settings" > "Reading" and choose this page for the setting "A static page" under the "Static Front Page" option. ','compact-one' ) ),
				)
			)
		);

	// menu setup - for home page sections.
	$wp_customize->add_setting(
		'compact_one_homesections_menu_setup_guide',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_homesections_menu_setup_guide',
				array(
					'settings'      => 'compact_one_homesections_menu_setup_guide',
					'section'       => 'compact_one_homepage_setup_section',
					'label'         => esc_html( __( 'Steps to setup menu consisting of home page sections :', 'compact-one' ) ),
					'description' => esc_html( __( 'The "Home Page" has multiple sections. Each section has an ID. The ID for each section is mentioned under its settings. Link to each section can be added from the menu. For example, steps to create menu link for "Features" section are: Go to "Appearance" > "Menus" > "Custom Links"> "URL": Please enter your site URL followed by its ID "#compact_one_features_section"','compact-one' ) ),
				)
			)
		);
	/*============== slider =====================*/
	 $wp_customize->add_section(
		 'compact_one_slider_section', array(
			 'priority' => 10,
			 'capability' => 'edit_theme_options',
			 'theme_supports' => '',
			 'title' => esc_html( __( 'Slider Section', 'compact-one' ) ),
			 'panel' => 'home_page_settings',
		 )
	 );
	// section id.
	$wp_customize->add_setting(
		'compact_one_slider_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_slider_section_id',
				array(
					'settings'      => 'compact_one_slider_section_id',
					'section'       => 'compact_one_slider_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_slider_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_slider_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_slider_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_slider_section',
			'settings' => 'compact_one_enable_slider_section',
			'type' => 'checkbox',
		)
	);

	// choose post category.
	$wp_customize->add_setting(
		'compact_one_slider_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_slider_category',
		array(
			'label' => esc_html( __( 'Select Category', 'compact-one' ) ),
			'section' => 'compact_one_slider_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The featured image from the posts will be displayed for the slider. Recommended image size for the featured images: 1920 x 606px', 'compact-one' ) ),
		)
	);

	// slider gradient option.
	$wp_customize->add_setting(
        'compact_one_slider_gradient',
        array(
            'default'           => 'enable',
            'sanitize_callback' => 'cyberchimps_sanitize_select_post'
        )
    );

    $wp_customize->add_control(
        'compact_one_slider_gradient',
        array(
            'settings'      => 'compact_one_slider_gradient',
            'section'       => 'compact_one_slider_section',
            'type'          => 'radio',
            'label'         => __( 'Gradient overlay for slider image:', 'compact-one' ),
            'description'   => '',
            'choices' => array(
                            'enable' => __('Enable', 'compact-one'),
                            'disable' => __('Disable', 'compact-one'),
                            ),
        )
    );

	// slider caption look.
	$wp_customize->add_setting(
        'compact_one_slider_caption_background',
        array(
            'default'           => 'background-color',
            'sanitize_callback' => 'cyberchimps_sanitize_select_post'
        )
    );

    $wp_customize->add_control(
        'compact_one_slider_caption_background',
        array(
            'settings'      => 'compact_one_slider_caption_background',
            'section'       => 'compact_one_slider_section',
            'type'          => 'radio',
            'label'         => __( 'Slider caption background:', 'compact-one' ),
            'description'   => '',
            'choices' => array(
                            'background-color' => __('Background color', 'compact-one'),
                            'text-border' => __('Text Border', 'compact-one'),
							'none' => __('None', 'compact-one'),
                            ),
        )
    );

	/*============== About =====================*/
	$wp_customize->add_section(
		'compact_one_about_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'About Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_about_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_about_section_id',
				array(
					'settings'      => 'compact_one_about_section_id',
					'section'       => 'compact_one_about_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_about_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_about_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_about_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_about_section',
			'settings' => 'compact_one_enable_about_section',
			'type' => 'checkbox',
		)
	);

	// choose page - section title and description.
	$wp_customize->add_setting(
		'compact_one_about_desc',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_about_desc',
		array(
			'label' => esc_html( __( 'Select Page: ', 'compact-one' ) ),
			'section' => 'compact_one_about_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as section title and page content will be displayed as the description for this section', 'compact-one' ) ),
		)
	);

	// Subsection:skills heading.
	$wp_customize->add_setting(
		'compact_one_about_skills_heading',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_about_skills_heading',
				array(
					'settings'      => 'compact_one_about_skills_heading',
					'section'       => 'compact_one_about_section',
					'label'         => esc_html( __( 'Sub-section: Skills', 'compact-one' ) ),
				)
			)
		);

	// choose post category - for subsection:Skills.
	$wp_customize->add_setting(
		'compact_one_about_skills_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_about_skills_category',
		array(
			'label' => esc_html( __( 'Select Post Category', 'compact-one' ) ),
			'section' => 'compact_one_about_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The category name will be displayed as the sub-section title. The skill heading and percentage value will be fetched from the post title and post content.', 'compact-one' ) ),
		)
	);

	// Subsection:company values heading.
	$wp_customize->add_setting(
		'compact_one_about_co_values_heading',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_about_co_values_heading',
				array(
					'settings'      => 'compact_one_about_co_values_heading',
					'section'       => 'compact_one_about_section',
					'label'         => esc_html( __( 'Sub-section: Company Values', 'compact-one' ) ),
				)
			)
		);

	// choose post category - for subsection:Company Values.
	$wp_customize->add_setting(
		'compact_one_about_co_values_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_about_co_values_category',
		array(
			'label' => esc_html( __( 'Select Post Category', 'compact-one' ) ),
			'section' => 'compact_one_about_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The category name will be displayed as the sub-section title. Post title and post content will be displayed as the heading and description.', 'compact-one' ) ),
		)
	);

	/*============== Features =====================*/
	$wp_customize->add_section(
		'compact_one_features_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'Features Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_features_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_features_section_id',
				array(
					'settings'      => 'compact_one_features_section_id',
					'section'       => 'compact_one_features_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_features_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_features_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_features_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_features_section',
			'settings' => 'compact_one_enable_features_section',
			'type' => 'checkbox',
		)
	);

	// choose page -for section title and image.
	$wp_customize->add_setting(
		'compact_one_feature_title_page',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_feature_title_page',
		array(
			'label' => esc_html( __( 'Select Page: ', 'compact-one' ) ),
			'section' => 'compact_one_features_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as the section title and the featured image will be displayed on the right side. Recommended image size: 395 x 539px', 'compact-one' ) ),
		)
	);

	// choose post category.
	$wp_customize->add_setting(
		'compact_one_features_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_features_category',
		array(
			'label' => esc_html( __( 'Select Category', 'compact-one' ) ),
			'section' => 'compact_one_features_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The featured image, title and content from the posts will be displayed for the features section. Recommended image size for the featured images: 32 x 32px', 'compact-one' ) ),
		)
	);

	/*============== Work =====================*/
	$wp_customize->add_section(
		'compact_one_work_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'Work Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_work_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_work_section_id',
				array(
					'settings'      => 'compact_one_work_section_id',
					'section'       => 'compact_one_work_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_work_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_work_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_work_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_work_section',
			'settings' => 'compact_one_enable_work_section',
			'type' => 'checkbox',
		)
	);

	// choose page -for title.
	$wp_customize->add_setting(
		'compact_one_work_section_title',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_work_section_title',
		array(
			'label' => esc_html( __( 'Select Page:', 'compact-one' ) ),
			'section' => 'compact_one_work_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as the title for this section', 'compact-one' ) ),
		)
	);

	// choose 3 post categories to display the portfolio.
	for ( $i = 1; $i < 4; $i++ ) {
		$wp_customize->add_setting(
			'compact_one_each_work_category_title_' . $i,
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_each_work_category_title_' . $i,
				array(
					'settings'      => 'compact_one_each_work_category_title_' . $i,
					'section'       => 'compact_one_work_section',
					'label'         => esc_html( __( 'Portfolio ', 'compact-one' ) ) . $i,
				)
			)
		);

		// value description.
		$wp_customize->add_setting(
			'compact_one_work_category_' . $i,
			array(
				'default' => '',
				'sanitize_callback' => 'cyberchimps_sanitize_select_post',
			)
		);
		$wp_customize->add_control(
			'compact_one_work_category_' . $i,
			array(
				'label' => esc_html( __( 'Select Post category', 'compact-one' ) ),
				'section' => 'compact_one_work_section',
				'type' => 'select',
				'settings'      => 'compact_one_work_category_' . $i,
				'choices' => $option_categories,
				'description' => esc_html( __( 'The post title, content and featured image will be showcased as the work portfolio. Recommended image size for the featured images: 370 x 348px', 'compact-one' ) ),
			)
		);
	}

	// Sub-section:company profile.
	$wp_customize->add_setting(
		'compact_one_work_profile_heading',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_work_profile_heading',
				array(
					'settings'      => 'compact_one_work_profile_heading',
					'section'       => 'compact_one_work_section',
					'label'         => esc_html( __( 'Sub-section: Company Profile', 'compact-one' ) ),
				)
			)
		);
	// For sub-section: Company profiles - choose post category.
	$wp_customize->add_setting(
		'compact_one_work_profile_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_work_profile_category',
		array(
			'label' => esc_html( __( 'Select Category', 'compact-one' ) ),
			'section' => 'compact_one_work_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The post title, content and featured image will be displayed as the profile title, its value and icon. Please enter a numeric value for the content. Recommended image size for icon: 39 x 39px', 'compact-one' ) ),
		)
	);

	/*============== Team =====================*/
	$wp_customize->add_section(
		'compact_one_team_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'Team Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_team_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_team_section_id',
				array(
					'settings'      => 'compact_one_team_section_id',
					'section'       => 'compact_one_team_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_team_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_team_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_team_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_team_section',
			'settings' => 'compact_one_enable_team_section',
			'type' => 'checkbox',
		)
	);

	// choose page -for section title.
	$wp_customize->add_setting(
		'compact_one_team_title_page',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_team_title_page',
		array(
			'label' => esc_html( __( 'Select Page: ', 'compact-one' ) ),
			'section' => 'compact_one_team_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as the section title.', 'compact-one' ) ),
		)
	);

	// choose post category.
	$wp_customize->add_setting(
		'compact_one_team_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_team_category',
		array(
			'label' => esc_html( __( 'Select Category', 'compact-one' ) ),
			'section' => 'compact_one_team_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The featured image, title and content from the posts will be used to display the team members. Recommended image size for the featured images: 300 x 443px', 'compact-one' ) ),
		)
	);

	/*============== Testimonial =====================*/
	$wp_customize->add_section(
		'compact_one_testimonial_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'Testimonial Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_testimonial_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_testimonial_section_id',
				array(
					'settings'      => 'compact_one_testimonial_section_id',
					'section'       => 'compact_one_testimonial_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_testimonial_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_testimonial_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_testimonial_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_testimonial_section',
			'settings' => 'compact_one_enable_testimonial_section',
			'type' => 'checkbox',
		)
	);

	// choose page -for section title and image.
	$wp_customize->add_setting(
		'compact_one_testimonial_title_page',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_testimonial_title_page',
		array(
			'label' => esc_html( __( 'Select Page: ', 'compact-one' ) ),
			'section' => 'compact_one_testimonial_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as the section title and the featured image will be displayed as the background image. Recommended image size: 1920 x 1280px', 'compact-one' ) ),
		)
	);

	// choose post category.
	$wp_customize->add_setting(
		'compact_one_testimonial_category',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_testimonial_category',
		array(
			'label' => esc_html( __( 'Select Category', 'compact-one' ) ),
			'section' => 'compact_one_testimonial_section',
			'type' => 'select',
			'choices' => $option_categories,
			'description' => esc_html( __( 'The featured image, title and content from the posts will be used to display the client testimonials. Recommended image size for the featured images: 164 x 164px', 'compact-one' ) ),
		)
	);

	/*============== Contact =====================*/
	$wp_customize->add_section(
		'compact_one_contact_section', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html( __( 'Contact Section', 'compact-one' ) ),
			'panel' => 'home_page_settings',
		)
	);
	// section id.
	$wp_customize->add_setting(
		'compact_one_contact_section_id',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_contact_section_id',
				array(
					'settings'      => 'compact_one_contact_section_id',
					'section'       => 'compact_one_contact_section',
					'label'         => esc_html( __( 'Section ID (can be used to setup the menu) : ', 'compact-one' ) ),
					'description' => esc_html( __( '#compact_one_contact_section','compact-one' ) ),
				)
			)
		);
	// enable section.
	$wp_customize->add_setting(
		'compact_one_enable_contact_section', array(
			'sanitize_callback' => 'cyberchimps_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control(
		'compact_one_enable_contact_section', array(
			'label' => esc_html( __( 'Enable Section', 'compact-one' ) ),
			'section' => 'compact_one_contact_section',
			'settings' => 'compact_one_enable_contact_section',
			'type' => 'checkbox',
		)
	);

	// choose page -for section title.
	$wp_customize->add_setting(
		'compact_one_contact_title_page',
		array(
			'default' => '',
			'sanitize_callback' => 'cyberchimps_sanitize_select_post',
		)
	);
	$wp_customize->add_control(
		'compact_one_contact_title_page',
		array(
			'label' => esc_html( __( 'Select Page: ', 'compact-one' ) ),
			'section' => 'compact_one_contact_section',
			'type' => 'select',
			'choices' => $options_pages,
			'description' => esc_html( __( 'The page title will be displayed as the section title.', 'compact-one' ) ),
		)
	);

	// left sub section.
	$wp_customize->add_setting(
		'compact_one_contact_left_section',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_contact_left_section',
				array(
					'settings'      => 'compact_one_contact_left_section',
					'section'       => 'compact_one_contact_section',
					'label'         => esc_html( __( 'Left Subsection: ', 'compact-one' ) ),
				)
			)
		);

	// left subsection details: choose post.
		$wp_customize->add_setting(
			'compact_one_contact_left_details',
			array(
				'default' => '',
				'sanitize_callback' => 'cyberchimps_sanitize_select_post',
			)
		);
		$wp_customize->add_control(
			'compact_one_contact_left_details',
			array(
				'label' => esc_html( __( 'Select Post:', 'compact-one' ) ),
				'section' => 'compact_one_contact_section',
				'type' => 'select',
				'settings'      => 'compact_one_contact_left_details',
				'choices' => $options_posts,
				'description' => esc_html( __( "The post title will be displayed as the sub-section title and post content will be the description. Recommended: Contact Form 7 plugin's shortcode can be added here", 'compact-one' ) ),
			)
		);

	// right sub section.
	$wp_customize->add_setting(
		'compact_one_contact_right_section',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_contact_right_section',
				array(
					'settings'      => 'compact_one_contact_right_section',
					'section'       => 'compact_one_contact_section',
					'label'         => esc_html( __( 'Right Subsection: ', 'compact-one' ) ),
				)
			)
		);

	// right subsection details: choose post.
		$wp_customize->add_setting(
			'compact_one_contact_right_details',
			array(
				'default' => '',
				'sanitize_callback' => 'cyberchimps_sanitize_select_post',
			)
		);
		$wp_customize->add_control(
			'compact_one_contact_right_details',
			array(
				'label' => esc_html( __( 'Select Post:', 'compact-one' ) ),
				'section' => 'compact_one_contact_section',
				'type' => 'select',
				'settings'      => 'compact_one_contact_right_details',
				'choices' => $options_posts,
				'description' => esc_html( __( 'The post title will be displayed as the sub-section title and post content can be the other contact details.', 'compact-one' ) ),
			)
		);

	// bottom sub section.
	$wp_customize->add_setting(
		'compact_one_contact_bottom_section',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

		$wp_customize->add_control(
			new CyberChimps_Customize_Heading(
				$wp_customize,
				'compact_one_contact_bottom_section',
				array(
					'settings'      => 'compact_one_contact_bottom_section',
					'section'       => 'compact_one_contact_section',
					'label'         => esc_html( __( 'Bottom Subsection: ', 'compact-one' ) ),
				)
			)
		);

	// bottom subsection details: choose post.
		$wp_customize->add_setting(
			'compact_one_contact_bottom_details',
			array(
				'default' => '',
				'sanitize_callback' => 'cyberchimps_sanitize_select_post',
			)
		);
		$wp_customize->add_control(
			'compact_one_contact_bottom_details',
			array(
				'label' => esc_html( __( 'Select Post:', 'compact-one' ) ),
				'section' => 'compact_one_contact_section',
				'type' => 'select',
				'settings'      => 'compact_one_contact_bottom_details',
				'choices' => $options_posts,
				'description' => esc_html( __( 'Recommended for post content: Google Maps.', 'compact-one' ) ),
			)
		);

	// footer image.
	$wp_customize->add_setting(
		'compact_one_footer_image', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'compact_one_footer_image', array(
				'label' => esc_html( __( 'Footer image', 'compact-one' ) ),
				'section' => 'cyberchimps_footer_section',
				'settings' => 'compact_one_footer_image',
				'type' => 'image',
			)
		)
	);

	// Exclude categories from blog page
    $wp_customize->add_section(
        'compact_one_blog_page_section',
        array(
            'title' => __( 'Blog Page settings', 'compact-one' ),
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting(
        'compact_one_exclude_post_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'compact_one_sanitize_multiple_checkboxes'
        )
    );

    $wp_customize->add_control(
        new Compact_One_Customize_Control_Checkbox_Multiple(
            $wp_customize,
            'compact_one_exclude_post_cat',
            array(
                'section'       => 'compact_one_blog_page_section',
                'label'         => __( 'Exclude Categories from Blog page', 'compact-one' ),
                'description'   => __( 'Please choose the post categories that should not be displayed on the blog page', 'compact-one' ),
                'choices'       => $option_all_post_cat
            )
        )
    );

	/**
	 * Function to sanitze multiple checkboxes option
	 */
	function compact_one_sanitize_multiple_checkboxes( $values ) {

		$multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

		return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
	}

}
add_action( 'customize_register', 'compact_one_free_customizer_register' );
