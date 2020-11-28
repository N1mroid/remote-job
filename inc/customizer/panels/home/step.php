<?php
/**
 * Steps Section
 *
 * @package JobScout_Pro
 */

function jobscout_pro_customize_register_frontpage_step( $wp_customize ){

    /** Steps Section */
    $wp_customize->add_section(
        'step_section',
        array(
            'title'    => __( 'Steps Section', 'jobscout-pro' ),
            'priority' => 25,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Steps title */
    $wp_customize->add_setting(
        'step_section_title',
        array(
            'default'           => __( 'How It Works', 'jobscout-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'step_section_title',
        array(
            'section' => 'step_section',
            'label'   => __( 'Steps Title', 'jobscout-pro' ),
            'type'    => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'step_section_title', array(
        'selector' => '.howitwork-section .container h2.section-title',
        'render_callback' => 'jobscout_pro_get_step_section_title',
    ) );

    /** Add Slides */
    $wp_customize->add_setting( 
        new JobScout_Pro_Repeater_Setting( 
            $wp_customize, 
            'step_section_steps', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'JobScout_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Pro_Control_Repeater(
            $wp_customize,
            'step_section_steps',
            array(
                'section' => 'step_section',                
                'label'   => __( 'Add Steps', 'jobscout-pro' ),
                'description'   => __( 'Add step by step process.', 'jobscout-pro' ),
                'fields'  => array(
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'jobscout-pro' ),
                    ),
                    'subtitle'   => array(
                        'type'  => 'textarea',
                        'label' => __( 'Subtitle', 'jobscout-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'Step', 'jobscout-pro' ),
                ),
                'choices' =>array( 'limit' => 4 )
                // 'active_callback' => 'jobscout_pro_banner_ac'                                              
            )
        )
    );
    /** Steps Section Ends */  

}
add_action( 'customize_register', 'jobscout_pro_customize_register_frontpage_step' );