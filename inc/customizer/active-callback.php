<?php
/**
 * Active Callback
 * 
 * @package JobScout_Pro
*/

/**
 * Active Callback
*/
function jobscout_pro_header_ac( $control ){
    
    $ed_one_page = $control->manager->get_setting( 'ed_one_page' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'ed_home_link' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_popular' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_jobs' && $ed_one_page == true ) return true;   
    if ( $control_id == 'label_steps' && $ed_one_page == true ) return true;
    if ( $control_id == 'label_blog' && $ed_one_page == true ) return true;   
    if ( $control_id == 'label_testimonial' && $ed_one_page == true ) return true;
    if ( $control_id == 'label_client' && $ed_one_page == true ) return true;
    
    return false;
}


/**
 * Active Callback for signin / signout url
*/
function jobscout_pro_header_signin_signout_ac( $control ){
    
    $ed_signin_signout = $control->manager->get_setting( 'ed_header_signin_signout' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_signin_signout_url' && $ed_signin_signout == true ) return true; 
    
    return false;
}

/**
 * Active Callback for Banner Slider
*/
function jobscout_pro_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
    if ( $control_id == 'header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
    if ( $control_id == 'external_header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' ) ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
       
    return false;
}

/**
 * Active Callback for homepage popular section
*/
function jobscout_pro_homepage_popular_section_ac( $control ){

    $ed_job_type        = get_option( 'job_manager_enable_types' );                                
    $ed_job_category    = get_option( 'job_manager_enable_categories' ); 
    $ed_popular_options = $control->manager->get_setting( 'ed_popular_options' )->value();
    $control_id         = $control->id;
    
    if( $control_id == 'popular_job_types' && 'job_type' == $ed_popular_options && $ed_job_type ) return true;
    if( $control_id == 'popular_job_type_note' && 'job_type' == $ed_popular_options && ! $ed_job_type ) return true;
    if( $control_id == 'popular_job_categories' && 'job_category' == $ed_popular_options && $ed_job_category ) return true;
    if( $control_id == 'popular_job_category_note' && 'job_category' == $ed_popular_options && ! $ed_job_category ) return true;
    
    return false;
}


/**
 * Active Callback for homepage testimonial section
*/
function jobscout_pro_homepage_testimonial_section_active_cb( $control ){

    $ed_bg_control = $control->manager->get_setting( 'testimonial_section_bg_control' )->value();
    $control_id    = $control->id;
    
    if( $control_id == 'testimonial_section_bg_image' && 'bg_image' == $ed_bg_control ) return true;
    if( $control_id == 'testimonial_section_bg_color' && 'bg_color' == $ed_bg_control ) return true;
    
    return false;
}

/**
 * Active Callback for Blog View All Button
*/
function jobscout_pro_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}

/**
 * Active Callback for Body Background
*/
function jobscout_pro_body_bg_choice( $control ){
    
    $body_bg    = $control->manager->get_setting( 'body_bg' )->value();
    $control_id = $control->id;
         
    if ( $control_id == 'background_image' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_preset' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_position' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_size' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_repeat' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_attachment' && $body_bg == 'image' ) return true;
    if ( $control_id == 'bg_pattern' && $body_bg == 'pattern' ) return true;
    
    return false;
}


/**
 * Active Callback for post/page
*/
function jobscout_pro_post_page_ac( $control ){
    
    $ed_author         = $control->manager->get_setting( 'ed_author' )->value();
    $ed_related        = $control->manager->get_setting( 'ed_related' )->value();
    $ed_popular        = $control->manager->get_setting( 'ed_popular' )->value();
    $ed_featured_image = $control->manager->get_setting( 'ed_featured_image' )->value();
    $control_id        = $control->id;
    
    if ( $control_id == 'author_title' && $ed_author == false ) return true;
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    if ( $control_id == 'related_taxonomy' && $ed_related == true ) return true;
    if ( $control_id == 'ed_crop_single_post_image' && $ed_featured_image ) return true;
    
    return false;
}

/**
 * Active Callback for job single page
*/
function jobscout_pro_job_single_page_ac( $control ){
    
    $ed_job_related = $control->manager->get_setting( 'ed_job_related' )->value();
    $job_taxonomy   = $control->manager->get_setting( 'related_job_taxonomy' )->value();
    $control_id     = $control->id;
    
    if ( $control_id == 'related_job_title' && $ed_job_related == true ) return true;
    if ( $control_id == 'related_job_taxonomy' && $ed_job_related == true ) return true;
    if ( $control_id == 'single_job_type_note' && $ed_job_related == true && 'job_type' == $job_taxonomy ) return true;
    if ( $control_id == 'single_job_category_note' && $ed_job_related == true && 'job_category' == $job_taxonomy ) return true;
    
    return false;
}

/**
 * Active Callback for 404 page
*/
function jobscout_pro_job_404_page_ac( $control ){
    
    $ed_404_section = $control->manager->get_setting( 'ed_404_latest' )->value();
    $control_option = $control->manager->get_setting( 'buttonset_404_latest' )->value();
    $control_id     = $control->id;
    
    if ( $control_id == 'buttonset_404_latest' && $ed_404_section ) return true;
    if ( $control_id == 'page_404_latest_jobs_title' && $ed_404_section && 'latest_jobs' == $control_option ) return true;
    if ( $control_id == 'page_404_latest_post_title' && $ed_404_section && 'latest_posts' == $control_option ) return true;
    if ( $control_id == 'plugin_notice_404_page' && $ed_404_section && 'latest_jobs' == $control_option ) return true;
    
    return false;
}

/**
 * Active Callback for pagination
*/
function jobscout_pro_loading_ac( $control ){
    
    $pagination_type = $control->manager->get_setting( 'pagination_type' )->value();
    
    if ( $pagination_type == 'load_more' ) return true;
    
    return false;
}

/**
 * Active Callback for Shop page description
*/
function jobscout_pro_shop_description_ac( $control ){
    $ed_shop_archive_desc = $control->manager->get_setting( 'ed_shop_archive_description' )->value();
    $control_id = $control->id;
    
    if( $control_id == 'shop_archive_description' && $ed_shop_archive_desc == true && is_woocommerce_activated() ) return true;
    
    return false;
}

/**
 * Active Callback for Job listing sort
*/
function jobscout_pro_sorting_option_ac( $control ){
    $orderby    = $control->manager->get_setting( 'job_posting_orderby' )->value();
    $sortby     = array( 'ID', 'name', 'date', 'modified' );
    $control_id = $control->id;
    
    if( $control_id == 'job_posting_sortby' && in_array( $orderby, $sortby ) ) return true;
    
    return false;
}
/**
 * Active Callback for Breadcrumbs
*/
function jobscout_pro_breacrumbs_active_callback( $control ){
    $ed_breadcrumb    = $control->manager->get_setting( 'ed_breadcrumb' )->value();
    $control_id = $control->id;
    
    if( $control_id == 'home_text' && $ed_breadcrumb ) return true;
    
    return false;
}

