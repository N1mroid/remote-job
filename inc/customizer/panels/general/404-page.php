<?php
/**
 * Page 404 Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_page_404_settings( $wp_customize ) {
    $wpjob_manager_activated = is_wp_job_manager_activated();

    /** Page 404 Settings */
    $wp_customize->add_section(
        'page_404_settings',
        array(
            'title'    => __( 'Page 404 Settings', 'jobscout-pro' ),
            'priority' => 45,
            'panel'    => 'general_settings',
        )
    );

    /** Show Latest Posts */
    $wp_customize->add_setting( 
        'ed_404_latest', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_404_latest',
            array(
                'section'     => 'page_404_settings',
                'label'       => __( 'Show Latest Posts / Jobs', 'jobscout-pro' ),
                'description' => __( 'Enable to show latest posts / Jobs in 404 page.', 'jobscout-pro' ),
            )
        )
    );

     /** Latest Posts / Jobs option */
    $wp_customize->add_setting( 
        'buttonset_404_latest', 
        array(
            'default'           => 'latest_posts',
            'sanitize_callback' => 'jobscout_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Radio_Buttonset_Control(
            $wp_customize,
            'buttonset_404_latest',
            array(
                'section'     => 'page_404_settings',
                'label'       => __( 'Latest Posts / Jobs option', 'jobscout-pro' ),
                'description' => __( 'Choose option as  latest post or latest jobs.', 'jobscout-pro' ),
                'choices'     => array(
                    'latest_posts'   => __( 'Latest Posts', 'jobscout-pro' ),
                    'latest_jobs' => __( 'Latest Jobs', 'jobscout-pro' ),
                ),
                'active_callback' => 'jobscout_pro_job_404_page_ac'
            )
        )
    );

    /** Latest jobs section title */
    $wp_customize->add_setting(
        'page_404_latest_jobs_title',
        array(
            'default'           => __( 'Recommended Jobs', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'page_404_latest_jobs_title',
        array(
            'section'         => 'page_404_settings',
            'label'           => __( 'Latest Jobs Section Title', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_job_404_page_ac'
        )
    );

    /** Latest post section title */
    $wp_customize->add_setting(
        'page_404_latest_post_title',
        array(
            'default'           => __( 'Latest Posts', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'page_404_latest_post_title',
        array(
            'section'         => 'page_404_settings',
            'label'           => __( 'Latest Post Section Title', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_job_404_page_ac'
        )
    );

    if( ! $wpjob_manager_activated ){
        /** Note to active Job Manager Plugin */
        $wp_customize->add_setting(
            'plugin_notice_404_page',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new JobScout_Pro_Note_Control( 
                $wp_customize,
                'plugin_notice_404_page',
                array(
                    'section'         => 'page_404_settings',
                    'description'     => __( 'Please install and then activate the recommended plugin "WP Job Manager" to display latest jobs.', 'jobscout-pro' ),
                    'active_callback' => 'jobscout_pro_job_404_page_ac'   
                )
            )
        );
    }
   
}
add_action( 'customize_register', 'jobscout_pro_customize_page_404_settings' );