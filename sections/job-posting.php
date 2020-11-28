<?php
/**
 * Job Posting Section
 * 
 * @package JobScout_Pro
 */

$title   = get_theme_mod( 'job_posting_section_title', __( 'Job Posting', 'jobscout-pro' ) );
$orderby = get_theme_mod( 'job_posting_orderby', 'featured' );
$order   = get_theme_mod( 'job_posting_sortby', 'desc' );
$sortby  = array( 'ID', 'name', 'date', 'modified' );

$shortcode_attr = ' show_filters="false" post_status="publish"';

if( $orderby ){
    $shortcode_attr .= ' orderby="'. esc_attr( $orderby ).'"';
}

if( $order && in_array( $order, $sortby ) ){
    $shortcode_attr .= ' order="'. esc_attr( $order ).'"';
}

$shortcode_attr = apply_filters( 'jobscout_pro_job_posting', $shortcode_attr );

if ( is_wp_job_manager_activated() || $title ) {
    $count_posts = wp_count_posts('job_listing'); 
    ?>
    <section id="job-posting-section" class="top-job-section">
        <div class="container">
            <?php 
                if( $title ) echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>'; 

                if( is_wp_job_manager_activated() && $count_posts->publish != 0 ){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo do_shortcode('[jobs'. $shortcode_attr .']'); ?>
                        </div>
                    </div>
                <?php } 
            ?>
        </div>
    </section>
    <?php
}