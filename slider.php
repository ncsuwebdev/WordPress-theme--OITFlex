<?php
/**
 * Template Name: Slider Template
 * Description: The Slider template can be used to display a slider in place of the header image that will profile all "feature" posts.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(slider); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	
        
<?php get_footer(); ?>