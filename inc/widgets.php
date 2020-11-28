<?php
/**
 * JobScout Pro Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package JobScout_Pro
 */

function jobscout_pro_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'jobscout-pro' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'jobscout-pro' ),
        ),
        'cta' => array(
            'name'        => __( 'Call To Action Section', 'jobscout-pro' ),
            'id'          => 'cta', 
            'description' => __( 'Add "Rara: Call To Action" widget for Call to Action section.', 'jobscout-pro' ),
        ),
        'testimonial' => array(
            'name'        => __( 'Testimonial Section', 'jobscout-pro' ),
            'id'          => 'testimonial', 
            'description' => __( 'Add "Rara: Testimonial" widget for testimonial section.', 'jobscout-pro' ),
        ),
        'client' => array(
            'name'        => __( 'Client Section', 'jobscout-pro' ),
            'id'          => 'client', 
            'description' => __( 'Add "Rara Client Logo" widget for client section.', 'jobscout-pro' ),
        ),
        'contact-template-left' => array(
            'name'        => __( 'Contact Template Left Section', 'jobscout-pro' ),
            'id'          => 'contact-template-left', 
            'description' => __( 'Add "Text" widget ( use shortcode ) to display contact form.', 'jobscout-pro' ),
        ),
        'contact-template-right' => array(
            'name'        => __( 'Contact Template Right Section', 'jobscout-pro' ),
            'id'          => 'contact-template-right', 
            'description' => __( 'Add "Custom HTML" widget for Google Map section, Add "Rara: Contact Widget" Widget for contact details and social links.', 'jobscout-pro' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'jobscout-pro' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'jobscout-pro' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'jobscout-pro' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'jobscout-pro' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'jobscout-pro' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'jobscout-pro' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'jobscout-pro' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'jobscout-pro' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
    
    /** Dynamic sidebars */
    $dynamic_sidebars = jobscout_pro_get_dynamic_sidebar();
    
    foreach( $dynamic_sidebars as $k => $v ){
        if( ! empty( $v ) ){
            register_sidebar( array(
                'name'          => esc_attr( $v ),
                'id'            => esc_attr( $k ),
                'description'   => '',
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
        }
    }

    if( is_wp_job_manager_activated() ){
        register_sidebar( array(
            'name'          => __( 'Job Sidebar', 'jobscout-pro' ),
            'id'            => 'job-sidebar',
            'description'   => __( 'Sidebar displaying only in job single page', 'jobscout-pro' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title" itemprop="name">',
            'after_title'   => '</h2>',
        ) );
    }
}
add_action( 'widgets_init', 'jobscout_pro_widgets_init' );