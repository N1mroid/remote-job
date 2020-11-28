<?php
/**
 * Typography Body Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_typography_body( $wp_customize ) {
    
    /** Body Settings */
    $wp_customize->add_section(
        'body_settings',
        array(
            'title'    => __( 'Body Settings', 'jobscout-pro' ),
            'priority' => 10,
            'panel'    => 'typography_settings'
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Nunito Sans',
			'sanitize_callback' => 'jobscout_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'jobscout-pro' ),
                'description' => __( 'Primary font of the site.', 'jobscout-pro' ),
    			'section'     => 'body_settings',
    			'choices'     => jobscout_pro_get_all_fonts(),	
     		)
		)
	);
        
    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 18,
            'sanitize_callback' => 'jobscout_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Slider_Control( 
			$wp_customize,
			'font_size',
			array(
				'section'	  => 'body_settings',
				'label'		  => __( 'Font Size', 'jobscout-pro' ),
				'description' => __( 'Change the font size of your site.', 'jobscout-pro' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 50,
					'step'	=> 1,
				)                 
			)
		)
	);
    
    /** Note */
    $wp_customize->add_setting(
        'typography_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Note_Control( 
            $wp_customize,
            'typography_text',
            array(
                'section'     => 'body_settings',
                'description' => sprintf( __( 'To load google fonts from your own server instead from google\'s CDN enable the %1$sLocally Host Google Fonts%2$s option in Performance Settings.', 'jobscout-pro' ), '<span class="text-inner-link typography_text">', '</span>' ),
            )
        )
    );
}
add_action( 'customize_register', 'jobscout_pro_customize_register_typography_body' );