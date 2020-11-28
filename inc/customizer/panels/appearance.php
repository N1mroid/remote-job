<?php
/**
 * Appearance Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_appearance( $wp_customize ) {
    
    $wp_customize->add_panel( 
        'appearance_settings', 
        array(
            'title'       => __( 'Appearance Settings', 'jobscout-pro' ),
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
            'description' => __( 'Change color and body background.', 'jobscout-pro' ),
        ) 
    );
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel                          = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority                       = 30;
    $wp_customize->get_section( 'background_image' )->panel                = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority             = 35;
    $wp_customize->get_section( 'background_image' )->title                = __( 'Background', 'jobscout-pro' );
    $wp_customize->get_control( 'background_image' )->active_callback      = 'jobscout_pro_body_bg_choice';       
    $wp_customize->get_control( 'background_preset' )->active_callback     = 'jobscout_pro_body_bg_choice';
    $wp_customize->get_control( 'background_position' )->active_callback   = 'jobscout_pro_body_bg_choice';
    $wp_customize->get_control( 'background_size' )->active_callback       = 'jobscout_pro_body_bg_choice';
    $wp_customize->get_control( 'background_repeat' )->active_callback     = 'jobscout_pro_body_bg_choice';
    $wp_customize->get_control( 'background_attachment' )->active_callback = 'jobscout_pro_body_bg_choice';
    $wp_customize->get_control( 'background_color' )->description          = __( 'Background color of the theme.', 'jobscout-pro' );  
}
add_action( 'customize_register', 'jobscout_pro_customize_register_appearance' );