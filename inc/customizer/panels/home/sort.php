<?php
/**
 * Sort front Page Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_sort( $wp_customize ){
    
    /** Sort Front Page Section */
    $wp_customize->add_section(
        'sort_front_page_settings',
        array(
            'title'    => __( 'Sort Front Page Section', 'jobscout-pro' ),
            'priority' => 50,
            'panel'    => 'frontpage_settings',
        )
    );
    
    /** Sort Front Page Section Section */
    $wp_customize->add_setting(
		'front_sort', 
		array(
			'default' => array( 'popular', 'job-posting', 'step', 'cta', 'blog', 'testimonial', 'client' ),
			'sanitize_callback' => 'jobscout_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Sortable_Control(
			$wp_customize,
			'front_sort',
			array(
				'section'     => 'sort_front_page_settings',
				'label'       => __( 'Sort Sections', 'jobscout-pro' ),
				'description' => __( 'Sort or toggle front page sections.', 'jobscout-pro' ),
				'choices'     => array(
					'popular'     => __( 'Popular Section', 'jobscout-pro' ),
					'job-posting' => __( 'Job Posting Section', 'jobscout-pro' ),
					'step'        => __( 'Step Section', 'jobscout-pro' ),
					'cta'         => __( 'Call To Action Section', 'jobscout-pro' ),
					'blog'        => __( 'Blog Section', 'jobscout-pro' ),
					'testimonial' => __( 'Testimonial Section', 'jobscout-pro' ),
					'client'      => __( 'Client Section', 'jobscout-pro' ),
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_sort' );