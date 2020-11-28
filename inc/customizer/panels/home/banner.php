<?php
/**
 * Banner Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_banner( $wp_customize ) {
	
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'jobscout-pro' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'jobscout_pro_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'jobscout_pro_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'jobscout_pro_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'static_banner',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'jobscout-pro' ),
                'description' => __( 'Choose banner options.', 'jobscout-pro' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'jobscout-pro' ),
                    'static_banner'    => __( 'Static/Video Search Banner', 'jobscout-pro' ),
                ),
                'priority' => 5	
     		)            
		)
	);
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Aim Higher, Dream Bigger', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'jobscout-pro' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.site-banner .banner-caption h2.title',
        'render_callback' => 'jobscout_pro_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Each month, more than 7 million Jobscout turn to website in their search for work, making over 160,000 applications every day.', 'jobscout-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Sub Title', 'jobscout-pro' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback' => 'jobscout_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector' => '.site-banner .banner-caption .description',
        'render_callback' => 'jobscout_pro_get_banner_sub_title',
    ) );
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_banner' );