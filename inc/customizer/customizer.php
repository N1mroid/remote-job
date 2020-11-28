<?php
/**
 * JobScout Pro Theme Customizer
 *
 * @package JobScout_Pro
 */

/**
 * Requiring customizer panels & sections
*/
$jobscout_pro_panels       = array( 'appearance', 'layout', 'typography', 'home', 'contact', 'general' );
$jobscout_pro_sections     = array( 'info','site', 'footer' );
$jobscout_pro_sub_sections = array(
    'appearance' => array( 'background', 'color' ),
    'layout'     => array( 'general', 'pagination' ),
    'typography' => array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
    'home'       => array( 'banner','popular', 'job-posting', 'step', 'cta', 'blog', 'testimonial', 'client', 'sort', 'onepage' ),
    'general'    => array( 'performance', 'sidebar', 'header', 'share', 'seo', 'post-page', 'job-single', '404-page', 'newsletter', 'misc', 'google-analytics' ),    
);

foreach( $jobscout_pro_sections as $s ){
    require get_template_directory() . '/inc/customizer/sections/' . $s . '.php';
}

foreach( $jobscout_pro_panels as $p ){
   require get_template_directory() . '/inc/customizer/panels/' . $p . '.php';
}

foreach( $jobscout_pro_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require get_template_directory() . '/inc/customizer/panels/' . $k . '/' . $w . '.php';
    }
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jobscout_pro_customize_preview_js() {
	wp_enqueue_script( 'jobscout-pro-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), JOBSCOUT_PRO_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'jobscout_pro_customize_preview_js' );

function jobscout_pro_customize_script(){
    $array = array(
        'home'    => get_home_url(),
        'about'   => jobscout_pro_get_page_template_url( 'templates/about.php' ),
        'service' => jobscout_pro_get_page_template_url( 'templates/service.php' ),
        'contact' => jobscout_pro_get_page_template_url( 'templates/contact.php' ),
    );
    wp_enqueue_style( 'jobscout-pro-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), JOBSCOUT_PRO_THEME_VERSION );
    wp_enqueue_script( 'jobscout-pro-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), JOBSCOUT_PRO_THEME_VERSION, true );
    wp_localize_script( 'jobscout-pro-customize', 'jobscout_pro_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'jobscout_pro_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'raratheme-companion' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'jobscout-pro' ), '<strong>RaraTheme Companion</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'jobscout-pro' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'jobscout-pro' ),
	'activate_button_label'     => esc_html__( 'Activate', 'jobscout-pro' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'jobscout-pro' ),
);
JobScout_Pro_Customizer_Notice::init( apply_filters( 'jobscout_pro_customizer_notice_array', $config_customizer ) );