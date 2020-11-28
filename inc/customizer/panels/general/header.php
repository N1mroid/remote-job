<?php
/**
 * Header Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_header( $wp_customize ) {

    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'jobscout-pro' ),
            'priority' => 15,
            'panel'    => 'general_settings',
        )
    );
    
    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_sticky_header',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_sticky_header',
            array(
                'section'       => 'header_settings',
                'label'         => __( 'Sticky Header', 'jobscout-pro' ),
                'description'   => __( 'Enable to stick header at top.', 'jobscout-pro' ),
            )
        )
    );

    /** Login / Logout */
    $wp_customize->add_setting(
        'ed_header_signin_signout',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_header_signin_signout',
            array(
                'section'       => 'header_settings',
                'label'         => __( 'Enable Sign In / Sign Out', 'jobscout-pro' ),
                'description'   => __( 'Enable to display sign in / sign out.', 'jobscout-pro' ),
            )
        )
    );

    /** Sign in page template Url */
    $wp_customize->add_setting(
        'header_signin_signout_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw' 
        )
    );
    
    $wp_customize->add_control(
        'header_signin_signout_url',
        array(
            'type'        => 'url',
            'section'     => 'header_settings',
            'label'       => __( 'Sign in page template Url', 'jobscout-pro' ),
            'description' => __( 'Add page template url of signin page. leave empty to use default WordPress login page.', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_header_signin_signout_ac'
        )
    );

    /** Post Job Label */
    $wp_customize->add_setting(
        'post_job_label',
        array(
            'default'           => __( 'Post Jobs', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'post_job_label',
        array(
            'type'    => 'text',
            'section' => 'header_settings',
            'label'   => __( 'Post Job Label', 'jobscout-pro' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'post_job_label', array(
        'selector' => '.site-header .header-main .btn-wrap a.btn',
        'render_callback' => 'jobscout_pro_get_header_post_job_label',
    ) );
    
    /** Post Job Url */
    $wp_customize->add_setting(
        'post_job_url',
        array(
            'default'           => __( '#', 'jobscout-pro' ),
            'sanitize_callback' => 'esc_url_raw' 
        )
    );
    
    $wp_customize->add_control(
        'post_job_url',
        array(
            'type'    => 'url',
            'section' => 'header_settings',
            'label'   => __( 'Post Job Url', 'jobscout-pro' ),
        )
    );


    /** Header Settings Ends */
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_header' );