<?php
/**
 * Job Single Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_job_single_settings( $wp_customize ) {
    $wpjob_manager_activated = is_wp_job_manager_activated();
    $ed_job_type             = get_option( 'job_manager_enable_types' );                                
    $ed_job_category         = get_option( 'job_manager_enable_categories' ); 

    /** Job Single Settings */
    $wp_customize->add_section(
        'job_single_settings',
        array(
            'title'    => __( 'Job Single Settings', 'jobscout-pro' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );

    if( $wpjob_manager_activated ){

        /** Show job banner */
        $wp_customize->add_setting( 
            'ed_job_banner', 
            array(
                'default'           => true,
                'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new JobScout_Pro_Toggle_Control( 
                $wp_customize,
                'ed_job_banner',
                array(
                    'section'     => 'job_single_settings',
                    'label'       => __( 'Show Banner', 'jobscout-pro' ),
                    'description' => __( 'Enable to show banner in job single page. To add banner go to Front Page Settings -> Banner Section -> Header Image', 'jobscout-pro' ),
                )
            )
        );

        /** Show job additional info */
        $wp_customize->add_setting( 
            'ed_job_additional_info', 
            array(
                'default'           => true,
                'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
            new JobScout_Pro_Toggle_Control( 
                $wp_customize,
                'ed_job_additional_info',
                array(
                    'section'     => 'job_single_settings',
                    'label'       => __( 'Show Job Additional Info', 'jobscout-pro' ),
                    'description' => __( 'Enable to show additional info in job single page.', 'jobscout-pro' ),
                )
            )
        );

        /** Show Related Jobs */
        $wp_customize->add_setting( 
            'ed_job_related', 
            array(
                'default'           => true,
                'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new JobScout_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_job_related',
    			array(
    				'section'     => 'job_single_settings',
    				'label'	      => __( 'Show Related Jobs', 'jobscout-pro' ),
                    'description' => __( 'Enable to show related jobs in job single page.', 'jobscout-pro' ),
    			)
    		)
    	);
        
        /** Related Jobs section title */
        $wp_customize->add_setting(
            'related_job_title',
            array(
                'default'           => __( 'Similar Jobs', 'jobscout-pro' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage' 
            )
        );
        
        $wp_customize->add_control(
            'related_job_title',
            array(
                'section'         => 'job_single_settings',
                'label'           => __( 'Related Jobs Section Title', 'jobscout-pro' ),
                'active_callback' => 'jobscout_pro_job_single_page_ac'
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 'related_job_title', array(
            'selector'        => '.single-job .additional-posts h2.section-title',
            'render_callback' => 'jobscout_pro_get_related_job_title',
        ) );
        
        /** Related Job Taxonomy */    
        $wp_customize->add_setting( 
            'related_job_taxonomy', 
            array(
                'default'           => 'job_type',
                'sanitize_callback' => 'jobscout_pro_sanitize_radio'
            ) 
        );
        
        $wp_customize->add_control(
    		new JobScout_Pro_Radio_Buttonset_Control(
    			$wp_customize,
    			'related_job_taxonomy',
    			array(
    				'section'	  => 'job_single_settings',
    				'label'       => __( 'Related Job Taxonomy', 'jobscout-pro' ),
                    'description' => __( 'Choose Categories/Tags to display related post based on in Single Post.', 'jobscout-pro' ),
    				'choices'	  => array(
                        'job_type'     => __( 'Job Types', 'jobscout-pro' ),
                        'job_category' => __( 'Job Categories', 'jobscout-pro' ),
    				),
                    'active_callback' => 'jobscout_pro_job_single_page_ac'
    			)
    		)
    	);

        if( ! $ed_job_type ){
            /** Note */
            $wp_customize->add_setting(
                'single_job_type_note',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'wp_kses_post' 
                )
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Note_Control( 
                    $wp_customize,
                    'single_job_type_note',
                    array(
                        'section'     => 'job_single_settings',
                        'description' => sprintf( __( 'Please %1$sEnable listing types%2$s option form job settings .', 'jobscout-pro' ), '<a href="' . admin_url( 'edit.php?post_type=job_listing&page=job-manager-settings#settings-job_listings' ) . '" target="_blank">', '</a>' ),
                        'active_callback' => 'jobscout_pro_job_single_page_ac'   
                    )
                )
            );
        }

        if( ! $ed_job_category ){
            /** Note */
            $wp_customize->add_setting(
                'single_job_category_note',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'wp_kses_post' 
                )
            );
            
            $wp_customize->add_control(
                new JobScout_Pro_Note_Control( 
                    $wp_customize,
                    'single_job_category_note',
                    array(
                        'section'         => 'job_single_settings',
                        'description'     => sprintf( __( 'Please %1$sEnable listing categories%2$s option form job settings .', 'jobscout-pro' ), '<a href="' . admin_url( 'edit.php?post_type=job_listing&page=job-manager-settings#settings-job_listings' ) . '" target="_blank">', '</a>' ),
                        'active_callback' => 'jobscout_pro_job_single_page_ac'   
                    )
                )
            );
        }
    }
}
add_action( 'customize_register', 'jobscout_pro_customize_job_single_settings' );