<?php
/**
 * Post Page Settings
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_general_post_page( $wp_customize ) {
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'jobscout-pro' ),
            'priority' => 35,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_prefix_archive',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Prefix in Archive Page', 'jobscout-pro' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'jobscout-pro' ),
			)
		)
	);

    /** Archive Page Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_archive_page_image', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_crop_archive_page_image',
            array(
                'section'         => 'post_page_settings',
                'label'           => __( 'Blog Post Image Crop', 'jobscout-pro' ),
                'description'     => __( 'Enable to avoid automatic cropping of featured image in blog section of homepage and archive page.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'jobscout-pro' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 25,
            'sanitize_callback' => 'jobscout_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'jobscout-pro' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'jobscout-pro' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				)                 
			)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'Read More', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'jobscout-pro' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'jobscout_pro_get_read_more',
    ) );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'jobscout-pro' ), '<hr/>' ),
			)
		)
    );

    /** Single like */
    $wp_customize->add_setting(
        'ed_single_like',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_single_like',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Like Button In Single', 'jobscout-pro' ),
                'description' => __( 'Enable to show like button in Single Post/Page.', 'jobscout-pro' ),
            )
        )
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'jobscout-pro' ),
                'description' => __( 'Enable to hide author section.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Author Section title */
    $wp_customize->add_setting(
        'author_title',
        array(
            'default'           => __( 'About Author', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'author_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Author Section Title', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'author_title', array(
        'selector' => '.author-section .title',
        'render_callback' => 'jobscout_pro_get_author_title',
    ) );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'jobscout-pro' ),
                'description' => __( 'Enable to show related posts in single page.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'Related Articles', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'jobscout-pro' ),
            'active_callback' => 'jobscout_pro_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .title',
        'render_callback' => 'jobscout_pro_get_related_title',
    ) );
    
    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 
        'related_taxonomy', 
        array(
            'default'           => 'cat',
            'sanitize_callback' => 'jobscout_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Radio_Buttonset_Control(
			$wp_customize,
			'related_taxonomy',
			array(
				'section'	  => 'post_page_settings',
				'label'       => __( 'Related Post Taxonomy', 'jobscout-pro' ),
                'description' => __( 'Choose Categories/Tags to display related post based on in Single Post.', 'jobscout-pro' ),
				'choices'	  => array(
					'cat'   => __( 'Category', 'jobscout-pro' ),
                    'tag'   => __( 'Tags', 'jobscout-pro' ),
				),
                'active_callback' => 'jobscout_pro_post_page_ac'
			)
		)
	);
    
    /** Show Popular Posts */
    $wp_customize->add_setting( 
        'ed_popular', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_popular',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Popular Posts', 'jobscout-pro' ),
                'description' => __( 'Enable to show popular posts in single page. Popular posts are based on comment count.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Comments', 'jobscout-pro' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'jobscout-pro' ),
                'description' => __( 'Enable to hide category.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_post_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Post Author', 'jobscout-pro' ),
                'description' => __( 'Enable to hide post author.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'jobscout-pro' ),
                'description' => __( 'Enable to hide posted date.', 'jobscout-pro' ),
			)
		)
	);
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new JobScout_Pro_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'         => 'post_page_settings',
				'label'	          => __( 'Show Featured Image', 'jobscout-pro' ),
                'description'     => __( 'Enable to show featured image in post detail (single post).', 'jobscout-pro' ),
			)
		)
	);

    /** Single Post Featured Image Crop */
    $wp_customize->add_setting( 
        'ed_crop_single_post_image', 
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Toggle_Control( 
            $wp_customize,
            'ed_crop_single_post_image',
            array(
                'section'         => 'post_page_settings',
                'label'           => __( 'Single Post Image Crop', 'jobscout-pro' ),
                'description'     => __( 'Enable to avoid automatic cropping of featured image in single post.', 'jobscout-pro' ),
                'active_callback' => 'jobscout_pro_post_page_ac'
            )
        )
    );
    /** Posts(Blog) & Pages Settings Ends */
    
}
add_action( 'customize_register', 'jobscout_pro_customize_register_general_post_page' );