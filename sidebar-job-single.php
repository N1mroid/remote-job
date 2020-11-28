<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JobScout_Pro
 */

?>

<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
	<?php 
	
		/**
		 * @hooked jobscout_pro_get_single_job_additional_info - 15
		 */
		do_action( 'jobscout_pro_single_job_additional_info' ); 

		if( is_active_sidebar( 'job-sidebar' ) ){
			dynamic_sidebar( 'job-sidebar' ); 
		}
	?>
</aside><!-- #secondary -->
