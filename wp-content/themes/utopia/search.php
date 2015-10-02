<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */
get_header();
?>



    <div class="col-sm-9 col-xs-12" id="content">

        <?php if (have_posts()) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php printf(__('Search Results for: %s', 'utopia'), '<span>' . get_search_query() . '</span>'); ?></h1>
            </header>

            <?php utopia_content_nav('nav-above'); ?>

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile; ?>

            <?php utopia_content_nav('nav-below'); ?>

        <?php else : ?>

            <article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h1 class="entry-title"><?php _e('Nothing Found', 'utopia'); ?></h1>
                </header>

                <div class="entry-content">
                    <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'utopia'); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->

        <?php endif; ?>

    </div><!-- #content -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>