<?php
/**
 * Social Sharing Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_sharing( $wp_customize ) {
	
    /** Social Sharing */
    $wp_customize->add_section(
        'social_sharing',
        array(
            'title'    => __( 'Social Sharing', 'jobscout-pro' ),
            'priority' => 25,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Sharing Buttons */
    $wp_customize->add_setting(
        'ed_social_sharing',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_social_sharing',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Enable Social Sharing Buttons', 'jobscout-pro' ),
                'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Enable Social Sharing Buttons */
    $wp_customize->add_setting(
        'ed_og_tags',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_og_tags',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Enable Open Graph Meta Tags', 'jobscout-pro' ),
                'description' => __( 'Disable this option if you\'re using Jetpack, Yoast or other plugin to maintain Open Graph meta tags.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Social Sharing Buttons */
    $wp_customize->add_setting(
		'social_share', 
		array(
			'default' => array( 'facebook', 'twitter', 'pinterest', 'linkedin' ),
			'sanitize_callback' => 'jobscout_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new JobScout_Pro_Sortable_Control(
			$wp_customize,
			'social_share',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Social Sharing Buttons', 'jobscout-pro' ),
				'description' => __( 'Sort or toggle social sharing buttons.', 'jobscout-pro' ),
				'choices'     => array(
            		'facebook'  => __( 'Facebook', 'jobscout-pro' ),
            		'twitter'   => __( 'Twitter', 'jobscout-pro' ),
            		'pinterest' => __( 'Pinterest', 'jobscout-pro' ),
                    'linkedin'  => __( 'Linkedin', 'jobscout-pro' ),            		
            		'email'     => __( 'Email', 'jobscout-pro' ),
            		'reddit'    => __( 'Reddit', 'jobscout-pro' ),
                    'tumblr'    => __( 'Tumblr', 'jobscout-pro' ),
                    'digg'      => __( 'Digg', 'jobscout-pro' ),
                    'weibo'     => __( 'Weibo', 'jobscout-pro' ),
                    'xing'      => __( 'Xing', 'jobscout-pro' ),
                    'vk'        => __( 'VK', 'jobscout-pro' ),
					'pocket'    => __( 'GetPocket', 'jobscout-pro' ), 
					'whatsapp'  => __( 'Whatsapp', 'jobscout-pro' ),
            		'telegram'  => __( 'Telegram', 'jobscout-pro' ),            
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_sharing' );