<?php
/**
 * JobScout Pro Dynamic Styles
 * 
 * @package JobScout_Pro
*/

function jobscout_pro_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Nunito Sans' );
    $primary_fonts   = jobscout_pro_get_fonts( $primary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Nunito Sans', 'variant'=>'700' ) );
    $site_title_fonts     = jobscout_pro_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 120 );
    
    $h1_font      = get_theme_mod( 'h1_font', array( 'font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h1_fonts     = jobscout_pro_get_fonts( $h1_font['font-family'], $h1_font['variant'] );
    $h1_font_size = get_theme_mod( 'h1_font_size', 39 );
    
    $h2_font      = get_theme_mod( 'h2_font', array('font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h2_fonts     = jobscout_pro_get_fonts( $h2_font['font-family'], $h2_font['variant'] );
    $h2_font_size = get_theme_mod( 'h2_font_size', 31 );
    
    $h3_font      = get_theme_mod( 'h3_font', array('font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h3_fonts     = jobscout_pro_get_fonts( $h3_font['font-family'], $h3_font['variant'] );
    $h3_font_size = get_theme_mod( 'h3_font_size', 25 );
    
    $h4_font      = get_theme_mod( 'h4_font', array('font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h4_fonts     = jobscout_pro_get_fonts( $h4_font['font-family'], $h4_font['variant'] );
    $h4_font_size = get_theme_mod( 'h4_font_size', 20 );
    
    $h5_font      = get_theme_mod( 'h5_font', array('font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h5_fonts     = jobscout_pro_get_fonts( $h5_font['font-family'], $h5_font['variant'] );
    $h5_font_size = get_theme_mod( 'h5_font_size', 16 );
    
    $h6_font      = get_theme_mod( 'h6_font', array('font-family'=>'Nunito Sans', 'variant'=>'700') );
    $h6_fonts     = jobscout_pro_get_fonts( $h6_font['font-family'], $h6_font['variant'] );
    $h6_font_size = get_theme_mod( 'h6_font_size', 14 );
    
    $primary_color    = get_theme_mod( 'primary_color', '#2ace5e' );
    $site_title_color = get_theme_mod( 'site_title_color', '#2ace5e' );
    $btn_bg_color     = get_theme_mod( 'btn_bg_color', '#111111' );
    $footer_bg_color  = get_theme_mod( 'footer_bg_color', '#111111' );
    $body_bg          = get_theme_mod( 'body_bg', 'image' );
    $bg_pattern       = get_theme_mod( 'bg_pattern', 'nobg' );
    
    $rgb = jobscout_pro_hex2rgb( jobscout_pro_sanitize_hex_color( $primary_color ) );
    
    $image = '';
    
    if( $body_bg == 'pattern' && $bg_pattern != 'nobg' ){
        $image = get_template_directory_uri() . '/images/patterns/' . $bg_pattern . '.png';
    }
     
    echo "<style type='text/css' media='all'>"; ?>
     
    .content-newsletter .blossomthemes-email-newsletter-wrapper.bg-img:after,
    .widget_blossomthemes_email_newsletter_widget .blossomthemes-email-newsletter-wrapper:after{
        <?php echo 'background: rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.8);'; ?>
    }
    
    /*Typography*/

    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }
    
    <?php 
    if( $body_bg == 'pattern' && $bg_pattern != 'nobg' ){ ?>
        body.custom-background {
            background-image: url(<?php echo esc_url( $image ); ?>);
        }
        <?php 
    } 
    ?>
    
    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-title a{
		color: <?php echo jobscout_pro_sanitize_hex_color( $site_title_color ); ?>;
	}
    
    #primary .post .entry-content h1,
    #primary .page .entry-content h1{
        font-family: <?php echo esc_html( $h1_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h1_font_size ); ?>px;        
    }
    
    #primary .post .entry-content h2,
    #primary .page .entry-content h2{
        font-family: <?php echo esc_html( $h2_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h2_font_size ); ?>px;
    }
    
    #primary .post .entry-content h3,
    #primary .page .entry-content h3{
        font-family: <?php echo esc_html( $h3_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h3_font_size ); ?>px;
    }
    
    #primary .post .entry-content h4,
    #primary .page .entry-content h4{
        font-family: <?php echo esc_html( $h4_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h4_font_size ); ?>px;
    }
    
    #primary .post .entry-content h5,
    #primary .page .entry-content h5{
        font-family: <?php echo esc_html( $h5_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h5_font_size ); ?>px;
    }
    
    #primary .post .entry-content h6,
    #primary .page .entry-content h6{
        font-family: <?php echo esc_html( $h6_fonts['font'] ); ?>;
        font-size: <?php echo absint( $h6_font_size ); ?>px;
    }
    
    /*Color Scheme*/
    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"], 
    a.btn, 
    .navigation.pagination .page-numbers:not(.dots):hover, 
    .navigation.pagination .page-numbers.current:not(.dots), 
    .posts-navigation .nav-links a:hover, 
    #load-posts a.loading, 
    #load-posts a:hover, 
    #load-posts a.disabled, 
    .top-job-section div.job_listings .load_more_jobs, 
    #back-to-top span:hover, 
    .page-template-contact .widget_rtc_contact_social_links .social-networks li a:hover, 
    .single-job .site-main .entry-footer .job-print a:hover, 
    .job-location .job-loc-map a, 
    .job-overview .overview-wrap a.btn + a.btn:hover, 
    .widget_raratheme_companion_cta_widget a.btn-cta, 
    a.btn-readmore, .tagcloud a:hover, 
    .widget_rtc_social_links ul li.rtc-social-icon-wrap a:hover, 
    .site-footer .widget_rtc_social_links ul li.rtc-social-icon-wrap a:hover, 
    .widget_rrtc_description_widget .social-profile li a:hover, 
    .widget_calendar table caption, 
    div.job_listings .load_more_jobs, 
    .header-main .main-navigation .toggle-btn:hover .toggle-bar, 
    .step-block .step-count, 
    .widget_rrtc_icon_text_widget .icon-holder {
        background: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    form.search-form input.search-submit, 
    .blossomthemes-email-newsletter-wrapper form label input[type="checkbox"]:checked + .check-mark {
        background-color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .step-wrap .step-block:after {
        <?php echo 'background: rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.1);'; ?>
    }

    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"], 
    a.btn, 
    .navigation.pagination .page-numbers:not(.dots):hover, 
    .navigation.pagination .page-numbers.current:not(.dots), 
    .posts-navigation .nav-links a:hover, 
    #load-posts a.loading, 
    #load-posts a:hover, 
    #load-posts a.disabled, 
    .top-job-section div.job_listings .load_more_jobs, 
    .single-job_listing .site-main article .entry-header .btn, 
    .single-job .site-content .job-title-wrap .job-type .btn, 
    .widget_raratheme_companion_cta_widget a.btn-cta, 
    .blossomthemes-email-newsletter-wrapper form label input[type="checkbox"]:checked + .check-mark, 
    div.job_listings .load_more_jobs {
        border-color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    div.job_listings .load_more_jobs:hover, 
    div.job_listings .load_more_jobs:focus {
        border-bottom-color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    a, button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover, 
    a.btn:hover, 
    .entry-meta > span a:hover, 
    .entry-title a:hover, 
    .widget-area .widget ul li a:hover, 
    .site-footer .widget ul li a:hover, 
    .post-navigation .nav-links a:hover, 
    .comment-body b.fn a:hover, 
    .bypostauthor > .comment-body b.fn, 
    .comment-body .comment-metadata a:hover, 
    .comment-body .reply a.comment-reply-link:hover, 
    .comment-respond .comment-reply-title a:hover, 
    .author-content ul.social-list li a:hover, 
    .site-header .header-t a:hover, 
    .secondary-nav ul li:hover > a, 
    .secondary-nav ul li.current-menu-item > a, 
    .secondary-nav ul li.current_page_item > a, 
    .secondary-nav ul li.current-menu-ancestor > a, 
    .secondary-nav ul li.current_page_ancestor > a, 
    .site-branding .site-title a, 
    .main-navigation ul li:hover > a, 
    .main-navigation ul li.current-menu-item > a, 
    .main-navigation ul li.current_page_item > a, 
    .main-navigation ul li.current-menu-ancestor > a, 
    .main-navigation ul li.current_page_ancestor > a, 
    .top-job-section .row div.job_listings article .salary-amt .currency, 
    .top-job-section .row div.job_listings article .company-address svg, 
    .top-job-section .row div.job_listings article .entry-meta a:hover,  
    .top-job-section div.job_listings .load_more_jobs:hover, 
    .footer-b a:hover, 
    .page-template-contact .site-main .contact-info ul.contact-list li a:hover, 
    .single .site-main footer.entry-footer a:hover, 
    .single-job_listing .site-main article .entry-header .btn, 
    .single-job .site-content .job-title-wrap .job-type .btn, 
    .single-job .site-content .job-title-wrap .entry-meta > div .currency, 
    .single-job .site-content .job-title-wrap .entry-meta > div .fas, 
    .single-job .site-content .site-main .entry-content ul.job-listing-meta li a:hover, 
    .single-job .additional-posts .article-wrap .job-title-wrap .entry-meta svg, 
    .single-job .additional-posts .article-wrap .job-title-wrap .entry-title a:hover, 
    .job-overview .overview-wrap ul li svg, 
    .job-overview .overview-wrap a.btn + a.btn, 
    .widget_raratheme_companion_cta_widget a.btn-cta:hover, 
    .widget_rara_posts_category_slider_widget .carousel-title .title a:hover, 
    .widget-area .widget ul li .entry-meta > span a:hover, 
    .error404 .error-404 .error-num, 
    .site-main .entry-content div.job_listings div.job_listings article .entry-meta .salary-amt .currency, 
    .site-main .entry-content div.job_listings div.job_listings article .entry-meta .company-address svg, 
    .site-main .entry-content div.job_listings div.job_listings article .entry-meta a:hover, 
    div.job_listings .load_more_jobs:hover, 
    div.job_listings .load_more_jobs:focus, 
    #job-manager-job-dashboard table td a:hover {
        color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    a:hover path.fav, 
    .liked .fav {
        fill: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .liked .fav, 
    svg .c, a:hover path.fav {
        stroke: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
    }

    .banner-caption .jobscout_job_filters .search_jobs input[type="submit"]:hover {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path></svg>');
    }

    .top-job-section div.job_listings .load_more_jobs:hover::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>');
    }

    .single-job .site-content .site-main .entry-content ul.job-listing-meta li.job-type::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M320 336c0 8.84-7.16 16-16 16h-96c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h416c25.6 0 48-22.4 48-48V288H320v48zm144-208h-80V80c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h512v-80c0-25.6-22.4-48-48-48zm-144 0H192V96h128v32z"></path></svg>');
    }

    .single-job .site-content .site-main .entry-content ul.job-listing-meta li.location::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>');
    }

    .single-job .site-content .site-main .entry-content ul.job-listing-meta li.date-posted::before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>');
        top: 2px;
    }

    .single-job .site-content .site-main .entry-content ul li:before {
        background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="<?php echo jobscout_pro_hash_to_percent23( jobscout_pro_sanitize_hex_color( $primary_color ) ); ?>" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>');
    }
    .footer-t{
        background: <?php echo jobscout_pro_sanitize_hex_color( $footer_bg_color ); ?>;
    }

    @media screen and (max-width: 1024px) {
        .responsive-nav .close-btn:hover .bar, 
        .responsive-nav .right-block a.btn-link:hover {
            background: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .responsive-nav .secondary-nav ul li:hover > a, 
        .responsive-nav .secondary-nav ul li.current-menu-item > a, 
        .responsive-nav .secondary-nav ul li.current_page_item > a, 
        .responsive-nav .secondary-nav ul li.current-menu-ancestor > a, 
        .responsive-nav .secondary-nav ul li.current_page_ancestor > a {
            color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }
    }

    @media screen and (max-width: 767px) {
        .single .author-content ul.social-list li a:hover {
            color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }
    }
    
   <?php if( is_woocommerce_activated() ) { ?>
        .woocommerce ul.products li.product .price ins,
        .woocommerce div.product p.price ins,
        .woocommerce div.product span.price ins, 
        .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus, 
        .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover,
        .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:focus, 
        .woocommerce div.product .entry-summary .product_meta .posted_in a:hover,
         .woocommerce div.product .entry-summary .product_meta .posted_in a:focus,
         .woocommerce div.product .entry-summary .product_meta .tagged_as a:hover,
         .woocommerce div.product .entry-summary .product_meta .tagged_as a:focus, 
         .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.product-name a:focus, 
        .widget.woocommerce ul li a:hover, .woocommerce #secondary .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button:focus, 
        .widget.woocommerce ul li.cat-parent .cat-toggle:hover, 
        .woocommerce.widget .product_list_widget li .product-title:hover,
        .woocommerce.widget .product_list_widget li .product-title:focus, 
        .woocommerce.widget .product_list_widget li ins,
        .woocommerce.widget .product_list_widget li ins .amount, 
        .woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce div.product span.price ins,
        .woocommerce div.product .entry-summary .product_meta .posted_in a:hover, .woocommerce div.product .entry-summary .product_meta .posted_in a:focus, .woocommerce div.product .entry-summary .product_meta .tagged_as a:hover, .woocommerce div.product .entry-summary .product_meta .tagged_as a:focus, 
        .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:hover, .woocommerce div.product .entry-summary .woocommerce-product-rating .woocommerce-review-link:focus, 
        .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus {
            color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce ul.products li.product .added_to_cart:hover,
        .woocommerce ul.products li.product .added_to_cart:focus, 
        .woocommerce ul.products li.product .add_to_cart_button:hover,
         .woocommerce ul.products li.product .add_to_cart_button:focus,
         .woocommerce ul.products li.product .product_type_external:hover,
         .woocommerce ul.products li.product .product_type_external:focus,
         .woocommerce ul.products li.product .ajax_add_to_cart:hover,
         .woocommerce ul.products li.product .ajax_add_to_cart:focus, 
         .woocommerce ul.products li.product .button.loading,
        .woocommerce-page ul.products li.product .button.loading, 
        .woocommerce nav.woocommerce-pagination ul li span.current, 
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:hover,
        .woocommerce div.product .entry-summary .variations_form .single_variation_wrap .button:focus, 
        .woocommerce div.product form.cart .single_add_to_cart_button:hover,
         .woocommerce div.product form.cart .single_add_to_cart_button:focus,
         .woocommerce div.product .cart .single_add_to_cart_button.alt:hover,
         .woocommerce div.product .cart .single_add_to_cart_button.alt:focus, 
         .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:hover,
        .woocommerce-cart #primary .page .entry-content table.shop_table td.actions .coupon input[type="submit"]:focus, 
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:hover,
        .woocommerce-cart #primary .page .entry-content .cart_totals .checkout-button:focus, 
        .woocommerce-checkout .woocommerce .woocommerce-info, 
         .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:hover,
         .woocommerce-checkout .woocommerce form.woocommerce-form-login input.button:focus,
         .woocommerce-checkout .woocommerce form.checkout_coupon input.button:hover,
         .woocommerce-checkout .woocommerce form.checkout_coupon input.button:focus,
         .woocommerce form.lost_reset_password input.button:hover,
         .woocommerce form.lost_reset_password input.button:focus,
         .woocommerce .return-to-shop .button:hover,
         .woocommerce .return-to-shop .button:focus,
         .woocommerce #payment #place_order:hover,
         .woocommerce-page #payment #place_order:focus, 
         .woocommerce #respond input#submit:hover, 
         .woocommerce #respond input#submit:focus, 
         .woocommerce a.button:hover, 
         .woocommerce a.button:focus, 
         .woocommerce button.button:hover, 
         .woocommerce button.button:focus, 
         .woocommerce input.button:hover, 
         .woocommerce input.button:focus, 
         .woocommerce #secondary .widget_shopping_cart .buttons .button:hover,
        .woocommerce #secondary .widget_shopping_cart .buttons .button:focus, 
        .woocommerce #secondary .widget_price_filter .ui-slider .ui-slider-range, 
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button,  
        .woocommerce .woocommerce-message .button:hover,
        .woocommerce .woocommerce-message .button:focus, 
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover {
            background: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before, 
        .widget.widget_layered_nav_filters ul li.chosen a:before, 
        .woocommerce-product-search button[type="submit"]:hover {
            background-color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus, 
        .woocommerce nav.woocommerce-pagination ul li span.current, 
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a:hover:before, 
        .widget.widget_layered_nav_filters ul li a:hover:before, 
        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before, 
        .widget.widget_layered_nav_filters ul li.chosen a:before, 
        .woocommerce #secondary .widget_price_filter .ui-slider .ui-slider-handle, 
        .woocommerce #secondary .widget_price_filter .price_slider_amount .button {
            border-color: <?php echo jobscout_pro_sanitize_hex_color( $primary_color ); ?>;
        }

        .woocommerce div.product .product_title, 
        .woocommerce div.product .woocommerce-tabs .panel h2 {
            font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
         }

         .woocommerce.widget_shopping_cart ul li a, 
         .woocommerce.widget .product_list_widget li .product-title, 
         .woocommerce-order-details .woocommerce-order-details__title, 
        .woocommerce-order-received .woocommerce-column__title, 
        .woocommerce-customer-details .woocommerce-column__title {
            font-family : <?php echo esc_html( $secondary_fonts['font'] ); ?>;
        }
    <?php } ?>
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'jobscout_pro_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function jobscout_pro_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function jobscout_pro_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/**
 * Convert '#' to '%23'
*/
function jobscout_pro_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}