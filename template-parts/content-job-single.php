<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout_Pro
 */
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		/**
         * @hooked jobscout_get_single_job_title - 10
         * @hooked jobscout_pro_entry_content    - 15
        */
        do_action( 'jobscout_pro_before_single_job_content' );

        /**
         * @hooked jobscout_pro_get_single_job_footer - 10
        */
        do_action( 'jobscout_pro_single_job_footer' );
	?>
</article> <!-- #article -->