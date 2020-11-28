<?php
/**
 * Contact Page Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_contact( $wp_customize ) {
    
    $wp_customize->add_panel( 
        'contact_page_setting', 
        array(
            'title'       => __( 'Contact Page Settings', 'jobscout-pro' ),
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Contact Form, Google Map and Contact Details settings.', 'jobscout-pro' ),
        ) 
    );
        
}
add_action( 'customize_register', 'jobscout_pro_customize_register_contact' );