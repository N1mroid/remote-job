<?php
/**
 * Pagination Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_layout_pagination( $wp_customize ) {
    
    /** Pagination Settings */
    $wp_customize->add_section(
        'pagination_settings',
        array(
            'title'    => __( 'Pagination Settings', 'jobscout-pro' ),
            'priority' => 60,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Pagination Type */
    $wp_customize->add_setting( 
        'pagination_type', 
        array(
            'default'           => 'numbered',
            'sanitize_callback' => 'jobscout_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        'pagination_type',
        array(
            'type'    => 'radio',
            'section' => 'pagination_settings',
            'label'   => __( 'Pagination Type', 'jobscout-pro' ),
            'description' => __( 'Select pagination type.', 'jobscout-pro' ),
            'choices' => array(
				'default'         => __( 'Default (Next / Previous)', 'jobscout-pro' ),
                'numbered'        => __( 'Numbered (1 2 3 4...)', 'jobscout-pro' ),
                'load_more'       => __( 'AJAX (Load More Button)', 'jobscout-pro' ),
                'infinite_scroll' => __( 'AJAX (Auto Infinite Scroll)', 'jobscout-pro' ),
			)
        )
    );
    
    /** Load More Label */
    $wp_customize->add_setting(
        'load_more_label',
        array(
            'default'           => __( 'Load More Posts', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
	   'load_more_label',
		array(
			'section'         => 'pagination_settings',
			'label'	          => __( 'Load More Label', 'jobscout-pro' ),
			'type'            => 'text',
            'active_callback' => 'jobscout_pro_loading_ac' 
		)		
	);
    
    /** Loading Label */
    $wp_customize->add_setting(
        'loading_label',
        array(
            'default'           => __( 'Loading...', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
	   'loading_label',
		array(
			'section'         => 'pagination_settings',
			'label'	          => __( 'Loading Label', 'jobscout-pro' ),
			'type'            => 'text',
            'active_callback' => 'jobscout_pro_loading_ac' 
		)		
	);
    
    /** No more Label */
    $wp_customize->add_setting(
        'no_more_label',
        array(
            'default'           => __( 'No More Post', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
	   'no_more_label',
		array(
			'section'         => 'pagination_settings',
			'label'	          => __( 'No More Label', 'jobscout-pro' ),
			'type'            => 'text',
            'active_callback' => 'jobscout_pro_loading_ac' 
		)		
	);
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_layout_pagination' );