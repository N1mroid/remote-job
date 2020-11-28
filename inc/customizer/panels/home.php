<?php
/**
 * Front Page Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'jobscout-pro' ),
            'description' => __( 'Static Home Page settings.', 'jobscout-pro' ),
        ) 
    );    
      
}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage' );