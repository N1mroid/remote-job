<?php
/**
 * Typography H4 Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_typography_h4( $wp_customize ) {
    
    /** Body Settings */
    $wp_customize->add_section(
        'h4_settings',
        array(
            'title'    => __( 'H4 Settings (Content)', 'jobscout-pro' ),
            'priority' => 25,
            'panel'    => 'typography_settings'
        )
    );
    
    /** H4 Font */
    $wp_customize->add_setting( 
        'h4_font', 
        array(
            'default' => array(                                			
                'font-family' => 'Nunito Sans',
                'variant'     => '700',
            ),
            'sanitize_callback' => array( 'JobScout_Pro_Fonts', 'sanitize_typography' )
        ) 
    );

	$wp_customize->add_control( 
        new JobScout_Pro_Typography_Control( 
            $wp_customize, 
            'h4_font', 
            array(
                'label'   => __( 'H4 Font', 'jobscout-pro' ),
                'section' => 'h4_settings',
            ) 
        ) 
    );
        
    /** Font Size*/
    $wp_customize->add_setting( 
        'h4_font_size', 
        array(
            'default'           => 20,
            'sanitize_callback' => 'jobscout_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Slider_Control( 
			$wp_customize,
			'h4_font_size',
			array(
				'section' => 'h4_settings',
				'label'	  => __( 'H4 Font Size', 'jobscout-pro' ),
                'choices' => array(
					'min' 	=> 10,
					'max' 	=> 75,
					'step'	=> 1,
				)                 
			)
		)
	);
}
add_action( 'customize_register', 'jobscout_pro_customize_register_typography_h4' );