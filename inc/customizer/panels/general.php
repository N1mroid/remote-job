<?php
/**
 * General Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'jobscout-pro' ),
            'description' => __( 'Customize Header, Social, Sharing, SEO, Post/Page, Newsletter, Performance and Miscellaneous settings.', 'jobscout-pro' ),
        ) 
    );
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general' );