<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package JobScout_Pro
 */

get_header(); ?>

	<section id="primary" class="content-area">
		
        <?php 
        /**
         * Before Posts hook
        */
        do_action( 'jobscout_pro_before_posts_content' );
        ?>
        
        <main id="main" class="site-main">

		<?php
		if ( have_posts() ) : 
        
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;
	        /**
	         * After Posts hook
	         * @hooked jobscout_navigation - 15
	        */
	        do_action( 'jobscout_after_posts_content' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
        
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
