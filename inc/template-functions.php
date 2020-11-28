<?php
/**
 * JobScout Pro Template Functions which enhance the theme by hooking into WordPress
 *
 * @package JobScout_Pro
 */

if( ! function_exists( 'jobscout_pro_doctype' ) ) :
/**
 * Doctype Declaration
*/
function jobscout_pro_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'jobscout_pro_doctype', 'jobscout_pro_doctype' );

if( ! function_exists( 'jobscout_pro_head' ) ) :
/**
 * Before wp_head 
*/
function jobscout_pro_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'jobscout_pro_before_wp_head', 'jobscout_pro_head' );

if( ! function_exists( 'jobscout_pro_responsive_header' ) ) :
/**
 * Responsive Header
*/
function jobscout_pro_responsive_header(){ 
    $ed_login = get_theme_mod( 'ed_header_signin_signout', true );
    ?>
    <div class="responsive-nav">
        <div class="nav-top">
            <?php jobscout_pro_site_branding( true ); ?>
            <div class="close-btn">
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
        
            <?php 
            if ( $ed_login ) {
                echo '<div class="right-block">';
                if( is_user_logged_in() ){
                    echo '<a class="btn-link" href="'. esc_url( wp_logout_url( get_permalink() ) ) .'">'. esc_html__( 'Sign out', 'jobscout-pro' ) .'</a>';
                }else{
                    echo '<a class="btn-link" href="'. esc_url( wp_login_url( home_url() ) ) .'">'. esc_html__( 'Sign in', 'jobscout-pro' ) .'</a>';
                }
                echo '</div>';
            }
            
            jobscout_pro_secondary_navigation(); 
            jobscout_pro_primary_nagivation( true ); 
        ?>
    </div> <!-- .responsive-nav -->
    <?php
}
endif;
add_action( 'jobscout_pro_before_header', 'jobscout_pro_responsive_header', 15 );

if( ! function_exists( 'jobscout_pro_page_start' ) ) :
/**
 * Page Start
*/
function jobscout_pro_page_start(){ ?>
    <div id="page" class="site">
    <?php
}
endif;
add_action( 'jobscout_pro_before_header', 'jobscout_pro_page_start', 20 );

if( ! function_exists( 'jobscout_pro_header' ) ) :
/**
 * Header Start
*/
function jobscout_pro_header(){ 
    $sticky_header      = get_theme_mod( 'ed_sticky_header', false );
    $class              = $sticky_header ? ' sticky-header' : '';
    $ed_login           = get_theme_mod( 'ed_header_signin_signout', true );
    $login_template_url = get_theme_mod( 'header_signin_signout_url', '' );
    ?>

    <header id="masthead" class="site-header header-one<?php echo esc_attr( $class ); ?>" itemscope itemtype="https://schema.org/WPHeader">
        <div class="header-t">
            <div class="container">
                <div class="left-block">
                    <?php jobscout_pro_secondary_navigation(); ?>
                </div>
                
                <?php if( $ed_login ){ ?>
                    <div class="right-block">
                        <?php 
                            if( is_user_logged_in() ){
                                if( ! empty( $login_template_url ) && ( $login_template_url != get_home_url() ) ){
                                    echo '<a class="btn-link" href="'. esc_url( $login_template_url ) .'">'. esc_html__( 'Sign out', 'jobscout-pro' ) .'</a>';
                                }else{
                                    echo '<a class="btn-link" href="'. esc_url( wp_logout_url( get_permalink() ) ) .'">'. esc_html__( 'Sign out', 'jobscout-pro' ) .'</a>';
                                }

                            }else{
                                if( ! empty( $login_template_url ) && ( $login_template_url != get_home_url() ) ){
                                    echo '<a class="btn-link" href="'. esc_url( $login_template_url ) .'">'. esc_html__( 'Sign in', 'jobscout-pro' ) .'</a>';
                                }else{
                                    echo '<a class="btn-link" href="'. esc_url( wp_login_url( home_url() ) ) .'">'. esc_html__( 'Sign in', 'jobscout-pro' ) .'</a>';
                                }
                            }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div> <!-- .header-t -->
        <?php if( $sticky_header ) echo '<div class="sticky-blank"></div>'; ?>
        <div class="header-main">
            <div class="container">
                <?php 
                    jobscout_pro_site_branding( false );

                    echo '<div class="menu-wrap">';
                    jobscout_pro_primary_nagivation();
                    echo '</div><!-- .menu-wrap -->';
                ?>
            </div>
        </div> <!-- .header-main -->
    </header> <!-- .site-header -->
    <?php
}
endif;
add_action( 'jobscout_pro_header', 'jobscout_pro_header', 20 );

if( ! function_exists( 'jobscout_pro_breadcrumbs_bar' ) ) :
    /**
     * Breadcrumbs
    */
    function jobscout_pro_breadcrumbs_bar(){
        $ed_breadcrumb = get_theme_mod( 'ed_breadcrumb', true );
        if( ! is_front_page() && ! is_404() && $ed_breadcrumb ){ ?>
            <section class="breadcrumb-wrap">
                <div class="container">
                    <?php jobscout_pro_breadcrumb(); //Breadcrumb ?>
                </div>
            </section>   
            <?php 
        }    
    }
endif;
add_action( 'jobscout_pro_after_header', 'jobscout_pro_breadcrumbs_bar', 10 );


if( ! function_exists( 'jobscout_pro_content_start' ) ) :
/**
 * Content Start
 *  
*/
function jobscout_pro_content_start(){       
    $home_sections = jobscout_pro_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ //Make necessary adjust for pg template.
        echo is_404() ? '<div class="error-holder">' : '<div id="content" class="site-content">'; 

        if( is_archive() || is_search() || is_page_template( array( 'templates/contact.php', 'templates/portfolio.php' ) ) ) : ?>
            <header class="page-header">
                <div class="container">
                    <?php
                        if( is_archive() ){ 
                            if( is_author() ) { 
                                $author_title = get_the_author(); ?>
                                <div class="author-bio">
                                    <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></figure>
                                    <div class="author-content">
                                        <?php 
                                            echo '<span class="sub-title">' . esc_html__( 'All Posts by', 'jobscout-pro' ) . '</span>';
                                            if( $author_title ) echo '<h1 class="author-title">' . esc_html( $author_title ) . '</h3>';
                                            jobscout_pro_author_social();
                                        ?>      
                                    </div>
                                </div>
                            <?php }else{
                                the_archive_title();
                                the_archive_description( '<div class="archive-description">', '</div>' );             
                            }
                        }
                        
                        if( is_search() ){ 
                            echo '<h1 class="page-title">' . esc_html__( 'Search', 'jobscout-pro' ) . '</h1>';
                            get_search_form();
                        }

                        if( ! is_author() && ! is_search() ){
                            jobscout_pro_posts_per_page_count();
                        }

                        if( is_page_template( array( 'templates/contact.php', 'templates/portfolio.php' ) ) ){
                            global $post;
                            echo '<h1 class="page-title">' . esc_html( get_the_title( $post->ID ), 'jobscout-pro' ) . '</h1>';
                            if( $post->post_content ) echo wpautop( wp_kses_post( $post->post_content ) );
                        }
                    ?>
                </div>
            </header>
        <?php endif; 
            if( is_singular( 'job_listing' ) ){
                global $post;
                $banner_image   = get_header_image();
                $show_banner    = get_theme_mod( 'ed_job_banner', true );

                if( $banner_image && $show_banner ){
                    $banner_style = 'background-image: url(' . esc_url( $banner_image ) . '); background-size: cover;';
                    echo '<header class="entry-header" style="'. esc_attr( $banner_style ) .'"></header>';
                }
            } 
        ?>
        <div class="container">
        <?php 
    }
}
endif;
add_action( 'jobscout_pro_content', 'jobscout_pro_content_start' );

if ( ! function_exists( 'jobscout_pro_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function jobscout_pro_post_thumbnail() {
	global $wp_query;
    $image_size                 = 'thumbnail';
    $ed_featured                = get_theme_mod( 'ed_featured_image', true );
    $ed_crop_single_post_image  = get_theme_mod( 'ed_crop_single_post_image', false );
    $ed_crop_archive_page_image = get_theme_mod( 'ed_crop_archive_page_image', false );
    $sidebar                    = jobscout_pro_sidebar();
    
    if( is_home() ){        
        $image_size = 'jobscout-blog';    
        if( has_post_thumbnail() ){       
            echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';                 
               $ed_crop_archive_page_image ? the_post_thumbnail( 'full' ) : the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );   
            echo '</a></figure>'; 
        }else{
            echo '<figure class="post-thumbnail">';
                 jobscout_pro_fallback_svg_image( $image_size );
            echo '</figure>';
        }        
        
    }elseif( is_archive() || is_search() ){
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
            if( has_post_thumbnail() ){
                $ed_crop_archive_page_image ? the_post_thumbnail( 'full' ) : the_post_thumbnail( 'jobscout-blog', array( 'itemprop' => 'image' ) );    
            }else{
                jobscout_pro_fallback_svg_image( 'jobscout-blog' );
            }
        echo '</a></figure>';
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'jobscout-single' : 'jobscout-single-fullwidth';
        if( is_single() ){
            if( $ed_featured && has_post_thumbnail() ){
                echo '<figure class="post-thumbnail">';
                    $ed_crop_single_post_image ? the_post_thumbnail( 'full' ) : the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }else{
            if( has_post_thumbnail() ){
                echo '<figure class="post-thumbnail">';
                     the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }
    }
}
endif;
add_action( 'jobscout_pro_before_post_entry_content', 'jobscout_pro_post_thumbnail', 15 );
add_action( 'jobscout_pro_before_page_entry_content', 'jobscout_pro_post_thumbnail', 15 );
add_action( 'jobscout_pro_before_single_post_entry_content', 'jobscout_pro_post_thumbnail', 15 );

if( ! function_exists( 'jobscout_pro_entry_header' ) ) :
/**
 * Entry Header
*/
function jobscout_pro_entry_header(){ ?>
    <header class="entry-header">
        <?php 
            $ed_cat_single = get_theme_mod( 'ed_category', false );
            $hide_author     = get_theme_mod( 'ed_post_author', false );
            $hide_date       = get_theme_mod( 'ed_post_date', false );

            if( is_single() ){
                if( ! $ed_cat_single ) jobscout_pro_category();
            }else{
                if( 'post' === get_post_type() ){
                    echo '<div class="entry-meta">';
                    if( ! $hide_author ) jobscout_pro_posted_by();
                    if( ! $hide_date ) jobscout_pro_posted_on();
                    echo '</div>';
                }
            }

            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;        
        ?>
    </header>         
    <?php    
}
endif;
add_action( 'jobscout_pro_post_entry_content', 'jobscout_pro_entry_header', 10 );
add_action( 'jobscout_pro_before_page_entry_content', 'jobscout_pro_entry_header', 10 );
add_action( 'jobscout_pro_before_single_post_entry_content', 'jobscout_pro_entry_header', 10 );

if( ! function_exists( 'jobscout_pro_entry_content' ) ) :
/**
 * Entry Content
*/
function jobscout_pro_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jobscout-pro' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();               
            }
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'jobscout_pro_post_entry_content', 'jobscout_pro_entry_content', 15 );
add_action( 'jobscout_pro_page_entry_content', 'jobscout_pro_entry_content', 15 );
add_action( 'jobscout_pro_single_post_entry_content', 'jobscout_pro_entry_content', 15 );
add_action( 'jobscout_pro_before_single_job_content', 'jobscout_pro_entry_content', 15 );

if( ! function_exists( 'jobscout_pro_entry_footer' ) ) :
/**
 * Entry Footer
*/
function jobscout_pro_entry_footer(){ 
    $ed_excerpt   = get_theme_mod( 'ed_excerpt', true );
    $readmore     = get_theme_mod( 'read_more_text', __( 'Read More', 'jobscout-pro' ) );
    $ed_post_date = get_theme_mod( 'ed_post_date', false ); ?>
	<footer class="entry-footer">
		<?php
			if( is_single() ){
			    jobscout_pro_tag();
                jobscout_pro_social_share();
			}
            
            if( ( is_front_page() || is_home() ) && $ed_excerpt ){
                echo '<a href="' . esc_url( get_the_permalink() ) . '" class="readmore-link"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.207 8.58"><defs><style>.c{fill:none;stroke:#2ace5e;}</style></defs><g transform="translate(-701.5 -958.173)"><path class="c" d="M-9326.909-9204.917l-3.937,3.937,3.937,3.937" transform="translate(-8613.846 -8238.518) rotate(180)"/><line class="c" x2="15.154" transform="translate(701.5 962.426)"/></g></svg>' . esc_html( $readmore ) . '</a>';    
            }

            if( is_single() ) echo '<div class="entry-footer-right">';
            if( 'post' === get_post_type() && is_single() ){
                if( ! $ed_post_date ) jobscout_pro_posted_on( true );
                jobscout_pro_single_like_count();
                jobscout_pro_comment_count();
            }
            
            if( get_edit_post_link() ){
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'jobscout-pro' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }
            if( is_single() ) echo '</div>';
		?>
	</footer><!-- .entry-footer -->
	<?php 
}
endif;
add_action( 'jobscout_pro_post_entry_content', 'jobscout_pro_entry_footer', 20 );
add_action( 'jobscout_pro_page_entry_content', 'jobscout_pro_entry_footer', 20 );
add_action( 'jobscout_pro_single_post_entry_content', 'jobscout_pro_entry_footer', 20 );

if( ! function_exists( 'jobscout_navigation' ) ) :
/**
 * Navigation
*/
function jobscout_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Previous Article', 'jobscout-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Article', 'jobscout-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	); 
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'jobscout-pro' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }
    }else{
        $pagination = get_theme_mod( 'pagination_type', 'numbered' );
        
        switch( $pagination ){
            case 'default': // Default Pagination
            
            the_posts_navigation();
            
            break;
            
            case 'numbered': // Numbered Pagination
            
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous', 'jobscout-pro' ),
                'next_text'          => __( 'Next', 'jobscout-pro' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'jobscout-pro' ) . ' </span>',
            ) );
            
            break;
            
            case 'load_more': // Load More Button
            case 'infinite_scroll': // Auto Infinite Scroll
            
            echo '<div class="pagination"></div>';
            
            break;
            
            default:
            
            the_posts_navigation();
            
            break;
        }
    }
}
endif;
add_action( 'jobscout_after_post_content', 'jobscout_navigation', 10 );
add_action( 'jobscout_after_posts_content', 'jobscout_navigation' );

if( ! function_exists( 'jobscout_pro_author' ) ) :
/**
 * Author Section
*/
function jobscout_pro_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_theme_mod( 'author_title', __( 'About Author', 'jobscout-pro' ) );
    $author_name  = get_the_author_meta( 'display_name' );
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
    <div class="author-bio">
        <?php if( $author_title ) echo '<h3 class="title">' . esc_html( $author_title ) . '</h3>'; ?>
        <div class="author-bio-inner">
            <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></figure>
            <div class="author-content">
                <?php 
                    echo '<div class="author-info">' . wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ) . '</div>';
                    if( $author_name ) echo '<div class="author-sign">'. esc_html( $author_name ) .'</div>';
                    jobscout_pro_author_social();
                ?>		
            </div>
		</div>
	</div>
    <?php
    }
}
endif;
add_action( 'jobscout_pro_after_post_content', 'jobscout_pro_author', 25 );

if( ! function_exists( 'jobscout_pro_newsletter' ) ) :
/**
 * Newsletter
*/
function jobscout_pro_newsletter(){ 
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter-block">
            <?php echo do_shortcode( $newsletter ); ?>
        </div>
        <?php
    }
}
endif;
add_action( 'jobscout_pro_after_post_content', 'jobscout_pro_newsletter', 30 );

if( ! function_exists( 'jobscout_pro_related_posts' ) ) :
/**
 * Related Posts 
*/
function jobscout_pro_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        jobscout_pro_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'jobscout_pro_after_post_content', 'jobscout_pro_related_posts', 35 );

if( ! function_exists( 'jobscout_pro_latest_posts' ) ) :
/**
 * Latest Posts
*/
function jobscout_pro_latest_posts(){ 
    jobscout_pro_get_posts_list( 'latest' );
}
endif;
add_action( 'jobscout_pro_latest_posts', 'jobscout_pro_latest_posts' );

if( ! function_exists( 'jobscout_pro_comment' ) ) :
/**
 * Comments Template 
*/
function jobscout_pro_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'jobscout_pro_after_post_content', 'jobscout_pro_comment', 45 );
add_action( 'jobscout_pro_after_page_content', 'jobscout_pro_comment' );

if( ! function_exists( 'jobscout_pro_content_end' ) ) :
/**
 * Content End
*/
function jobscout_pro_content_end(){ 
    $home_sections = jobscout_pro_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>            
        </div><!-- .container/ -->        
    </div><!-- .error-holder/site-content -->
    <?php
    }
}
endif;
add_action( 'jobscout_pro_before_footer', 'jobscout_pro_content_end', 20 );

if( ! function_exists( 'jobscout_pro_footer_start' ) ) :
/**
 * Footer Start
*/
function jobscout_pro_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'jobscout_pro_footer', 'jobscout_pro_footer_start', 20 );

if( ! function_exists( 'jobscout_pro_footer_top' ) ) :
/**
 * Footer Top
*/
function jobscout_pro_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'jobscout_pro_footer', 'jobscout_pro_footer_top', 30 );

if( ! function_exists( 'jobscout_pro_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function jobscout_pro_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
            <?php 
                if ( function_exists( 'the_privacy_policy_link' ) ) the_privacy_policy_link( '<div class="privacy-block">','</div>' );
            ?>
			<div class="copyright">            
                <?php
                    jobscout_pro_get_footer_copyright();
                    jobscout_pro_ed_author_link();
                    jobscout_pro_ed_wp_link();
                ?>               
            </div>
		</div>
	</div>
    <?php
}
endif;
add_action( 'jobscout_pro_footer', 'jobscout_pro_footer_bottom', 40 );

if( ! function_exists( 'jobscout_pro_footer_end' ) ) :
/**
 * Footer End 
*/
function jobscout_pro_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'jobscout_pro_footer', 'jobscout_pro_footer_end', 50 );

if( ! function_exists( 'jobscout_pro_back_to_top' ) ) :
/**
 * Back to top
*/
function jobscout_pro_back_to_top(){ ?>
    <div id="back-to-top">
		<span><i class="fas fa-long-arrow-alt-up"></i></span>
	</div>
    <?php
}
endif;
add_action( 'jobscout_pro_after_footer', 'jobscout_pro_back_to_top', 15 );

if( ! function_exists( 'jobscout_pro_page_end' ) ) :
/**
 * Page End
*/
function jobscout_pro_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'jobscout_pro_after_footer', 'jobscout_pro_page_end', 20 );


if( ! function_exists( 'jobscout_pro_related_jobs' ) ) :
/**
 * Related jobs
*/
function jobscout_pro_related_jobs(){ 
    $ed_related_job = get_theme_mod( 'ed_job_related', true );
    
    if( $ed_related_job ){
        jobscout_pro_get_jobs_list( 'related' );
    } 
}
endif;                                                                  
add_action( 'jobscout_pro_after_single_job_content', 'jobscout_pro_related_jobs', 15 );

if( ! function_exists( 'jobscout_pro_404_additional_posts' ) ) :
/**
 * Related jobs
*/
function jobscout_pro_404_additional_posts(){ 
    $ed_404_latest           = get_theme_mod( 'ed_404_latest', true );
    $control_option          = get_theme_mod( 'buttonset_404_latest', 'latest_posts' );
    $wpjob_manager_activated = is_wp_job_manager_activated();
    
    if( $ed_404_latest ){
        if( 'latest_posts' == $control_option ){
            jobscout_pro_get_posts_list( 'latest' );
        }else{
            if( $wpjob_manager_activated ){
                jobscout_pro_get_jobs_list( 'latest' );
            }else{
                jobscout_pro_get_posts_list( 'latest' );
            }
        }
    }
}
endif;                                                                  
add_action( 'jobscout_pro_404_before_footer', 'jobscout_pro_404_additional_posts' );

if( ! function_exists( 'jobscout_pro_get_single_job_additional_info' ) ) :
    /**
     * Page End
    */
    function jobscout_pro_get_single_job_additional_info(){ 
            global $post;
            $show_additional_info = get_theme_mod( 'ed_job_additional_info', true );

            if( is_wp_job_manager_activated() && $show_additional_info ){ ?>
       
                <section class="job-overview">
                    <h2 class="widget-title"><?php esc_html_e( 'Job Overview', 'jobscout-pro' ); ?></h2>
                    <div class="overview-wrap">
                        <ul>
                            <?php 
                                if( get_option( 'job_manager_enable_types' ) ){
                                    $job_types = wpjm_get_the_job_types();

                                    if( $job_types ){

                                        echo '<li><i class="fa fa-briefcase"></i><span class="overview-title">'. esc_html__( 'Job Type', 'jobscout-pro' ) .'</span>';

                                        $count       = count( $job_types );
                                        $type_string = '';
                                        $i           = 1;

                                        foreach ( $job_types as $type ){
                                            if( $i< $count ){
                                                $type_string .= $type->name .', ';
                                            }else{
                                                $type_string .= $type->name;
                                            }
                                            $i++;
                                        }
                                            echo '<span class="overview-desc">'. esc_html( $type_string ) .'</span>';
                                        echo '</li>';
                                    }
                                }

                                $company_name = get_the_company_name( $post->ID );

                                if( $company_name ){
                                    echo '<li><i class="fa fa-building"></i>
                                        <span class="overview-title">'. esc_html__( 'Company', 'jobscout-pro' ) .'</span>
                                        <span class="overview-desc">'. esc_html( $company_name ).'</span>
                                    </li>';
                                }

                                $location = get_the_job_location( $post );

                                if( $location ){
                                    echo ' <li><i class="fa fa-location-arrow"></i>
                                        <span class="overview-title">'. esc_html__( 'Location', 'jobscout-pro' ) .'</span>
                                        <span class="overview-desc">'. esc_html( $location ).'</span></li>';
                                }

                                $email = get_post_meta( $post->ID, '_application', true );
                                if( $email ){
                                    echo ' <li><i class="fa fa-envelope-open"></i>
                                        <span class="overview-title">'. esc_html__( 'Email', 'jobscout-pro' ) .'</span>
                                        <span class="overview-desc">'. esc_html( $email ).'</span></li>';
                                }


                                if( is_wpjm_extra_field_activated() ){
                                    $job_salary = get_post_meta( $post->ID, '_job_salary', true );
                                    $job_info   = get_post_meta( $post->ID, '_job_important_info', true );


                                    if( $job_salary ){ ?>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M334.89 121.63l43.72-71.89C392.77 28.47 377.53 0 352 0H160.15c-25.56 0-40.8 28.5-26.61 49.76l43.57 71.88C-9.27 240.59.08 392.36.08 412c0 55.23 49.11 100 109.68 100h292.5c60.58 0 109.68-44.77 109.68-100 0-19.28 8.28-172-177.05-290.37zM160.15 32H352l-49.13 80h-93.73zM480 412c0 37.49-34.85 68-77.69 68H109.76c-42.84 0-77.69-30.51-77.69-68v-3.36c-.93-59.86 20-173 168.91-264.64h110.1C459.64 235.46 480.76 348.94 480 409zM285.61 310.74l-49-14.54c-5.66-1.62-9.57-7.22-9.57-13.68 0-7.86 5.76-14.21 12.84-14.21h30.57a26.78 26.78 0 0 1 13.93 4 8.92 8.92 0 0 0 11-.75l12.73-12.17a8.54 8.54 0 0 0-.65-13 63.12 63.12 0 0 0-34.17-12.17v-17.6a8.68 8.68 0 0 0-8.7-8.62H247.2a8.69 8.69 0 0 0-8.71 8.62v17.44c-25.79.75-46.46 22.19-46.46 48.57 0 21.54 14.14 40.71 34.38 46.74l49 14.54c5.66 1.61 9.58 7.21 9.58 13.67 0 7.87-5.77 14.22-12.84 14.22h-30.61a26.72 26.72 0 0 1-13.93-4 8.92 8.92 0 0 0-11 .76l-12.84 12.06a8.55 8.55 0 0 0 .65 13 63.2 63.2 0 0 0 34.17 12.17v17.55a8.69 8.69 0 0 0 8.71 8.62h17.41a8.69 8.69 0 0 0 8.7-8.62V406c25.68-.64 46.46-22.18 46.57-48.56.02-21.5-14.13-40.67-34.37-46.7z"></path></svg>
                                            <span class="overview-title"><?php esc_html_e( 'Offered Salary', 'jobscout-pro' ); ?></span>
                                            <span class="overview-desc"><?php echo esc_html( $job_salary ); ?></span>
                                        </li>
                                    <?php
                                    }

                                    if( $job_info ){ ?>
                                        <li>
                                            <i class="fa fa-info"></i>
                                            <span class="overview-title"><?php esc_html_e( 'Additional Info', 'jobscout-pro' ); ?></span>
                                            <span class="overview-desc"><?php echo esc_html( $job_info ); ?></span>
                                        </li>
                                    <?php
                                    }
                                }
                            ?>
                        </ul>
                        <div class="btn-wrap">
                            <?php 
                                if ( candidates_can_apply( $post->ID ) ) {
                                    get_job_manager_template( 'job-application-top.php' );
                                }
                            ?>
                        </div>
                    </div>
                </section>
            
                <?php if( $location ){ ?>
                    <section class="job-location">
                        <h2 class="widget-title"><?php esc_html_e( 'Job Location', 'jobscout-pro' ) ?></h2>
                        <div class="job-loc-map">
                            <?php the_job_location( true ); ?>
                        </div>
                    </section>
                <?php
            }
        }
    }
endif;
add_action( 'jobscout_pro_single_job_additional_info', 'jobscout_pro_get_single_job_additional_info', 20 );


if( ! function_exists( 'jobscout_get_single_job_title' ) ) :
/**
 * Before wp_head 
*/
function jobscout_get_single_job_title(){ 

    ?>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php
            if ( get_option( 'job_manager_enable_types' ) ) {
                echo '<div class="job-type">';
                    $types = wpjm_get_the_job_types(); 
                    if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
                        <span class="btn <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></span>
                    <?php endforeach; endif;
                echo '</div>';
            } 
        ?>
    </header>
    <?php
}
endif;
add_action( 'jobscout_pro_before_single_job_content', 'jobscout_get_single_job_title' );

if( ! function_exists( 'jobscout_pro_get_single_job_footer' ) ) :
/**
 * Job single footer
*/
function jobscout_pro_get_single_job_footer(){ ?>
   <footer class="entry-footer">
        <?php  
            jobscout_pro_social_share(); 
            jobscout_pro_job_print();
        ?>
    </footer>
    <?php
}
endif;
add_action( 'jobscout_pro_single_job_footer', 'jobscout_pro_get_single_job_footer' );