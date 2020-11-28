<?php
/**
 * Color Setting
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_color( $wp_customize ) {
    
    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#2ace5e',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'jobscout-pro' ),
                'description' => __( 'Primary color of the theme.', 'jobscout-pro' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    $wp_customize->add_setting(
       'fallback_svg',
       array(
           'default'           => '#f0f0f0',
           'sanitize_callback' => 'sanitize_hex_color',
       )
   );

   $wp_customize->add_control(
       new WP_Customize_Color_Control(
           $wp_customize,
           'fallback_svg',
           array(
               'label'       => __( 'Fallback SVG Background Color', 'jobscout-pro' ),
               'description' => __( 'Fallback svg color of the theme', 'jobscout-pro' ),
               'section'     => 'colors',
               'priority'    => 15,
           )
       )
   );

    /** Footer Background Color*/
    $wp_customize->add_setting( 
        'footer_bg_color', 
        array(
            'default'           => '#111111',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'footer_bg_color', 
            array(
                'label'       => __( 'Footer Background Color', 'jobscout-pro' ),
                'description' => __( 'Footer Background color of the theme.', 'jobscout-pro' ),
                'section'     => 'colors',
            )
        )
    );
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_color' );