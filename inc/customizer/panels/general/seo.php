<?php
/**
 * SEO Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_seo( $wp_customize ) {
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'jobscout-pro' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'jobscout-pro' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'jobscout-pro' ),
			)
		)
	);
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_breadcrumb',
            array(
                'section'     => 'seo_settings',
                'label'       => __( 'Enable Breadcrumb', 'jobscout-pro' ),
                'description' => __( 'Enable to show breadcrumb in inner pages.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => __( 'Home', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'            => 'text',
            'section'         => 'seo_settings',
            'label'           => __( 'Breadcrumb Home Text', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_breacrumbs_active_callback'
        )
    );  
    /** SEO Settings Ends */
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_seo' );