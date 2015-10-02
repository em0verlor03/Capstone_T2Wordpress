<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Utopia loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */

get_header(); ?>
	
   
        <div class="col-lg-12 col-xs-12" id="content">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	
<?php get_footer(); ?>