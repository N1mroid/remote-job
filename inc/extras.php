<?php
/**
 * JobScout Pro Standalone Functions.
 *
 * @package JobScout_Pro
 */

if ( ! function_exists( 'jobscout_pro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function jobscout_pro_posted_on( $single = false ) {
	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

    $time_svg = '';
    if( $single ){
        $time_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><defs><style>.ca{opacity:0.6;}</style></defs><path class="ca" d="M14.6,1.5H12.461V.5a.5.5,0,1,0-1,0v1H8.474V.5a.5.5,0,1,0-1,0v1H4.486V.5a.472.472,0,0,0-.5-.5.472.472,0,0,0-.5.5v1H1.346A1.342,1.342,0,0,0,0,2.85V14.7A1.332,1.332,0,0,0,1.346,16H14.654A1.342,1.342,0,0,0,16,14.65V2.85A1.419,1.419,0,0,0,14.6,1.5Zm.349,13.15A.341.341,0,0,1,14.6,15H1.346A.341.341,0,0,1,1,14.65V2.85a.341.341,0,0,1,.349-.35H3.489v1a.472.472,0,0,0,.5.5.472.472,0,0,0,.5-.5v-1H7.477v1a.5.5,0,1,0,1,0v-1h2.991v1a.5.5,0,1,0,1,0v-1H14.6a.341.341,0,0,1,.349.35ZM3.489,6H5.483V7.5H3.489Zm0,2.5H5.483V10H3.489Zm0,2.5H5.483v1.5H3.489Zm3.489,0H8.972v1.5H6.978Zm0-2.5H8.972V10H6.978Zm0-2.5H8.972V7.5H6.978Zm3.489,5h1.994v1.5H10.467Zm0-2.5h1.994V10H10.467Zm0-2.5h1.994V7.5H10.467Z"/></svg>';
    }
    
    $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'. $time_svg .'<time class="updated published">' . $time_string . '</time></a>';
	
	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'jobscout_pro_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function jobscout_pro_posted_by() {
	$byline = sprintf( '<span itemprop="name"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . esc_html( get_the_author() ) . '</a></span>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
}
endif;

if( ! function_exists( 'jobscout_pro_comment_count' ) ) :
/**
 * Comment Count
*/
function jobscout_pro_comment_count(){
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comment-box"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.943 15.465"><defs><style>.co{fill:none;stroke:#000;stroke-width:1.3px;opacity:0.6;}</style></defs><path class="co" d="M15.425,11.636H12.584v2.03L9.2,11.636H1.218A1.213,1.213,0,0,1,0,10.419v-9.2A1.213,1.213,0,0,1,1.218,0H15.425a1.213,1.213,0,0,1,1.218,1.218v9.2A1.213,1.213,0,0,1,15.425,11.636Z" transform="translate(0.65 0.65)"/></svg>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'jobscout-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'jobscout_pro_category' ) ) :
/**
 * Prints categories
 */
function jobscout_pro_category(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
            if( is_single() ) echo '<div class="entry-meta">';
            echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
            if( is_single() ) echo '</div>';
		}
	}
}
endif;

if ( ! function_exists( 'jobscout_pro_tag' ) ) :
/**
 * Prints tags
 */
function jobscout_pro_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'jobscout-pro' ) . '</div>', '<span>', '</span>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'jobscout_pro_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function jobscout_pro_get_posts_list( $status ){
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 4;
        $title                  = get_theme_mod( 'page_404_latest_post_title',__( 'Latest Posts', 'jobscout-pro' ) );
        $class                  = 'recent-posts';
        $image_size             = 'jobscout-blog';
        break;
        
        case 'related':
        $args['posts_per_page'] = 6;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'Related Articles', 'jobscout-pro' ) );
        $class                  = 'additional-posts';
        $image_size             = 'jobscout-blog';
        $related_tax            = get_theme_mod( 'related_taxonomy', 'cat' );
        if( $related_tax == 'cat' ){
            $cats = get_the_category( $post->ID );        
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
        }elseif( $related_tax == 'tag' ){
            $tags = get_the_tags( $post->ID );
            if( $tags ){
                $t = array();
                foreach( $tags as $tag ){
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;  
            }
        }
        break;        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="<?php echo esc_attr( $class ); ?>">
    		<?php 
            if( $title ) echo '<h2 class="section-title">' . esc_html( $title ) . '</h2>'; ?>
            <div class="article-wrap">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <article class="post">
    				<figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                        <?php
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                            }else{ 
                                jobscout_pro_fallback_svg_image( $image_size );
                            }
                        ?>
                    </a></figure>
    				<header class="entry-header">
    					<?php
                            echo '<div class="entry-meta">';
                            jobscout_pro_posted_by();
                            jobscout_pro_posted_on();
                            echo '</div>';
                            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                        ?>                        
    				</header>
    			</article>
                <?php }?>
            </div>    		
    	</div>
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'jobscout_pro_site_branding' ) ) :
/**
 * Site Branding
*/
function jobscout_pro_site_branding( $responsive = false ){ 
    $display_header_text = get_theme_mod( 'header_text', 1 );
    $site_title          = get_bloginfo( 'name', 'display' );
    $description         = get_bloginfo( 'description', 'display' );

    if( ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) && $display_header_text && ( ! empty( $site_title ) || ! empty(  $description  ) ) ){
       $branding_class = ' logo-text';                                                                                                                          
    } else {
        $branding_class = '';
    }
    ?>
    <div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="https://schema.org/Organization"> <!-- logo-text -->
        <?php 
            if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                echo '<div class="site-logo">';
                the_custom_logo();
                echo '</div>';
            } 

            echo '<div class="site-title-wrap">';
            if( $responsive ){ ?>
                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
            <?php }else{
               if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                }else{ ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php
                }
            }
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ){ ?>
                <p class="site-description" itemprop="description"><?php echo $description; ?></p>
            <?php

            }
            echo '</div><!-- .site-title-wrap -->'
        ?>
    </div>
    <?php
}
endif;

if( ! function_exists( 'jobscout_pro_primary_nagivation' ) ) :
/**
 * Primary Navigation.
*/
function jobscout_pro_primary_nagivation( $responsive_menu = false ){ 
    $enabled_section = array();
    $ed_one_page     = get_theme_mod( 'ed_one_page', false );
    $ed_home_link    = get_theme_mod( 'ed_home_link', true );
    $post_job_label  = get_theme_mod( 'post_job_label', __( 'Post Jobs', 'jobscout-pro' ) );
    $post_job_url    = get_theme_mod( 'post_job_url', '#' );
    $home_sections   = get_theme_mod( 'front_sort', array( 'popular', 'job-posting', 'step', 'cta', 'blog', 'testimonial', 'client' ) );
    
    $label_popular     = get_theme_mod( 'label_popular', __( 'Popular', 'jobscout-pro' ) );
    $label_jobs        = get_theme_mod( 'label_jobs', __( 'Jobs', 'jobscout-pro' ) );
    $label_steps       = get_theme_mod( 'label_steps', __( 'Steps', 'jobscout-pro' ) );
    $label_cta         = get_theme_mod( 'label_cta', __( 'CTA', 'jobscout-pro' ) );
    $label_blog        = get_theme_mod( 'label_blog', __( 'Blog', 'jobscout-pro' ) );
    $label_testimonial = get_theme_mod( 'label_testimonial', __( 'Testimonial', 'jobscout-pro' ) );
    $label_client      = get_theme_mod( 'label_client', __( 'Client', 'jobscout-pro' ) );
    
    $menu_label = array();
    if( ! empty( $label_popular ) ) $menu_label['popular'] = $label_popular;
    if( ! empty( $label_jobs ) ) $menu_label['jobs'] = $label_jobs;
    if( ! empty( $label_steps ) ) $menu_label['steps'] = $label_steps;
    if( ! empty( $label_cta ) ) $menu_label['cta'] = $label_cta;
    if( ! empty( $label_blog ) ) $menu_label['blog'] = $label_blog;
    if( ! empty( $label_testimonial ) ) $menu_label['testimonial'] = $label_testimonial;
    if( ! empty( $label_client ) ) $menu_label['client'] = $label_client;
    
    foreach( $home_sections as $section ){
        if( array_key_exists( $section, $menu_label ) ){
            $enabled_section[] = array(
                'id'    => $section . '-section',
                'label' => $menu_label[$section],
            );
        }
    }

    $schema_class = '';
    if( ! $responsive_menu ){
       $schema_class = ' itemscope itemtype="https://schema.org/SiteNavigationElement"';
    }
    
    if( $ed_one_page && ( 'page' == get_option( 'show_on_front' ) ) && $enabled_section ){ ?>
        <nav id="site-navigation" class="main-navigation" role="navigation"<?php echo $schema_class; ?>>
            <ul>
                <?php if( $ed_home_link ){ ?>
                <li class="<?php if( is_front_page() ) echo esc_attr( 'current-menu-item' ); ?>"><a href="<?php echo esc_url( home_url( '/' ) . '#banner-section' ); ?>"><?php esc_html_e( 'Home', 'jobscout-pro' ); ?></a></li>
            <?php }
                foreach( $enabled_section as $section ){ 
                    if( $section['label'] ){
            ?>
                    <li><a href="<?php echo esc_url( home_url( '/' ) . '#' . esc_attr( $section['id'] ) ); ?>"><?php echo esc_html( $section['label'] );?></a></li>                        
            <?php 
                    } 
                }
            ?>
            </ul>
        </nav>
        <?php if( $post_job_label || $post_job_url ){ ?>
            <div class="btn-wrap">
                <a class="btn" href="<?php echo esc_url( $post_job_url ) ?>"><?php echo esc_html( $post_job_label ) ?></a>
            </div>
        <?php } 
    }else{
    ?>
    	<nav id="site-navigation" class="main-navigation" role="navigation"<?php echo $schema_class; ?>>
            <?php if( ! $responsive_menu ) : ?>
                <button class="toggle-btn">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
    		<?php
                endif;
    			wp_nav_menu( array(
    				'theme_location' => 'primary',
    				'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'jobscout_pro_primary_menu_fallback',
    			) );
    		?>
    	</nav><!-- #site-navigation -->
        <?php if( $post_job_label || $post_job_url ){ ?>
            <div class="btn-wrap">
                <a class="btn" href="<?php echo esc_url( $post_job_url ) ?>"><?php echo esc_html( $post_job_label ) ?></a>
            </div>
        <?php } 
  
    }
}
endif;

if( ! function_exists( 'jobscout_pro_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function jobscout_pro_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'jobscout-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'jobscout_pro_secondary_navigation' ) ) :
/**
 * Secondary Navigation
*/
function jobscout_pro_secondary_navigation(){ ?>
	<nav class="secondary-nav">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'secondary',
                'menu_class'     => 'nav-menu',
				'menu_id'        => 'secondary-menu',
                'fallback_cb'    => 'jobscout_pro_secondary_menu_fallback',
			) );
		?>
	</nav>
    <?php
}
endif;

if( ! function_exists( 'jobscout_pro_secondary_menu_fallback' ) ) :
/**
 * Fallback for secondary menu
*/
function jobscout_pro_secondary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="secondary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'jobscout-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'jobscout_pro_breadcrumb' ) ) :
/**
 * Breadcrumbs
*/
function jobscout_pro_breadcrumb(){ 
    global $post;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'home_text', __( 'Home', 'jobscout-pro' ) ); // text for the 'Home' link
    $delimiter  = '<span class="separator"><i class="fas fa-angle-right"></i></span>';
    $before     = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) ){
        $depth = 1;
        echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="' . esc_url( home_url() ) . '" itemprop="item"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
        
        if( is_home() ){ 
            $depth = 2;                       
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;            
        }elseif( is_category() ){  
            $depth = 2;          
            $thisCat = get_category( get_query_var( 'cat' ), false );            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;  
            }            
            if( $thisCat->parent != 0 ){
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );
                foreach( $parent_categories as $parent_term ){
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url  = get_term_link( $parent_obj->term_id );
                        $term_name = $parent_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                        $depth++;
                    }
                }
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;       
        }elseif( is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();            
            if( wc_get_page_id( 'shop' ) ){ //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;
            }
            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                        $depth++;
                    }
                }
            }
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">' . esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
        }elseif( is_woocommerce_activated() && is_shop() ){ //Shop Archive page
            $depth = 2;
            if( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ){
                return;
            }
            $_name    = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = ( wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0 )  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
            if( ! $_name ){
                $product_post_type = get_post_type_object( 'product' );
                $_name             = $product_post_type->labels->singular_name;
            }
            echo $before . '<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_tag() ){ 
            $depth          = 2;
            $queried_object = get_queried_object();
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />'. $after;
        }elseif( is_author() ){  
            global $author;
            $depth    = 2;
            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;     
        }elseif( is_search() ){ 
            $depth       = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before . '<a itemprop="item" href="'. esc_url( $request_uri ) . '"><span itemprop="name">' . sprintf( __( 'Search Results for "%s"', 'jobscout-pro' ), esc_html( get_search_query() ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_day() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'jobscout-pro' ) ), get_the_time( __( 'm', 'jobscout-pro' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'jobscout-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo $before . '<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'jobscout-pro' ) ), get_the_time( __( 'm', 'jobscout-pro' ) ), get_the_time( __( 'd', 'jobscout-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'd', 'jobscout-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_month() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
            $depth++;
            echo $before . '<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'jobscout-pro' ) ), get_the_time( __( 'm', 'jobscout-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'jobscout-pro' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;        
        }elseif( is_year() ){ 
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'jobscout-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
        }elseif( is_single() && !is_attachment() ){   
            $depth = 2;         
            if( is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                if( wc_get_page_id( 'shop' ) ){ //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                    $depth++;                    
                }           
                if( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ){
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                    $depth++;
                }
                echo $before . '<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;
            }elseif( get_post_type() != 'post' ){                
                $post_type = get_post_type_object( get_post_type() );                
                if( $post_type->has_archive == true ){// For CPT Archive Link                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( get_post_type() ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '</span>';
                   $depth++;    
                }
                echo $before . '<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
            }else{ //For Post                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '</span>';  
                    $depth++; 
                }
                
                if( $cat_object ){ //Getting category hierarchy if any        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object ){
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term         = $key;
                            $potential_parent = $object->term_id;
                        }
                    }                    
                    $cat  = $cat_object[$use_term];              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );
                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url  = get_term_link( $cat_obj->term_id );
                            $term_name = $cat_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $delimiter . '</span>';
                            $depth++;
                        }
                    }
                }
                echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;   
            }        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){ //For Custom Post Archive
            $depth     = 2;
            $post_type = get_post_type_object( get_post_type() );
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $delimiter . '/</span>';
                echo $before . sprintf( __('Page %s', 'jobscout-pro'), get_query_var('paged') ) . $after; //@todo need to check this
            }else{
                echo $before . '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $after;
            }    
        }elseif( is_attachment() ){ 
            $depth = 2;           
            echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_page() && !$post->post_parent ){            
            $depth = 2;
            echo $before . '<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" />' . $after;
        }elseif( is_page() && $post->post_parent ){            
            $depth       = 2;
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while( $parent_id ){
                $current_page  = get_post( $parent_id );
                $breadcrumbs[] = $current_page->ID;
                $parent_id     = $current_page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . $delimiter . '</span>';
                $depth++;
            }
            echo $before . '<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title() ) . '</span></a><meta itemprop="position" content="' . absint( $depth ) . '" /></span>' . $after;
        }elseif( is_404() ){
            $depth = 2;
            echo $before . '<a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html__( '404 Error - Page Not Found', 'jobscout-pro' ) . '</span></a><meta itemprop="position" content="' . absint( $depth ). '" />' . $after;
        }
        
        if( get_query_var('paged') ) printf( __( ' (Page %s)', 'jobscout-pro' ), get_query_var('paged') );
        
        echo '</div><!-- .crumbs -->';
        
    }                
}
endif;

if( ! function_exists( 'jobscout_pro_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function jobscout_pro_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
               <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s<span class="says">says:</span></b>', 'jobscout-pro' ), get_comment_author_link() ); ?>
        	</div><!-- .comment-author vcard -->
            <div class="comment-metadata commentmetadata">
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'jobscout-pro' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
        		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jobscout-pro' ); ?></em>
        		<br />
        	<?php endif; ?>
        </footer>
        <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>        
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>       
	<?php if ( 'div' != $args['style'] ) : ?>
    </article><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'jobscout_pro_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function jobscout_pro_sidebar( $class = false ){
    global $post;
    $return      = $return = $class ? 'full-width' : false; //Fullwidth
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( ( is_front_page() && is_home() ) || is_home() ){ //blog/home page
        
        $home_sidebar = get_theme_mod( 'home_page_sidebar', 'sidebar' );
        
        if( $layout == 'no-sidebar' ){  
            $return = $class ? 'full-width' : false; //Fullwidth        
        }elseif( is_active_sidebar( $home_sidebar ) ){
            if( $class ){                
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; 
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';                
            }else{
                $return = $home_sidebar; //With Sidebar
            }
        }else{
            $return = $class ? 'full-width' : false; //Fullwidth
        }                
    }
    
    if( is_archive() ){
        //archive page
        $archive_sidebar = get_theme_mod( 'archive_page_sidebar', 'sidebar' );
        $cat_sidebar     = get_theme_mod( 'cat_archive_page_sidebar', 'default-sidebar' );
        $tag_sidebar     = get_theme_mod( 'tag_archive_page_sidebar', 'default-sidebar' );
        $date_sidebar    = get_theme_mod( 'date_archive_page_sidebar', 'default-sidebar' );
        $author_sidebar  = get_theme_mod( 'author_archive_page_sidebar', 'default-sidebar' );
        
        if( is_category() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( $cat_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $cat_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $cat_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }                
        }elseif( is_tag() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $tag_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $tag_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $tag_sidebar;
                }           
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }           
        }elseif( is_author() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $author_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $author_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $author_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }            
        }elseif( is_date() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $date_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $date_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $date_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }
        }elseif( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ){ //For Woocommerce            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( is_active_sidebar( 'shop-sidebar' ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }       
        }else{
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( is_active_sidebar( $archive_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }                      
        }        
    }
    
    if( is_singular() ){         
        $post_sidebar = get_theme_mod( 'single_post_sidebar', 'sidebar' ); //Global sidebar for single post from customizer
        $page_sidebar = get_theme_mod( 'single_page_sidebar', 'sidebar' ); //Global Sidebar for single page from customizer
        $page_layout  = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Global Layout/Position for Pages
        $post_layout  = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Global Layout/Position for Posts        
        
        /**
         * Individual post/page layout
        */
        if( get_post_meta( $post->ID, '_jobscout_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_jobscout_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        /**
         * Individual post/page sidebar
        */     
        if( get_post_meta( $post->ID, '_jobscout_sidebar', true ) ){
            $single_sidebar = get_post_meta( $post->ID, '_jobscout_sidebar', true );
        }else{
            $single_sidebar = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_page_template( array( 'templates/contact.php', 'templates/portfolio.php' ) ) ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                $return = $class ? 'full-width' : false;
            }elseif( $single_sidebar == 'default-sidebar' && is_active_sidebar( $page_sidebar ) ){
                if( $class ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                }else{
                    $return = $page_sidebar;
                }
            }elseif( is_active_sidebar( $single_sidebar ) ){
                if( $class ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                }else{
                    $return = $single_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }
        }
        
        if( is_single() ){
            if( 'product' === get_post_type() ){ //For Product Post Type
                if( is_active_sidebar( 'shop-sidebar' ) ){
                    if( $class ){
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }
            if( 'job_listing' === get_post_type() ){ //For Product Post Type
                $show_additional_info = get_theme_mod( 'ed_job_additional_info', true );

                if( is_active_sidebar( 'job-sidebar' ) || $show_additional_info ){
                    if( $class ){
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }elseif( 'post' === get_post_type() ){ //For default post type
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $single_sidebar == 'default-sidebar' && is_active_sidebar( $post_sidebar ) ){
                    if( $class ){
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                    }else{
                        $return = $post_sidebar;
                    }
                }elseif( is_active_sidebar( $single_sidebar ) ){
                    if( $class ){
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                    }else{
                        $return = $single_sidebar;
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }else{ //Custom Post Type
                if( $post_layout == 'no-sidebar' ){
                    $return = $class ? 'full-width' : false;
                }if( is_active_sidebar( $post_sidebar ) ){
                    if( $class ){
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar';
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }else{
                        $return = $post_sidebar;
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }
        }
    } 
        
    if( is_search() ){
        $search_sidebar = get_theme_mod( 'search_page_sidebar', 'sidebar' );       
        
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( $search_sidebar ) ){
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar';
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = $search_sidebar;
            }
        }else{
            $return = $class ? 'full-width' : false; //Fullwidth
        }        
    }
      
    return $return; 
}
endif;

if( ! function_exists( 'jobscout_pro_get_categories' ) ) :
/**
 * Function to list post categories in customizer options
*/
function jobscout_pro_get_categories( $select = true, $taxonomy = 'category', $slug = false ){    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 
        'hide_empty' => false,
        'taxonomy'   => $taxonomy 
    );
    
    $catlists = get_terms( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'jobscout-pro' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}
endif;

if( ! function_exists( 'jobscout_pro_get_patterns' ) ) :
/**
 * Function to list Custom Pattern
*/
function jobscout_pro_get_patterns(){
    $patterns = array();
    $patterns['nobg'] = get_template_directory_uri() . '/images/patterns_thumb/' . 'nobg.png';
    for( $i=0; $i<38; $i++ ){
        $patterns['pattern'.$i] = get_template_directory_uri() . '/images/patterns_thumb/' . 'pattern' . $i .'.png';
    }
    for( $j=1; $j<26; $j++ ){
        $patterns['hbg'.$j] = get_template_directory_uri() . '/images/patterns_thumb/' . 'hbg' . $j . '.png';
    }
    return $patterns;
}
endif;

if( ! function_exists( 'jobscout_pro_get_dynamic_sidebar' ) ) :
/**
 * Function to list dynamic sidebar
*/
function jobscout_pro_get_dynamic_sidebar( $nosidebar = false, $sidebar = false, $default = false ){
    $sidebar_arr = array();
    $sidebars = get_theme_mod( 'sidebar' );
    
    if( $default ) $sidebar_arr['default-sidebar'] = __( 'Default Sidebar', 'jobscout-pro' );
    if( $sidebar ) $sidebar_arr['sidebar'] = __( 'Sidebar', 'jobscout-pro' );
    
    if( $sidebars ){        
        foreach( $sidebars as $sidebar ){            
            $id = $sidebar['name'] ? sanitize_title( $sidebar['name'] ) : 'jobscout-pro-sidebar-one';
            $sidebar_arr[$id] = $sidebar['name'];
        }
    }
    
    if( $nosidebar ) $sidebar_arr['no-sidebar'] = __( 'No Sidebar', 'jobscout-pro' );
    
    return $sidebar_arr;
}
endif;

if( ! function_exists( 'jobscout_pro_create_post' ) ) :
/**
 * A function used to programmatically create a post and assign a page template in WordPress. 
 *
 * @link https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
 * @link https://tommcfarlin.com/programmatically-set-a-wordpress-template/
 */
function jobscout_pro_create_post( $title, $slug, $template ){

	// Setup the author, page
	$author_id = 1;
    
    // Look for the page by the specified title. Set the ID to -1 if it doesn't exist.
    // Otherwise, set it to the page's ID.
    $page = get_page_by_title( $title, OBJECT, 'page' );
    $page_id = ( null == $page ) ? -1 : $page->ID;
    
	// If the page doesn't already exist, then create it
	if( $page_id == -1 ){

		// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status' =>	'closed',
				'ping_status'	 =>	'closed',
				'post_author'	 =>	$author_id,
				'post_name'		 =>	$slug,
				'post_title'	 =>	$title,
				'post_status'	 =>	'publish',
				'post_type'		 =>	'page'
			)
		);
        
        if( $post_id ) update_post_meta( $post_id, '_wp_page_template', $template );

	// Otherwise, we'll stop
	}else{
	   update_post_meta( $page_id, '_wp_page_template', $template );
	} // end if

} // end programmatically_create_post
endif;

if( ! function_exists( 'jobscout_pro_get_page_template_url' ) ) :
/**
 * Returns page template url if not found returns home page url
*/
function jobscout_pro_get_page_template_url( $page_template ){
    $args = array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => $page_template,
        'post_type'  => 'page',
        'fields'     => 'ids',
    );
    
    $posts_array = get_posts( $args );
    
    $url = ( $posts_array ) ? get_permalink( $posts_array[0] ) : get_home_url();
    return $url;    
}
endif;

if( ! function_exists( 'jobscout_pro_author_social' ) ) :
/**
 * Author Social Links
*/
function jobscout_pro_author_social(){
    $id      = get_the_author_meta( 'ID' );
    $socials = get_user_meta( $id, '_jobscout_pro_user_social_icons', true );
    $fonts   = array(
        'facebook'     => 'fab fa-facebook-f', 
        'twitter'      => 'fab fa-twitter',
        'instagram'    => 'fab fa-instagram',
        'snapchat'     => 'fab fa-snapchat',
        'pinterest'    => 'fab fa-pinterest',
        'linkedin'     => 'fab fa-linkedin-in',
        'google-plus'  => 'fab fa-google-plus',
        'youtube'      => 'fab fa-youtube'
    );
    
    if( $socials ){
        echo '<ul class="social-list">';
        foreach( $socials as $key => $link ){            
            if( $link ) echo '<li><a href="' . esc_url( $link ) . '" target="_blank" rel="nofollow noopener"><i class="' . esc_attr( $fonts[$key] ) . '"></i></a></li>';
        }
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'jobscout_pro_job_print' ) ) :
/**
 * Prints job page
*/
function jobscout_pro_job_print( $floating = false ){ 
    $ed_print   =  true;
    
    if( $ed_print ){ ?>
        <div class="job-print">
            <span><?php esc_html_e( 'Print', 'jobscout-pro' ); ?></span>
            <a href="javascript:if(window.print)window.print()"><i class="fas fa-print"></i></a>
        </div>
    <?php
    }
}
endif;

if( ! function_exists( 'jobscout_pro_get_real_ip_address' )):
/**
 * Get the actual ip address 
*/
function jobscout_pro_get_real_ip_address(){
    if( getenv( 'HTTP_CLIENT_IP' ) ){
        $ip = getenv( 'HTTP_CLIENT_IP' );
    }elseif( getenv( 'HTTP_X_FORWARDED_FOR' ) ){
        $ip = getenv('HTTP_X_FORWARDED_FOR' );
    }elseif( getenv( 'HTTP_X_FORWARDED' ) ){
        $ip = getenv( 'HTTP_X_FORWARDED' );
    }elseif( getenv( 'HTTP_FORWARDED_FOR' ) ){
        $ip = getenv( 'HTTP_FORWARDED_FOR' );
    }elseif( getenv( 'HTTP_FORWARDED' ) ){
        $ip = getenv( 'HTTP_FORWARDED' );
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
}
endif;

if( ! function_exists( 'jobscout_pro_likes_can' ) ) :
/**
 * Check if the current IP already liked the content or not.
 */
function jobscout_pro_likes_can( $id = 0 ) {
    // Return early if $id is not set.
    if( ! $id ){
        return false;
    }
    
    $ip_list = ( $ip = get_post_meta( $id, '_jobscout_pro_post_like_ip', true ) ) ? $ip  : array();

    if( ( $ip_list == '' ) || ( is_array( $ip_list ) && ! in_array( jobscout_pro_get_real_ip_address(), $ip_list ) ) ){
        return true;
    }

    return false;
}
endif;

if( ! function_exists( 'jobscout_pro_single_like_count' ) ) :
/**
 * Prints like count of post
*/
function jobscout_pro_single_like_count(){
    $ed_single_like = get_theme_mod( 'ed_single_like', true );
    if( $ed_single_like ) :
        global $post;
        $likes_count = get_post_meta( $post->ID, '_jobscout_pro_post_like', true );
        $class = ( ! $likes_count ) ? 'like' : 'liked';
        $icon  = ( ! $likes_count ) ? 'far fa-heart' : 'fas fa-heart';
        $add_structure  = ( ! $likes_count ) ? '<a href="javascript:void(0);">' : '<span class="liked-icon">';
        $add_structure_end  = ( ! $likes_count ) ? '</a>' : '</span>';

        echo '<div class="jbp_single_ajax_like" id="singlelike-' . esc_attr( $post->ID ) . '"><span class="favourite single-like ' . esc_attr( $class ) . '">' . $add_structure . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.538 14.421"><defs><style>.fav{fill:none;stroke:#000;stroke-width:1.3px;opacity:0.6;}</style></defs><path class="fav" d="M9.684,6.409A4.191,4.191,0,0,0,6.136,4.083c-2.684,0-4.094,2.274-4.094,4.548,0,3.776,7.642,8.46,7.642,8.46s7.6-4.64,7.6-8.46c0-2.32-1.455-4.548-4.048-4.548A3.951,3.951,0,0,0,9.684,6.409Z" transform="translate(-1.392 -3.433)"/></svg>' . $add_structure_end . absint( $likes_count ) . esc_html__( '&nbsp;Likes', 'jobscout-pro' ) . '</span></div>';
    endif;
}
endif;

if( ! function_exists( 'jobscout_pro_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function jobscout_pro_get_home_sections(){
    $ed_banner     = get_theme_mod( 'ed_banner_section', 'static_banner' );
    $home_sections = get_theme_mod( 'front_sort', array( 'popular', 'job-posting', 'step', 'cta', 'blog', 'testimonial', 'client' ) );
    
    $enabled_section = array();
    
    if( $ed_banner != 'no_banner' ) array_push( $enabled_section, 'banner' );
    
    foreach( $home_sections as $v ){
        array_push( $enabled_section, $v );
    } 
    
    return apply_filters( 'jobscout_pro_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'jobscout_pro_get_jobs_list' ) ) :
/**
 * Related Posts 
*/
function jobscout_pro_get_jobs_list( $type = 'latest' ){ 
    global $post;
    
    $jobs_args = array(
        'post_type'      => 'job_listing',
        'posts_status'   => 'publish',
        'posts_per_page' => 3,
        'meta_query'     => array(
            'relation' => 'AND',
                array(
                    'key'     => '_job_expires',
                    'value'   => 0,
                    'compare' => '>',
                ),
                array(
                    'key'     => '_job_expires',
                    'value'   => date( 'Y-m-d', current_time( 'timestamp' ) ),
                    'compare' => '>',
                ),
        ),
    );

    switch( $type ){
                        
        case 'latest' :
            $section_title          = get_theme_mod( 'page_404_latest_jobs_title', __( 'Recommended Jobs', 'jobscout-pro' ) );
        break;

        case 'related' :
            $section_title             = get_theme_mod( 'related_job_title', __( 'Similar Jobs', 'jobscout-pro' ) );
            $job_taxomony              = get_theme_mod( 'related_job_taxonomy', 'job_type' );
            $jobs_args['post__not_in'] = array( $post->ID );
            $jobs_args['orderby']      = 'rand';

            $job_terms = null;

            if( 'job_type' == $job_taxomony ){
                if ( get_option( 'job_manager_enable_types' ) ) {
                    $job_terms = get_the_terms( $post->ID, 'job_listing_type' );

                    if( ! is_null( $job_terms ) ) {
                        $term_id = $job_terms[0]->term_id;
                        $term_args = array(
                            'taxonomy' => 'job_listing_type',
                            'field'    => 'tag_ID',
                            'terms'    => $term_id
                        ); 
                        $jobs_args['tax_query']  = $term_args;
                    }
                }
            } else {
                if ( get_option( 'job_manager_enable_categories' ) ) {
                    $job_terms = get_the_terms( $post->ID, 'job_listing_category' );
                    
                    if( ! is_null( $job_terms ) ) {
                        $term_id = $job_terms[0]->term_id;
                        $term_args = array(
                            'taxonomy' => 'job_listing_category',
                            'field'    => 'tag_ID',
                            'terms'    => $term_id
                        ); 
                        $jobs_args['tax_query']  = $term_args;
                    }
                }
            }

        break;
    }
        
    $job_qry = new WP_Query( $jobs_args );

    // echo '<pre>';
    // print_r( $job_qry );
    // echo '</pre>';

    if( $job_qry->have_posts() ){ ?>  
        <section class="additional-posts">  
            
            <?php if( $section_title ) echo '<h2 class="section-title">'. esc_html( $section_title ) .'</h2>'; ?>
            
            <div class="article-wrap">
            <?php
                while ( $job_qry->have_posts() ){
                    $job_qry->the_post();

                        $wpjm_activated = is_wpjm_extra_field_activated();
                        $company_name   = get_post_meta( get_the_ID(), '_company_name', true );
                        $job_location   = get_post_meta( get_the_ID(), '_job_location', true);
                        $job_featured   = get_post_meta( get_the_ID(), '_featured', true );
                        $job_salary     = $wpjm_activated ? get_post_meta( get_the_ID(), '_job_salary', true ) : '';
                        ?>
                        <article class="post">
                            <figure class="company-logo">
                                <a href="<?php the_permalink(); ?>">
                                <?php 
                                   the_company_logo( 'thumbnail' ); 
                                ?>
                                </a>
                            </figure>
                            <div class="job-title-wrap">
                                <h1 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h1>
                                <?php 
                                    if( $company_name ) echo '<div class="company-name">'. sprintf( '%1$s %2$s', esc_html__( '@', 'jobscout-pro' ), esc_html( $company_name ) ) .'</div>';
                                ?>
                               
                                <div class="entry-meta">
                                    <?php 
                                        if( $job_salary ){
                                            echo '<div class="salary-amt">
                                                <span class="currency"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M334.89 121.63l43.72-71.89C392.77 28.47 377.53 0 352 0H160.15c-25.56 0-40.8 28.5-26.61 49.76l43.57 71.88C-9.27 240.59.08 392.36.08 412c0 55.23 49.11 100 109.68 100h292.5c60.58 0 109.68-44.77 109.68-100 0-19.28 8.28-172-177.05-290.37zM160.15 32H352l-49.13 80h-93.73zM480 412c0 37.49-34.85 68-77.69 68H109.76c-42.84 0-77.69-30.51-77.69-68v-3.36c-.93-59.86 20-173 168.91-264.64h110.1C459.64 235.46 480.76 348.94 480 409zM285.61 310.74l-49-14.54c-5.66-1.62-9.57-7.22-9.57-13.68 0-7.86 5.76-14.21 12.84-14.21h30.57a26.78 26.78 0 0 1 13.93 4 8.92 8.92 0 0 0 11-.75l12.73-12.17a8.54 8.54 0 0 0-.65-13 63.12 63.12 0 0 0-34.17-12.17v-17.6a8.68 8.68 0 0 0-8.7-8.62H247.2a8.69 8.69 0 0 0-8.71 8.62v17.44c-25.79.75-46.46 22.19-46.46 48.57 0 21.54 14.14 40.71 34.38 46.74l49 14.54c5.66 1.61 9.58 7.21 9.58 13.67 0 7.87-5.77 14.22-12.84 14.22h-30.61a26.72 26.72 0 0 1-13.93-4 8.92 8.92 0 0 0-11 .76l-12.84 12.06a8.55 8.55 0 0 0 .65 13 63.2 63.2 0 0 0 34.17 12.17v17.55a8.69 8.69 0 0 0 8.71 8.62h17.41a8.69 8.69 0 0 0 8.7-8.62V406c25.68-.64 46.46-22.18 46.57-48.56.02-21.5-14.13-40.67-34.37-46.7z"></path></svg></span>
                                                <span class="salary">'. esc_html( $job_salary ) .'</span>
                                            </div>';
                                        }

                                        if( $job_location ){ 
                                            echo '<div class="company-address">
                                            <i class="fas fa-map-marker-alt"></i>'. esc_html( $job_location ) .'</div>';
                                        }

                                        if ( get_option( 'job_manager_enable_types' ) ) { 
                                            echo '<div class="job-type">';
                                                $types = wpjm_get_the_job_types(); 
                                                if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
                                                    <span class="btn <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></span>
                                                <?php endforeach; endif;
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php if( $job_featured ){ ?>
                                <div class="featured-label"><?php esc_html_e( 'Featured', 'jobscout-pro' ); ?></div>
                            <?php } ?>
                        </article>
                    <?php
                }
                wp_reset_postdata();
            echo '<div><!-- .article-wrap -->';
        echo '</section><!-- .additional-posts -->';
    }   
}
endif;             

if( ! function_exists( 'jobscout_pro_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function jobscout_pro_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'jobscout_pro_fallback_svg_image' ) ) :
/**
 * Prints Fallback Images
*/
function jobscout_pro_fallback_svg_image( $post_thumbnail ){
    $fallback_svg = get_theme_mod( 'fallback_svg', '#f0f0f0' );

    if( ! $post_thumbnail ){
       return;
   }
   
   $image_size = jobscout_pro_get_image_sizes( $post_thumbnail );

   if( $image_size ){ ?>
       <div class="svg-holder">
            <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                   <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:<?php echo esc_attr( $fallback_svg ); ?>;"></rect>
           </svg>
       </div>
       <?php
   }
}
endif;

if ( ! function_exists( 'jobscout_pro_apply_theme_shortcode' ) ) :
/**
 * Footer Shortcode
*/
function jobscout_pro_apply_theme_shortcode( $string ) {
    if ( empty( $string ) ) {
        return $string;
    }
    $search = array( '[the-year]', '[the-site-link]' );
    $replace = array(
        date_i18n( esc_html__( 'Y', 'jobscout-pro' ) ),
        '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
    );
    $string = str_replace( $search, $replace, $string );
    return $string;
}
endif;

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Query Jetpack activation
*/
function is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}

/**
 * Query WP Job Manager activation
 */
function is_wp_job_manager_activated() {
    return class_exists( 'WP_Job_Manager' ) ? true : false;
}

/**
 * Query WPJM Extra Fields activation
*/
function is_wpjm_extra_field_activated( ){
    return function_exists( 'gma_wpjmef_display_job_salary_data' ) ? true : false;
}

/**
 * Query Rara theme companion activation
 */
function is_rara_theme_companion_activated() {
    return class_exists( 'Raratheme_Companion_Public' ) ? true : false;
}

if( ! function_exists( 'jobscout_pro_posts_per_page_count' ) ):
/**
*   Counts the Number of total posts in Archive, Search and Author
*/
function jobscout_pro_posts_per_page_count(){
    $pagination = get_theme_mod( 'pagination_type','numbered' );
    global $wp_query;
    if( is_archive() || is_search() && $wp_query->found_posts > 0 ) {
        if( $pagination != 'infinite_scroll' && $pagination != 'load_more' ) :
            $posts_per_page = get_option( 'posts_per_page' );
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $start_post_number = 0;
            $end_post_number   = 0;

            if( $wp_query->found_posts > 0 && !( is_woocommerce_activated() && is_shop() ) ):                
                $start_post_number = 1;
                if( $wp_query->found_posts < $posts_per_page  ) {
                    $end_post_number = $wp_query->found_posts;
                }else{
                    $end_post_number = $posts_per_page;
                }

                if( $paged > 1 ){
                    $start_post_number = $posts_per_page * ( $paged - 1 ) + 1;
                    if( $wp_query->found_posts < ( $posts_per_page * $paged )  ) {
                        $end_post_number = $wp_query->found_posts;
                    }else{
                        $end_post_number = $paged * $posts_per_page;
                    }
                }

                printf( esc_html__( '%1$s Showing:  %2$s - %3$s of %4$s Items %5$s', 'jobscout-pro' ), '<span class="showing-result">', absint( $start_post_number ), absint( $end_post_number ), esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
            endif;
        else :
            printf( esc_html__( '%1$s Showing: %2$s Items %3$s', 'jobscout-pro' ), '<span class="post-count">', esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
        endif;
    }
}
endif;

if( ! function_exists( 'jobscout_pro_get_image_sizes' ) ) :
/**
* Get information about available image sizes
*/
function jobscout_pro_get_image_sizes( $size = '' ) {

   global $_wp_additional_image_sizes;

   $sizes = array();
   $get_intermediate_image_sizes = get_intermediate_image_sizes();

   // Create the full array with sizes and crop info
   foreach( $get_intermediate_image_sizes as $_size ) {
       if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
           $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
           $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
           $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
       } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
           $sizes[ $_size ] = array(
               'width' => $_wp_additional_image_sizes[ $_size ]['width'],
               'height' => $_wp_additional_image_sizes[ $_size ]['height'],
               'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
           );
       }
   }
   // Get only 1 size if found
   if ( $size ) {
       if( isset( $sizes[ $size ] ) ) {
           return $sizes[ $size ];
       } else {
           return false;
       }
   }
   return $sizes;
}
endif;

function jbp_show_error_messages() {
    if($codes = jbp_errors()->get_error_codes() ) {
        echo '<div class="jbp_errors">';
            // Loop error codes and display errors
           foreach($codes as $code){
                $message = jbp_errors()->get_error_message($code);
                echo '<span class="error"><strong>' . __( 'Error', 'jobscout-pro' ) . '</strong>: ' . $message . '</span><br/>';
            }
        echo '</div>';
    }   
}

function jbp_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;