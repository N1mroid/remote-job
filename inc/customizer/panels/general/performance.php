<?php
/**
 * Performance Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_performance( $wp_customize ) {
    
   /** Performance Settings */
    $wp_customize->add_section(
        'performance_settings',
        array(
            'title'      => __( 'Performance Settings', 'jobscout-pro' ),
            'priority'   => 80,
            'capability' => 'edit_theme_options',
            'panel'      => 'general_settings'
        )
    );
    
    /** Lazy Load */
    $wp_customize->add_setting(
        'ed_lazy_load',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_lazy_load',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Lazy Load', 'jobscout-pro' ),
                'description'   => __( 'Enable lazy loading of featured images.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Lazy Load Content Images */
    $wp_customize->add_setting(
        'ed_lazy_load_cimage',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_lazy_load_cimage',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Lazy Load Content Images', 'jobscout-pro' ),
                'description'   => __( 'Enable lazy loading of images inside page/post content.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Lazy Load Gravatar */
    $wp_customize->add_setting(
        'ed_lazyload_gravatar',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_lazyload_gravatar',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Lazy Load Gravatar', 'jobscout-pro' ),
                'description'   => __( 'Enable lazy loading of gravatar image.', 'jobscout-pro' ),
            )
        )
    );

    /** Defer JavaScript */
    $wp_customize->add_setting(
        'ed_defer',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_defer',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Defer JavaScript', 'jobscout-pro' ),
                'description'   => __( 'Adds "defer" attribute to sript tags to improve page download speed.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_ver',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_ver',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Remove ver parameters', 'jobscout-pro' ),
                'description'   => __( 'Enable to remove "ver" parameter from CSS and JS file calls.', 'jobscout-pro' ),
            )
        )
    );

    /** All js combined Header */
    $wp_customize->add_setting(
        'ed_jquery_combined',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_jquery_combined',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Enable Combined Jquery', 'jobscout-pro' ),
                'description'   => __( 'All jquery library minified on one file.', 'jobscout-pro' ),
            )
        )
    );

    /** All CSS combined Header */
    $wp_customize->add_setting(
        'ed_style_combined',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_style_combined',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Enable Combined Style', 'jobscout-pro' ),
                'description'   => __( 'All CSS library minified on one file.', 'jobscout-pro' ),
            )
        )
    );

    /** Locally Host Google Fonts */
    $wp_customize->add_setting(
        'ed_googlefont_local',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_googlefont_local',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Locally Host Google Fonts', 'jobscout-pro' ),
                'description'   => sprintf( __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies. %1$sBack to Typgraphy%2$s', 'jobscout-pro' ), '<span class="text-inner-link ed_googlefont_local">', '</span>' )
            )
        )
    );
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_performance' );