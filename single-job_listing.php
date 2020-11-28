<?php
/**
 * The template for displaying all single job posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package JobScout Pro
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();
		        get_template_part( 'template-parts/content', 'job-single' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	    
	    <?php
	    /**
	     * @hooked jobscout_pro_related_jobs - 15
	     */
	     do_action( 'jobscout_pro_after_single_job_content' );
	    ?>
	</div><!-- #primary -->

<?php 
get_sidebar( 'job-single' );
get_footer();