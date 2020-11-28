<?php
/**
 * One Page Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_onepage( $wp_customize ){
    
    /** Sort Front Page Section */
    $wp_customize->add_section(
        'one_page_settings',
        array(
            'title'    => __( 'One Page Settings', 'jobscout-pro' ),
            'priority' => 55,
            'panel'    => 'frontpage_settings',
        )
    );
    
    /** Blog Options */
    $wp_customize->add_setting(
        'ed_one_page',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control(
            $wp_customize,
            'ed_one_page',
            array(
                'label'       => __( 'Enable Section Menu', 'jobscout-pro' ),
                'description' => __( 'Enable to make home page one page scrolling with section menu.', 'jobscout-pro' ),
                'section'     => 'one_page_settings',
            )            
        )
    );
    
    /** Blog Options */
    $wp_customize->add_setting(
        'ed_home_link',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control(
            $wp_customize,
            'ed_home_link',
            array(
                'label'           => __( 'Home Link', 'jobscout-pro' ),
                'description'     => __( 'Enable to display "Home" link in section menu.', 'jobscout-pro' ),
                'section'         => 'one_page_settings',
                'active_callback' => 'jobscout_pro_header_ac'
            )            
        )
    );
    
    /** Popular Section Menu Label  */
    $wp_customize->add_setting(
        'label_popular',
        array(
            'default'           => __( 'Popular', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_popular',
        array(
            'label'           => __( 'Popular Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );
    
    /** Top Jobs Section Menu Label  */
    $wp_customize->add_setting(
        'label_jobs',
        array(
            'default'           => __( 'Jobs', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_jobs',
        array(
            'label'           => __( 'Jobs Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );
    
    /** Steps Section Menu Label  */
    $wp_customize->add_setting(
        'label_steps',
        array(
            'default'           => __( 'Steps', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_steps',
        array(
            'label'           => __( 'Step Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );
    
    /** CTA Section Menu Label  */
    $wp_customize->add_setting(
        'label_cta',
        array(
            'default'           => __( 'CTA', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cta',
        array(
            'label'           => __( 'CTA Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );
    
    /** Blog Section Menu Label  */
    $wp_customize->add_setting(
        'label_blog',
        array(
            'default'           => __( 'Blog', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_blog',
        array(
            'label'           => __( 'Blog Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );

    /** Testimonial Section Menu Label  */
    $wp_customize->add_setting(
        'label_testimonial',
        array(
            'default'           => __( 'Testimonial', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_testimonial',
        array(
            'label'           => __( 'Testimonial Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );

    /** Client Section Menu Label  */
    $wp_customize->add_setting(
        'label_client',
        array(
            'default'           => __( 'Client', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_client',
        array(
            'label'           => __( 'Client Section Menu Label', 'jobscout-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'jobscout-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_header_ac'
        )
    );
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_onepage' );