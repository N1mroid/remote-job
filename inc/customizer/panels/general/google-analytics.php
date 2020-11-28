<?php
/**
 * Google Analytics Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_google_analytics( $wp_customize ) {
    
    /** Google Analytics Settings */
    $wp_customize->add_section(
        'google_analytics_settings',
        array(
            'title'    => __( 'Google Analytics Settings', 'jobscout-pro' ),
            'priority' => 90,
            'panel'    => 'general_settings',
        )
    );
    
    /** After Content AD Code */
    $wp_customize->add_setting(
        'google_analytics_ad_code',
        array(
            'default'           => '',
            'sanitize_callback' => 'jobscout_pro_sanitize_code'
        )
    );
        
    $wp_customize->add_control( 
        new WP_Customize_Code_Editor_Control(
            $wp_customize, 
            'google_analytics_ad_code',
            array(
                'section'     => 'google_analytics_settings',
                'label'       => __( 'Analytics Code', 'jobscout-pro' ),
                'description' => __( 'Paste your google analytics code here.', 'jobscout-pro' ),
                'code_type'   => 'javascript',            
            )
        )       
    );
    
    /** Google Analytics Settings Ends */
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_google_analytics' );

