<?php
/**
 * Testimonial Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_testimonial( $wp_customize ){

    $raratheme_companion_activated = is_rara_theme_companion_activated();

    /** Testimonial Section */
    $wp_customize->add_section(
        'testimonial_section',
        array(
            'title'    => __( 'Testimonial Section', 'jobscout-pro' ),
            'priority' => 45,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Testimonial title */
    $wp_customize->add_setting(
        'testimonial_section_title',
        array(
            'default'           => __( 'Clients Testimonials', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_section_title',
        array(
            'section' => 'testimonial_section',
            'label'   => __( 'Testimonial Title', 'jobscout-pro' ),
            'type'    => 'text',
        )
    );

    /** Selective refresh for testimonial section title. */
    $wp_customize->selective_refresh->add_partial( 'testimonial_section_title', array(
        'selector'            => '.testimonial-section .container h2.section-title',
        'render_callback'     => 'jobscout_pro_get_testimonial_section_title',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );

    /** Testimonial description */
    $wp_customize->add_setting(
        'testimonial_section_subtitle',
        array(
            'default'           => __( 'We&rsquo;ll help you find it. We&rsquo;re your first step to becoming everything you want to be.', 'jobscout-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_section_subtitle',
        array(
            'section' => 'testimonial_section',
            'label'   => __( 'Testimonial Description', 'jobscout-pro' ),
            'type'    => 'textarea',
        )
    ); 

    /** Selective refresh for blog description. */
    $wp_customize->selective_refresh->add_partial( 'testimonial_section_subtitle', array(
        'selector'            => '.testimonial-section .container .section-desc',
        'render_callback'     => 'jobscout_pro_get_testimonial_section_description',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );
    
    /** Testimonial Section Background Controls */
    $wp_customize->add_setting(
        'testimonial_section_bg_control',
        array(
            'default'           => 'bg_image',
            'sanitize_callback' => 'jobscout_pro_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Select_Control(
            $wp_customize,
            'testimonial_section_bg_control',
            array(
                'label'           => esc_html__( 'Select Background Options', 'jobscout-pro' ),
                'section'         => 'testimonial_section',
                'choices'         => array(
                    'bg_image' => esc_html__( 'Background Image', 'jobscout-pro' ),
                    'bg_color' => esc_html__( 'Background Color', 'jobscout-pro' ),                 
                ),
            )
        )
    );

    /** Background Image */
    $wp_customize->add_setting(
        'testimonial_section_bg_image',
        array(
            'default'           => get_template_directory_uri().'/images/testimonial-bg.jpg',
            'sanitize_callback' => 'jobscout_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'testimonial_section_bg_image',
            array(
               'label'           => esc_html__( 'Background Image', 'jobscout-pro' ),
               'section'         => 'testimonial_section',
               'active_callback' => 'jobscout_pro_homepage_testimonial_section_active_cb',
            )
       )
    );

    /** Background Color */
    $wp_customize->add_setting( 
        'testimonial_section_bg_color', 
        array(
            'default'           => '#2ace5e',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'testimonial_section_bg_color', 
            array(
                'label'           => esc_html__( 'Background Color', 'jobscout-pro' ),
                'section'         => 'testimonial_section',                
                'active_callback' => 'jobscout_pro_homepage_testimonial_section_active_cb',
            )
        )
    );

    if( ! $raratheme_companion_activated ){
        $wp_customize->add_setting(
            'homepage_testimonial_section_note',
            array(
                'sanitize_callback' => 'wp_kses_post'
            )
        );
    
        $wp_customize->add_control(
            new JobScout_Pro_Note_Control( 
                $wp_customize,
                'homepage_testimonial_section_note',
                array(
                    'section'      => 'testimonial_section', 
                    'description' => sprintf( __( 'Please install/activate the %1$sRaraTheme Companion%2$s to add "Rara: Testimonial" Widget.', 'jobscout-pro' ), '<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '" target="_blank">', '</a>' ),
                )
            )
        );
    }

    $home_testimonial_settings = $wp_customize->get_section( 'sidebar-widgets-testimonial' );

    if ( ! empty( $home_testimonial_settings ) ) {
        $home_testimonial_settings->panel = 'frontpage_settings';
        $home_testimonial_settings->priority = 40;
        $wp_customize->get_section( 'sidebar-widgets-testimonial' )->title = __( 'Testimonial Section','jobscout-pro' );
        $wp_customize->get_control( 'testimonial_section_title' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_section_title' )->priority = -6;
        $wp_customize->get_control( 'testimonial_section_subtitle' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_section_subtitle' )->priority  = -5;
        $wp_customize->get_control( 'testimonial_section_bg_control' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_section_bg_control' )->priority  = -4;
        $wp_customize->get_control( 'testimonial_section_bg_image' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_section_bg_image' )->priority  = -3;
        $wp_customize->get_control( 'testimonial_section_bg_color' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_section_bg_color' )->priority  = -2;
        if( ! $raratheme_companion_activated  ) {
            $wp_customize->get_control( 'homepage_testimonial_section_note' )->section  = 'sidebar-widgets-testimonial';
            $wp_customize->get_control( 'homepage_testimonial_section_note' )->priority  = -7;
        }
    }
    /** Testimonial Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_testimonial' );