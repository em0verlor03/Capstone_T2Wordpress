<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */
get_header();
?>



    <div class="col-sm-9 col-xs-12" id="content">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', get_post_format()); ?>

            <nav class="nav-single">
                <h3 class="assistive-text"><?php _e('Post navigation', 'utopia'); ?></h3>
                <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'utopia') . '</span> %title'); ?></span>
                <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'utopia') . '</span>'); ?></span>
            </nav><!-- .nav-single -->

            <?php comments_template('', true); ?>

        <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>