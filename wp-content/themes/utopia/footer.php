<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */
?>
</div><!--row-->
</div><!-- #main .wrapper -->
<div id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="second_wrapper">
                <?php dynamic_sidebar('sidebar-4'); ?>
                <div class="clearfix"></div>
            </div><!-- second_wrapper -->
        </div>
    </div>
    <footer id="colophon">
        <div class="container" role="contentinfo">
            <div class='row '>
                <div class="col-sm-6 copyright">
                   <?php if( get_theme_mod( 'hide_copyright' ) == '') { ?>
    <?php esc_attr_e('&copy;', 'responsive'); ?> <?php _e(date('Y')); ?><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
        <?php echo get_theme_mod( 'copyright_textbox','') ; ?>
    </a>
<?php } // end if ?>   
                </div><!-- .site-info -->
            </div>
        </div>
    </footer><!-- #colophon -->
</div>
</div>
<a href="#" class="back-to-top"></a>
<?php wp_footer(); ?>
</body>
</html>