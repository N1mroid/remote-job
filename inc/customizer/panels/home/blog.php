<?php
/**
 * Blog Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_blog( $wp_customize ){

    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'jobscout-pro' ),
            'priority' => 35,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Latest Articles', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Title', 'jobscout-pro' ),
            'type'    => 'text',
        )
    );

    /** Selective refresh for blog title. */
    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector'            => '.article-section .container h2.section-title',
        'render_callback'     => 'jobscout_pro_get_blog_section_title',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'We&rsquo;ll help you find it. We&rsquo;re your first step to becoming everything you want to be.', 'jobscout-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Description', 'jobscout-pro' ),
            'type'    => 'textarea',
        )
    ); 

    /** Selective refresh for blog description. */
    $wp_customize->selective_refresh->add_partial( 'blog_section_subtitle', array(
        'selector'            => '.article-section .container .section-desc',
        'render_callback'     => 'jobscout_pro_get_blog_section_description',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );
    
    
    /** View All Label */
    $wp_customize->add_setting(
        'blog_view_all',
        array(
            'default'           => __( 'Browse All', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_view_all',
        array(
            'label'           => __( 'View All Label', 'jobscout-pro' ),
            'section'         => 'blog_section',
            'type'            => 'text',
            'active_callback' => 'jobscout_pro_blog_view_all_ac'
        )
    );
    
   $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
        'selector'            => '.article-section .btn-wrap .btn',
        'render_callback'     => 'jobscout_get_blog_view_all_btn',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) ); 
    /** Blog Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_blog' );