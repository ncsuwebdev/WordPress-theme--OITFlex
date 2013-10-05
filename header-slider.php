<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );
	

	// Add the blog description for the home/front page.
	//$site_description = get_bloginfo( 'description', 'display' );
	//if ( $site_description && ( is_home() || is_front_page() ) )
	//	echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
    <!-- CORE CSS -->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<link rel="stylesheet" type="text/css" media="screen and (min-width: 769px)" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 768px)" href="<?php echo get_stylesheet_directory_uri(); ?>/css/tablet.css" />
<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="<?php echo get_stylesheet_directory_uri(); ?>/css/mobile.css" />
<!--<![endif]-->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/player.css" media="screen" rel="stylesheet" type="text/css" />

<!-- CORE JS -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/ariaTabs3b.js" type="text/javascript"></script>  
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<![endif]-->
<?php 
	/* PHP and js to fix keyboard focus behavior for nav */
	include("js/cc-accessible-dropdown-menus.php"); 
?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>


</head>

<body <?php body_class(); ?>>
				
<div id="page" class="hfeed">
	<header id="branding" role="banner">
			<hgroup>    
    			<h1 id="site-title" aria-level="1" role="heading"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
       			<h2 id="site-description" aria-level="2"><?php bloginfo( 'description' ); ?></h2>
            </hgroup>

<!-- begin image slider -->
	<?php query_posts( 'category_name=feature&&posts_per_page=5' ); ?>
       <?php if ( have_posts()) : ?>
    
       <div id="player">      
            <div id="tabs">
                
				<?php while ( have_posts() ) : the_post() ?>                         
                    <div id="tabs-<?php the_id() ?>">
                    	<?php if (has_post_thumbnail()): ?>
                            <div class="media crop">
									<?php the_post_thumbnail('wide-featured-thumbnail');?>
                                    <div class="caption">
                                    <div class="copy">
                                    	<h3><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'twentyeleven'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
                                        <?php the_excerpt( __( 'Read More <span class="meta-nav">&raquo;</span>', 'twentyeleven' ) ) ?>
                                    </div></div>
							 </div>
                           
                       <?php else: ?>    
                        <div class="copy">
                            <h3><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'twentyeleven'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
                            <?php the_excerpt( __( 'Read More <span class="meta-nav">&raquo;</span>', 'twentyeleven' ) ) ?>
                        </div>
                        <?php endif; ?>
                                               
                                                      
                    </div><!-- end tab -->
                <?php 
					endwhile;
					wp_reset_query(); 
				?>
                
                <div class="clear"></div>

                <ul>
                	<?php query_posts( 'category_name=feature&&posts_per_page=5' ); ?>
					<?php 
						$i=1;
						while ( have_posts() ) : the_post() ?>    
                        <li class="tab"><a href="#tabs-<?php the_id() ?>"><?php echo $i; ?></a></li>
                        <?php $i++; ?>
                    <?php 
						endwhile; 
						wp_reset_query()
					?>
                </ul>

            </div> <!-- end #tabs -->   
            
        </div> 
        <?php endif; ?>
<!-- end image slider -->

			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( ! empty( $header_image ) ) : ?> with-image<?php endif; ?>">
				<?php get_search_form(); ?>
				</div>
			<?php
				else :
			?>
				<?php get_search_form(); ?>
			<?php endif; ?>
            
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<a href="#" id="menu-icon"></a>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
	</header><!-- #branding -->


	<div id="main">