<?php
/**
 * Sidebar Settings
 *
 * @package JobScout_Pro
 */
 
function jobscout_pro_customize_register_sidebar( $wp_customize ) {
    
    $wp_customize->add_section( 'sidebar_settings', array(
        'title'       => __( 'Sidebar Settings', 'jobscout-pro' ),
        'priority'    => 50,
        'panel'       => 'general_settings',
        'description' => __( 'Add custom sidebars. You need to save the changes and reload the customizer to use the sidebars in the dropdowns below.
You can add content to the sidebars in Appearance->Widgets.', 'jobscout-pro' ),
    ) );
    
    /** Custom Sidebars */
    $wp_customize->add_setting( 
        new JobScout_Pro_Repeater_Setting( 
            $wp_customize, 
            'sidebar', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'JobScout_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Control_Repeater(
			$wp_customize,
			'sidebar',
			array(
				'section' => 'sidebar_settings',				
				'label'	  => __( 'Add Sidebars', 'jobscout-pro' ),
                'fields'  => array(
                    'name' => array(
                        'type'         => 'text',
                        'label'        => __( 'Name', 'jobscout-pro' ),
                        'description'  => __( 'Example: Homepage Sidebar', 'jobscout-pro' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'sidebar', 'jobscout-pro' ),
                    'field' => 'name'
                )                                              
			)
		)
	);
    
    /** Blog Page */
    $wp_customize->add_setting(
		'home_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'home_page_sidebar',
    		array(
                'label'	      => __( 'Blog Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the blog page.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true ),	
     		)
		)
	);
    
    /** Single Page */
    $wp_customize->add_setting(
		'single_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'single_page_sidebar',
    		array(
                'label'	      => __( 'Single Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true ),	
     		)
		)
	);
    
    /** Single Post */
    $wp_customize->add_setting(
		'single_post_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'single_post_sidebar',
    		array(
                'label'	      => __( 'Single Post Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true ),	
     		)
		)
	);
    
    /** Archive Page */
    $wp_customize->add_setting(
		'archive_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'archive_page_sidebar',
    		array(
                'label'	      => __( 'Archive Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true ),	
     		)
		)
	);
    
    /** Category Archive Page */
    $wp_customize->add_setting(
		'cat_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'cat_archive_page_sidebar',
    		array(
                'label'	      => __( 'Category Archive Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the category archives.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true, true ),	
     		)
		)
	);
    
    /** Tag Archive Page */
    $wp_customize->add_setting(
		'tag_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'tag_archive_page_sidebar',
    		array(
                'label'	      => __( 'Tag Archive Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the tag archives.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true, true ),	
     		)
		)
	);
    
    /** Date Archive Page */
    $wp_customize->add_setting(
		'date_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'date_archive_page_sidebar',
    		array(
                'label'	      => __( 'Date Archive Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the date archives.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true, true ),	
     		)
		)
	);
    
    /** Author Archive Page */
    $wp_customize->add_setting(
		'author_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'author_archive_page_sidebar',
    		array(
                'label'	      => __( 'Author Archive Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the author archives.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true, true ),	
     		)
		)
	);
    
    /** Search Page */
    $wp_customize->add_setting(
		'search_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'search_page_sidebar',
    		array(
                'label'	      => __( 'Search Page Sidebar', 'jobscout-pro' ),
                'description' => __( 'Select a sidebar for the search results.', 'jobscout-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => jobscout_pro_get_dynamic_sidebar( false, true ),	
     		)
		)
	);  
    /** Sidebar Settings Ends */
}
add_action( 'customize_register', 'jobscout_pro_customize_register_sidebar' );