<?php
/**
 * Background Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_appearance_background( $wp_customize ) {
    
    /** Body Background */
    $wp_customize->add_setting( 
        'body_bg', 
        array(
            'default'           => 'image',
            'sanitize_callback' => 'jobscout_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Radio_Buttonset_Control(
			$wp_customize,
			'body_bg',
			array(
				'section'	  => 'background_image',
				'label'       => __( 'Body Background', 'jobscout-pro' ),
                'description' => __( 'Choose body background as image or pattern.', 'jobscout-pro' ),
				'choices'	  => array(
					'image'   => __( 'Image', 'jobscout-pro' ),
                    'pattern' => __( 'Pattern', 'jobscout-pro' ),
				),
                'priority'    => 5
			)
		)
	);
    
    /** Background Pattern */
    $wp_customize->add_setting( 
        'bg_pattern', array(
            'default'           => 'nobg',
            'sanitize_callback' => 'jobscout_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Radio_Image_Control(
			$wp_customize,
			'bg_pattern',
			array(
				'section'		  => 'background_image',
				'label'			  => __( 'Background Pattern', 'jobscout-pro' ),
				'description'	  => __( 'Choose from any of 64 awesome background patterns for your site background.', 'jobscout-pro' ),
				'choices'         => jobscout_pro_get_patterns(),
                'active_callback' => 'jobscout_pro_body_bg_choice'
			)
		)
	);
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_appearance_background' );