<?php
/**
 * Newsletter Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_newsletter( $wp_customize ) {
    
    /** Newsletter Settings */
    $wp_customize->add_section(
        'newsletter_settings',
        array(
            'title'    => __( 'Newsletter Settings', 'jobscout-pro' ),
            'priority' => 60,
            'panel'    => 'general_settings',
        )
    );
    
    if( is_btnw_activated() ){
		
        /** Enable Newsletter Section */
        $wp_customize->add_setting( 
            'ed_newsletter', 
            array(
                'default'           => false,
                'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new JobScout_Pro_Toggle_Control( 
    			$wp_customize,
    			'ed_newsletter',
    			array(
    				'section'     => 'newsletter_settings',
    				'label'	      => __( 'Newsletter Section', 'jobscout-pro' ),
                    'description' => __( 'Enable to show Newsletter Section', 'jobscout-pro' ),
    			)
    		)
    	);
        
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'newsletter_shortcode',
            array(
                'type'        => 'text',
                'section'     => 'newsletter_settings',
                'label'       => __( 'Newsletter Shortcode', 'jobscout-pro' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'jobscout-pro' ),
            )
        ); 
	} else {
		$wp_customize->add_setting(
			'newsletter_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new JobScout_Pro_Plugin_Recommend_Control(
				$wp_customize,
				'newsletter_recommend',
				array(
					'section'     => 'newsletter_settings',
					'label'       => __( 'Newsletter Shortcode', 'jobscout-pro' ),
					'capability'  => 'install_plugins',
					'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s. After that option related with this section will be visible.', 'jobscout-pro' ), '<strong>', '</strong>' ),
				)
			)
		);
	}
       
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_newsletter' );