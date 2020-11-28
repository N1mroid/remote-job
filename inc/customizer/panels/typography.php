<?php
/**
 * Typography Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_typography( $wp_customize ) {
    
    /** Typography */
    $wp_customize->add_panel(
        'typography_settings',
        array(
            'title'       => __( 'Typography', 'jobscout-pro' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 35,
            'description' => __( 'Body and Content\'s H1 to H6 Typography settings.', 'jobscout-pro' ),
        )
    );   
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_typography' );