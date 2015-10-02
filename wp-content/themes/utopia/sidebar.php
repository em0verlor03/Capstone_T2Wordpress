<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Utopia
 * @since Utopia 1.0
 */
?>

<?php if (is_active_sidebar('sidebar-1')) : ?>
    
        <div id="sidebar" class="col-sm-3 col-xs-12">
		
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div><!-- #secondary -->
<?php endif; ?>