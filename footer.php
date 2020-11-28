<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JobScout_Pro
 */
    
    /**
     * After Content
     * 
     * @hooked jobscout_pro_content_end - 20
    */
    do_action( 'jobscout_pro_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked jobscout_pro_footer_start  - 20
     * @hooked jobscout_pro_footer_top    - 30
     * @hooked jobscout_pro_footer_bottom - 40
     * @hooked jobscout_pro_footer_end    - 50
    */
    do_action( 'jobscout_pro_footer' );
    
    /**
     * After Footer
     * 
     * @hooked jobscout_pro_back_to_top - 15
     * @hooked jobscout_pro_page_end    - 20
    */
    do_action( 'jobscout_pro_after_footer' );

    wp_footer(); ?>

</body>
</html>
