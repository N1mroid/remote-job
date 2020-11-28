<?php
/**
 * Job Posting Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_job_posting( $wp_customize ){

    $wpjob_manager_activated = is_wp_job_manager_activated();

    /** Job Posting Section */
    $wp_customize->add_section(
        'job_posting_section',
        array(
            'title'    => __( 'Job Posting Section', 'jobscout-pro' ),
            'priority' => 20,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Job Posting title */
    $wp_customize->add_setting(
        'job_posting_section_title',
        array(
            'default'           => __( 'Job Posting', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'job_posting_section_title',
        array(
            'section' => 'job_posting_section',
            'label'   => __( 'Job Posting Title', 'jobscout-pro' ),
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'job_posting_section_title', array(
        'selector' => '.top-job-section .container h2.section-title',
        'render_callback' => 'jobscout_pro_get_job_posting_section_title',
    ) );

    if( $wpjob_manager_activated ){

        /** Order By */
        $wp_customize->add_setting(
            'job_posting_orderby',
            array(
                'default'           => 'featured',
                'sanitize_callback' => 'jobscout_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new JobScout_Pro_Select_Control(
                $wp_customize,
                'job_posting_orderby',
                array(
                    'label'       => __( 'Order By', 'jobscout-pro' ),
                    'description' => __( 'Choose option to display job listings order.', 'jobscout-pro' ),
                    'section'     => 'job_posting_section',
                    'choices'     => array(
                        'featured'       => __( 'Featured Job', 'jobscout-pro' ),
                        'ID'             => __( 'Job ID', 'jobscout-pro' ),
                        'name'           => __( 'Job Title', 'jobscout-pro' ),
                        'date'           => __( 'Published Date', 'jobscout-pro' ),
                        'modified'       => __( 'Modified Date', 'jobscout-pro' ),
                        'rand'           => __( 'Random', 'jobscout-pro' ),
                        'rand_featured ' => __( 'Random Featured', 'jobscout-pro' ),
                    ),
                )            
            )
        );  

        /** Sort By */
        $wp_customize->add_setting(
            'job_posting_sortby',
            array(
                'default'           => 'desc',
                'sanitize_callback' => 'jobscout_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new JobScout_Pro_Select_Control(
                $wp_customize,
                'job_posting_sortby',
                array(
                    'label'       => __( 'Sort By', 'jobscout-pro' ),
                    'description' => __( 'Choose option to sort job listings.', 'jobscout-pro' ),
                    'section'     => 'job_posting_section',
                    'choices'     => array(
                        'desc' => __( 'Descending', 'jobscout-pro' ),
                        'asc'  => __( 'Ascending', 'jobscout-pro' ),
                    ),
                    'active_callback' => 'jobscout_pro_sorting_option_ac'
                )            
            )
        );                                                      
    }else{
        $wp_customize->add_setting(
            'job_posting_section_note', array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new JobScout_Pro_Plugin_Recommend_Control(
                $wp_customize, 'job_posting_section_note', array(
                    'label'       => __( 'Instructions', 'jobscout-pro' ),
                    'section'     => 'job_posting_section',
                    'capability'  => 'install_plugins',
                    'plugin_slug' => 'wp-job-manager',
                    'description' => __( 'Please install the recommended plugin "WP Job Manager" for setting of this section.', 'jobscout-pro' )
                )
            )
        );
    }

    /** Job Posting Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_job_posting' );