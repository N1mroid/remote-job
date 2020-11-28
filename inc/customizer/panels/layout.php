<?php
/**
 * Layout Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_layout( $wp_customize ) {
    
    /** Layout Settings */
    $wp_customize->add_panel( 
        'layout_settings',
         array(
            'priority'    => 30,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Layout Settings', 'jobscout-pro' ),
            'description' => __( 'Change different page layout from here.', 'jobscout-pro' ),
        ) 
    );
}
add_action( 'customize_register', 'jobscout_pro_customize_register_layout' );