<?php
/**
 * Custom Child Theme Functions
 *
 * This file's parent directory can be moved to the wp-content/themes directory 
 * to allow this Child theme to be activated in the Appearance - Themes section of the WP-Admin.
 *
 * Included is a basic theme setup that will add support for custom header images and custom 
 * backgrounds. There are also a set of commented theme supports that can be uncommented if you need
 * them for backwards compatibility. If you are starting a new theme, these legacy functionality can be deleted.  
 *
 * More ideas can be found in the community documentation for Thematic
 * @link http://docs.thematictheme.com
 *
 * @package ThematicSamplephotocrati_obscura
 * @subpackage ThemeInit
 */


/* The Following add_theme_support functions 
 * will enable legacy Thematic Features
 * if uncommented.
 */
 
// add_theme_support( 'thematic_legacy_feedlinks' );
// add_theme_support( 'thematic_legacy_body_class' );
// add_theme_support( 'thematic_legacy_post_class' );
// add_theme_support( 'thematic_legacy_comment_form' );
// add_theme_support( 'thematic_legacy_comment_handling' );

/**
 * Define theme setup
 */
function photocrati_obscura_setup() 
{	
	/*
	 * Add support for custom background
	 * 
	 * Allow users to specify a custom background image or color.
	 * Requires at least WordPress 3.4
	 * 
	 * @link http://codex.wordpress.org/Custom_Backgrounds Custom Backgrounds
	 */
	add_theme_support( 'custom-background' );
	
	
	/**
	 * Add support for custom headers
	 * 
	 * Customize to match your child theme layout and style.
	 * Requires at least WordPress 3.4
	 * 
	 * @link http://codex.wordpress.org/Custom_Headers Custom Headers
	 */
	add_theme_support( 'custom-header', array(
		// Header image default
		'default-image' => '',
		// Header text display default
		'header-text' => true,
		// Header text color default
		'default-text-color' => 'FFF',
		// Header image width (in pixels)
		'width'	=> '400',
		// Header image height (in pixels)
		'height' => '110',
		// Header image random rotation default
		'random-default' => false,
		// Template header style callback
		'wp-head-callback' => 'photocrati_obscura_header_style',
		// Admin header style callback
		'admin-head-callback' => 'photocrati_obscura_admin_header_style'
		) 
	);
	
	add_action('thematic_header', 'photocrati_obscura_header_open', 0);
	add_action('thematic_header', 'photocrati_obscura_header_close', 10);
	remove_action('thematic_header', 'thematic_blogdescription', 5);
	
	add_action('thematic_abovemainasides', 'photocrati_obscura_abovemainasides');
	add_action('thematic_belowmainasides', 'photocrati_obscura_belowmainasides');
	
	add_filter('thematic_theme_default_opt', 'photocrati_obscura_default_opt');
	add_filter('thematic_theme_link', 'photocrati_obscura_theme_link');
	
	add_filter('list_comments_arg', 'photocrati_obscura_theme_list_comments_arg');
	
	add_filter('thematic_widgetized_areas', 'photocrati_obscura_widgetized_areas');
	
	add_filter('thematic_postheader', 'photocrati_obscura_postheader');
	
	add_filter('thematic_post_thumbs', '__return_false');
	
	add_filter('thematic_open_footer', 'photocrati_obscura_open_footer');
	add_filter('thematic_close_footer', 'photocrati_obscura_close_footer');
}

function photocrati_obscura_register_widgets()
{
    register_widget( 'WP_Widget_Meta' );
    register_widget( 'WP_Widget_Search' );
}

add_action('thematic_child_init', 'photocrati_obscura_setup');
add_action('widgets_init', 'photocrati_obscura_register_widgets', 15 );

function photocrati_obscura_header_open() 
{
	echo '<div id="masthead">';
}

function photocrati_obscura_header_close() 
{
	echo '</div>';
}

function childtheme_override_blogtitle()
{
?>

	<div id="blog-title"><span><a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home"><h1><?php bloginfo('name') ?></h1><div class="description"><?php bloginfo('description') ?></div></a></span></div>

<?php 
}

function childtheme_override_access() { 
?>

<div id="menu_wrapper">

	<?php 
	if ( ( function_exists("has_nav_menu") ) && ( has_nav_menu( apply_filters('thematic_primary_menu_id', 'primary-menu') ) ) ) {
	    echo  wp_nav_menu(thematic_nav_menu_args());
	} else {
	    echo  thematic_add_menuclass(wp_page_menu(thematic_page_menu_args()));	
	}
	?>
	
</div><!-- #access -->
<?php 
}

function photocrati_obscura_abovemainasides()
{
	echo '<div id="sidebar">';
}

function photocrati_obscura_belowmainasides()
{
	echo '</div>';
}

function childtheme_override_postheader_postmeta()
{
		$postmeta  = "\n\t\t\t\t\t";
	    $postmeta .= '<div class="entry-meta">' . "\n\n";
	
	    $entrydate = '<span class="meta-prep meta-prep-entry-date"></span>';
	    $entrydate .= '<span class="entry-date"><abbr class="published" title="';
	    $entrydate .= get_the_time(thematic_time_title()) . '">';
	    $entrydate .= get_the_time(thematic_time_display());
	    $entrydate .= '</abbr></span>';
	    
	    $postmeta .= "\t" . $entrydate . "\n\n";
	    $postmeta .= "\t" . thematic_postmeta_authorlink() . "\n\n";
	    
	    $postmeta .= "\t" . thematic_postmeta_editlink() . "\n\n";
	                   
	    $postmeta .= '</div><!-- .entry-meta -->' . "\n";
	    
	    return apply_filters('thematic_postheader_postmeta',$postmeta);
}

function childtheme_override_postheader_postmeta2()
{
?>
	
            <div class="entry-meta">
                <?php echo thematic_postmeta_authorlink(); ?>
                <span class="meta-sep"> | </span>
                <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'obscura'); ?></span>
                <div class="entry-date">
                    <div class="month m-<?php the_time('m') ?>"><?php the_time('M') ?></div>
                    <div class="day d-<?php the_time('d') ?>"><?php the_time('d') ?></div>
                    <div class="year y-<?php the_time('Y') ?>"><?php the_time('Y') ?></div></div>
                <?php echo thematic_postmeta_editlink(); ?>
            </div><!-- .entry-meta -->
<?php 
}

function childtheme_override_postfooter()
{
?>
            <div class="entry-utility">
                <?php printf( __( 'Posted in %1$s%2$s.', 'obscura' ),
                    get_the_category_list(', '),
                    get_the_tag_list( __( ' Tagged ', 'obscura' ), ', ', '' ),
                    get_permalink(),
                    the_title_attribute('echo=0'),
                    get_post_comments_feed_link() ) ?>

                <?php edit_post_link( __( 'Edit', 'obscura' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" ) ?>

            </div><!-- .entry-utility -->
<?php 
}

function photocrati_obscura_theme_list_comments_arg($content)
{
	return 'type=comment&callback=photocrati_obscura_comments';
}

// Produces an avatar image with the hCard-compliant photo class
function photocrati_obscura_commenter_link() 
{
    $commenter = get_comment_author_link();
    if ( preg_match( '/<a[^>]* class=[^>]+>/i', $commenter ) ) {
        $commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/i', '$1url ' , $commenter );
    } else {
        $commenter = preg_replace( '/(<a )\\//i', '$1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
    echo ' <a href="'.get_comment_author_url().'" title="Comment Author" target="_blank">'.$avatar .'</a>';
}

function photocrati_obscura_comments($comment, $args, $depth) 
{
    $GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
?>
    
       	<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    	
    		<?php 
    			// action hook for inserting content above #comment
    			thematic_abovecomment();
    		?>
    <div class="comment-wrapper">
    		
        <div class="comment-author vcard"><?php photocrati_obscura_commenter_link() ?></div>
        
        <div class="content-wrapper">
            <div class="comment-meta"><?php printf(__('<a class="commentauthor" href="%4$s" title="Comment Author" target="_blank">%3$s</a> <span class="commentdate">%1$s at %2$s</span> <a class="commentpermalink" href="%5$s" title="Permalink to this comment">#</a>', 'obscura'),
                    get_comment_date(),
                    get_comment_time(),
                    get_comment_author(),
                    get_comment_author_url(),
                    '#comment-' . get_comment_ID() );
                edit_comment_link(__('Edit', 'obscura'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
            <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'obscura') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
        </div>
    		
			<?php // echo the comment reply link with help from Justin Tadlock http://justintadlock.com/ and Will Norris http://willnorris.com/
				
				if( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
					comment_reply_link( array_merge( $args, array(
						'reply_text' => __( 'Reply','obscura' ), 
						'login_text' => __( 'Log in to reply.','obscura' ),
						'depth'      => $depth,
						'before'     => '<div class="comment-reply-link">', 
						'after'      => '</div>'
					)));
				endif;
			?>
		
		</div>
		
			<?php
				// action hook for inserting content above #comment
				thematic_belowcomment() 
			?>
			
			</li>

<?php }

function photocrati_obscura_default_opt($opt)
{
	$opt['footer_txt'] = 'Powered by [theme-link].';
	
	return $opt;	
}

function photocrati_obscura_theme_link($themelink)
{
    $themelink = '<a class="theme-link" href="http://www.photocrati.com/obscura-free-photography-theme/" title="Obscura Free Theme">Obscura</a>';
    
    return $themelink;
}


function photocrati_obscura_widgetized_areas($widgets)
{
	$widgets['Primary Aside']['args']['name'] = 'Top Sidebar';
	$widgets['Secondary Aside']['args']['name'] = 'Bottom Sidebar';
	
	$widgets['1st Subsidiary Aside']['args']['name'] = 'Footer #1';
	$widgets['2nd Subsidiary Aside']['args']['name'] = 'Footer #2';
	$widgets['3rd Subsidiary Aside']['args']['name'] = 'Footer #3';
	
	return $widgets;
}


function photocrati_obscura_postheader($header)
{
	$out = null;
	
	if ( has_post_thumbnail() ) {
		$out = sprintf('<div class="entry-featured-slice"><a class="entry-thumb" href="%s" title="%s">%s</a></div>',
						get_permalink() ,
						sprintf( esc_attr__('Permalink to %s', 'obscura'), the_title_attribute( 'echo=0' ) ),
						get_the_post_thumbnail(get_the_ID(), 'full'));
	}
	
	return $header . $out;
}


function photocrati_obscura_open_footer($markup)
{
	return '
<div class="footer_wrapper">' . $markup . '<div id="footer-widgets" class="footer-widget-area">';
}

function photocrati_obscura_close_footer($markup)
{
	return '</div>' . $markup . '</div>';
}

/**
 * Custom Image Header Front-End Callback
 *
 * Defines the front-end style definitions for 
 * the custom image header.
 * This style declaration will be output in the <head> of the
 * document just before the closing </head> tag.
 * Inline Syles and !important declarations 
 * can be used to override these styles.
 *
 * @link http://codex.wordpress.org/Function_Reference/get_header_image get_header_image()
 * @link http://codex.wordpress.org/Function_Reference/get_header_textcolor get_header_textcolor()
 */
function photocrati_obscura_header_style() 
{
	?>	
	<style type="text/css">
	<?php
	/* Declares the header image from the settings
	 * saved in WP-Admin > Appearance > Header
	 * as the background-image for div#branding.
	 */
	if ( get_header_image() && HEADER_IMAGE != get_header_image() ) {
		?>
		#branding {
			background:url('<?php header_image(); ?>') no-repeat center center;
			margin-bottom:28px;
    		overflow: visible;
    	padding: 25px 0 0 0;
    	background-size: 400px auto;
		}
		<?php if ( 'blank' != get_header_textcolor() ) { ?>
		#blog-description {	
			padding-bottom: 22px;
		}
		<?php
		}
		
	}
	?>
	<?php
	/* This delcares text color for the Blog title and Description
	 * from the settings saved in WP-Admin > Appearance > Header\
	 * If not set the deafault color is set to #000 
	 */
	if ( get_header_textcolor() && 'blank' != get_header_textcolor() ) {
		?>
		#blog-title a h1 {
			color:#<?php header_textcolor(); ?>;
		}
		<?php
	}
	/* Removes header text if the
	 * "Do not diplay header text…" setting is saved
	 * in WP-Admin > Appearance > Header
	 */
	if ( ! display_header_text() ) {
		?>
		#blog-title, #blog-title a, #blog-description {
			display:none;
		}
		#masthead { 
			height:	100%;
		}
		#branding { 
			height:	99%;
			padding: 0;
		}
		<?php
	}
	?>
	</style>
	<?php
}


/**
 * Custom Image Header Admin Callback
 *
 * Callback to defines the admin (back-end) style
 * definitions for the custom image header.
 * Customize the css to match your theme defaults.
 * The !important declarations override inline admin styles
 * to better represent a WYSIWYG of the front-end styling
 * that this child theme is currently designed to display.
 */
function photocrati_obscura_admin_header_style() {
	?>
	<style type="text/css">
	#headimg {
		background-position: left bottom; 
		background-repeat:no-repeat;
		border:0 !important;   
		height:auto !important;
		padding:0 0 <?php echo HEADER_IMAGE_HEIGHT + 22; /* change the added integer (22) to match your desired top padding */?>px 0;
		margin:0 0 28px 0;
	}
	
	#headimg h1 {
	    font-family:Arial,sans-serif;
	    font-size:34px;
	    font-weight:bold;
	    line-height:40px;
		margin:0;
	}
	#headimg a {
		color: #000;
		text-decoration: none;
	}
	#desc{
		font-family: Georgia;
    	font-size: 13px;
    	font-style: italic;
    }
	</style>
	<?php
}
