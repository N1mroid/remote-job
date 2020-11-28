<?php
/**
 * Call To Action Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_cta( $wp_customize ){

    $raratheme_companion_activated = is_rara_theme_companion_activated();

    /** Call To Action Section */
    $wp_customize->add_section(
        'cta_section',
        array(
            'title'    => __( 'Call To Action Section', 'jobscout-pro' ),
            'priority' => 30,
            'panel'    => 'frontpage_settings',
        )
    );

    if( ! $raratheme_companion_activated ){
        $wp_customize->add_setting(
            'homepage_cta_section_note',
            array(
                'sanitize_callback' => 'wp_kses_post'
            )
        );
    
        $wp_customize->add_control(
            new JobScout_Pro_Note_Control( 
                $wp_customize,
                'homepage_cta_section_note',
                array(
                    'section'      => 'cta_section', 
                    'description' => sprintf( __( 'Please install/activate the %1$sRaraTheme Companion%2$s Plugin to add "Rara: Call to Action" Widget.', 'jobscout-pro' ), '<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '" target="_blank">', '</a>' ),
                )
            )
        );
    }

    $home_cta_settings = $wp_customize->get_section( 'sidebar-widgets-cta' );

    if ( ! empty( $home_cta_settings ) ) {
        $home_cta_settings->panel = 'frontpage_settings';
        $home_cta_settings->priority = 30;
        $wp_customize->get_section( 'sidebar-widgets-cta' )->title = __( 'Call To Action Section','jobscout-pro' );
        if( ! $raratheme_companion_activated  ) {
            $wp_customize->get_control( 'homepage_cta_section_note' )->section  = 'sidebar-widgets-cta';
            $wp_customize->get_control( 'homepage_cta_section_note' )->priority  = -1;
        }
    }
    /** Call To Action Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_cta' );