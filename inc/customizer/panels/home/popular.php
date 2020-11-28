<?php
/**
 * Popular Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_popular( $wp_customize ){

    $wpjob_manager_activated = is_wp_job_manager_activated();

    /** Popular Section */
    $wp_customize->add_section(
        'popular_section',
        array(
            'title'    => __( 'Popular Section', 'jobscout-pro' ),
            'priority' => 15,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Popular title */
    $wp_customize->add_setting(
        'popular_section_title',
        array(
            'default'           => __( 'Popular Categories', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_section_title',
        array(
            'section' => 'popular_section',
            'label'   => __( 'Popular Title', 'jobscout-pro' ),
        )
    );

    /** Selective refresh for blog title. */
    $wp_customize->selective_refresh->add_partial( 'popular_section_title', array(
        'selector'            => '.category-section .container .widget_text h2.section-title',
        'render_callback'     => 'jobscout_pro_get_popular_section_title',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );

    /** Popular description */
    $wp_customize->add_setting(
        'popular_section_subtitle',
        array(
            'default'           => __( 'We&rsquo;re your first step to becoming everything you want to be.', 'jobscout-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_section_subtitle',
        array(
            'section' => 'popular_section',
            'label'   => __( 'Popular Description', 'jobscout-pro' ),
            'type'    => 'textarea',
        )
    ); 

    /** Selective refresh for blog description. */
    $wp_customize->selective_refresh->add_partial( 'popular_section_subtitle', array(
        'selector'            => '.category-section .container .widget_text .section-desc',
        'render_callback'     => 'jobscout_pro_get_popular_section_description',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );

    if( $wpjob_manager_activated ){

        $ed_job_type     = get_option( 'job_manager_enable_types' );                                
        $ed_job_category = get_option( 'job_manager_enable_categories' );  

        /** Popular  Options */
        $wp_customize->add_setting(
            'ed_popular_options',
            array(
                'default'           => 'job_type',
                'sanitize_callback' => 'jobscout_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new JobScout_Pro_Select_Control(
                $wp_customize,
                'ed_popular_options',
                array(
                    'label'       => __( 'Select Popular Options', 'jobscout-pro' ),
                    'description' => __( 'Choose popular options as job type or job category.', 'jobscout-pro' ),
                    'section'     => 'popular_section',
                    'choices'     => array(
                        'job_type'     => __( 'Job Type', 'jobscout-pro' ),
                        'job_category' => __( 'Job Category', 'jobscout-pro' ),
                    ),
                )            
            )
        );

        if( $ed_job_type ){
            /** Popular Job Type */
            $wp_customize->add_setting( 
                new JobScout_Pro_Repeater_Setting( 
                    $wp_customize, 
                    'popular_job_types', 
                    array(
                        'default'           => '',
                        'sanitize_callback' => array( 'JobScout_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
                    ) 
                ) 
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Control_Repeater(
                    $wp_customize,
                    'popular_job_types',
                    array(
                        'section' => 'popular_section',                
                        'label'   => __( 'Popular Job Types', 'jobscout-pro' ),
                        'fields'  => array(
                            'job_type' => array(
                                'type'    => 'select',
                                'label'   => __( 'Select popular job type', 'jobscout-pro' ),
                                'choices' => jobscout_pro_get_categories( true, 'job_listing_type', true )
                            )
                        ),
                        'row_label' => array(
                            'type'  => 'field',
                            'value' => __( 'Popular job type', 'jobscout-pro' ),
                            'field' => 'job_type'
                        ),
                        'active_callback' => 'jobscout_pro_homepage_popular_section_ac'   
                    )
                )
            );
        }else{
            /** Note */
            $wp_customize->add_setting(
                'popular_job_type_note',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'wp_kses_post' 
                )
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Note_Control( 
                    $wp_customize,
                    'popular_job_type_note',
                    array(
                        'section'     => 'popular_section',
                        'description' => sprintf( __( 'Please %1$sEnable listing types%2$s option form job settings .', 'jobscout-pro' ), '<a href="' . admin_url( 'edit.php?post_type=job_listing&page=job-manager-settings#settings-job_listings' ) . '" target="_blank">', '</a>' ),
                        'active_callback' => 'jobscout_pro_homepage_popular_section_ac'   
                    )
                )
            );
        }

        if( $ed_job_category ){
            /** Popular Job Category */
            $wp_customize->add_setting( 
                new JobScout_Pro_Repeater_Setting( 
                    $wp_customize, 
                    'popular_job_categories', 
                    array(
                        'default'           => '',
                        'sanitize_callback' => array( 'JobScout_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
                    ) 
                ) 
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Control_Repeater(
                    $wp_customize,
                    'popular_job_categories',
                    array(
                        'section' => 'popular_section',                
                        'label'   => __( 'Popular Job Categories ', 'jobscout-pro' ),
                        'fields'  => array(
                            'job_cat' => array(
                                'type'    => 'select',
                                'label'   => __( 'Select popular job category', 'jobscout-pro' ),
                                'choices' => jobscout_pro_get_categories( true, 'job_listing_category', true )
                            )
                        ),
                        'row_label' => array(
                            'type'  => 'field',
                            'value' => __( 'Popular job category', 'jobscout-pro' ),
                            'field' => 'job_cat'
                        ),
                        'active_callback' => 'jobscout_pro_homepage_popular_section_ac'                        
                    )
                )
            );
        }else{
            /** Note */
            $wp_customize->add_setting(
                'popular_job_category_note',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'wp_kses_post' 
                )
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Note_Control( 
                    $wp_customize,
                    'popular_job_category_note',
                    array(
                        'section'         => 'popular_section',
                        'description'     => sprintf( __( 'Please %1$sEnable listing categories%2$s option form job settings .', 'jobscout-pro' ), '<a href="' . admin_url( 'edit.php?post_type=job_listing&page=job-manager-settings#settings-job_listings' ) . '" target="_blank">', '</a>' ),
                        'active_callback' => 'jobscout_pro_homepage_popular_section_ac'   
                    )
                )
            );
        }
    }else{
        $wp_customize->add_setting(
            'popular_section_note', array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new JobScout_Pro_Plugin_Recommend_Control(
                $wp_customize, 'popular_section_note', array(
                    'label'       => __( 'Instructions', 'jobscout-pro' ),
                    'section'     => 'popular_section',
                    'capability'  => 'install_plugins',
                    'plugin_slug' => 'wp-job-manager',
                    'description' => __( 'Please install the recommended plugin "WP Job Manager" for setting of this section.', 'jobscout-pro' )
                )
            )
        );
    }

    /** Popular Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_popular' );