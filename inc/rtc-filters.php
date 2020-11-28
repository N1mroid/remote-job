<?php
/**
 * Filter to modify functionality of RTC plugin.
 *
 * @package JobScout Pro
 */

if( ! function_exists( 'jobscout_pro_cta_section_bgcolor_filter' ) ){
	/**
	 * Filter to add bg color of cta section widget
	 */    
	function jobscout_pro_cta_section_bgcolor_filter(){
		return '#2ace5e';
	}
}
add_filter( 'rrtc_cta_bg_color', 'jobscout_pro_cta_section_bgcolor_filter' );

if( ! function_exists( 'jobscout_pro_cta_btn_alignment_filter' ) ){
	/**
	 * Filter to add btn alignment of cta section widget
	 */    
	function jobscout_pro_cta_btn_alignment_filter(){
		return 'centered';
	}
}
add_filter( 'rrtc_cta_btn_alignment', 'jobscout_pro_cta_btn_alignment_filter' );

if( ! function_exists( 'jobscout_pro_theme_slug' ) ){
	/**
	 * Filter to add theme slug
	 */    
	function jobscout_pro_theme_slug(){
		return 'jobscout-pro';
	}
}
add_filter( 'theme_slug', 'jobscout_pro_theme_slug' );
