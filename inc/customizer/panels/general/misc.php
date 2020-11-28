<?php
/**
 * Miscellaneous Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_misc( $wp_customize ) {
    
    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'jobscout-pro' ),
            'priority' => 65,
            'panel'    => 'general_settings',
        )
    );
    
    /** Admin Bar */
    $wp_customize->add_setting(
        'ed_adminbar',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_adminbar',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Admin Bar', 'jobscout-pro' ),
				'description'	=> __( 'Disable to hide Admin Bar in frontend when logged in.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Lightbox */
    $wp_customize->add_setting(
        'ed_lightbox',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_lightbox',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Lightbox', 'jobscout-pro' ),
				'description'	=> __( 'A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'jobscout-pro' ),
			)
		)
	);
       
    /** Last Widget Sticky */
    $wp_customize->add_setting(
        'ed_last_widget_sticky',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_last_widget_sticky',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Last Widget Sticky', 'jobscout-pro' ),
				'description'	=> __( 'Enable to stick last widget in sidebar.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Drop Cap */
    $wp_customize->add_setting(
        'ed_drop_cap',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_drop_cap',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Drop Cap', 'jobscout-pro' ),
				'description'	=> __( 'Enable to show first letter of word in post/page content in drop cap.', 'jobscout-pro' ),
			)
		)
	);

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'misc_settings',
                'label'           => __( 'Shop Page Description', 'jobscout-pro' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'jobscout-pro' ),
                'active_callback' => 'is_woocommerce_activated'
            )
        )
    );
    
    /** $shop_archive_description */
    $wp_customize->add_setting( 
        'shop_archive_description', 
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post'
        ) 
    );
    
    $wp_customize->add_control(
        'shop_archive_description',
        array(
            'section'         => 'misc_settings',
            'label'           => __( 'Description For Shop Page', 'jobscout-pro' ),
            'description'     => __( 'Write new description for Shop Page to overwrite the default description.', 'jobscout-pro' ),
            'type'            => 'textarea',
            'active_callback' => 'jobscout_pro_shop_description_ac'
        )
    );
        
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_misc' );