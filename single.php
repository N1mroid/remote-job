<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package JobScout_Pro
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'single' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
        
        <?php
        /**
         * @hooked jobscout_pro_navigation           - 15
         * @hooked jobscout_pro_get_ad_after_content - 20  
         * @hooked jobscout_pro_author               - 25
         * @hooked jobscout_pro_newsletter           - 30
         * @hooked jobscout_pro_related_posts        - 35
         * @hooked jobscout_pro_comment              - 45
        */
        do_action( 'jobscout_pro_after_post_content' );
        ?>
        
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
