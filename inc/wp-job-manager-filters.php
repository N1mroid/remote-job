<?php
/**
 * Filter to modify functionality of WP Job Manager plugin.
 *
 * @package JobScout Pro
 */

if( ! function_exists( 'jobscout_pro_wp_job_manager_google_map_filter' ) ){
	/**
	 * Filter to modify google map link
	 */    
	function jobscout_pro_wp_job_manager_google_map_filter(){
		global $post;
		$location = get_the_job_location( $post );
		return '<a class="google_map_link" target="_blank" href="' . esc_url( 'http://maps.google.com/maps?q=' . rawurlencode( wp_strip_all_tags( $location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ) . '">' . esc_html( wp_strip_all_tags( $location ) ) . '</a>';
	}
}
add_filter( 'the_job_location_map_link', 'jobscout_pro_wp_job_manager_google_map_filter' );

if( ! function_exists( 'job_board_pro_taxonomy_publicview_modified_filter' ) ){
	/**
	 * Filter to modify google map link
	 */    
	function job_board_pro_taxonomy_publicview_modified_filter( $public ) {
		$public['public'] = true;
		 return $public;
	}
}
add_filter( 'register_taxonomy_job_listing_type_args', 'job_board_pro_taxonomy_publicview_modified_filter' );
add_filter( 'register_taxonomy_job_listing_category_args', 'job_board_pro_taxonomy_publicview_modified_filter' );


function job_board_pro_posttype_excerpt_modified_filter( $support ){
	$support['supports'] = array( 'title', 'editor', 'custom-fields', 'publicize', 'thumbnail','excerpt' );
	return $support;
}
add_filter( 'register_post_type_job_listing','job_board_pro_posttype_excerpt_modified_filter');
