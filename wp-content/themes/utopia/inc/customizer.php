<?php
/**
 * Theme Customizer settings.
 *
 * @package Utopia 
 * @since 1.7 
 */

/**
 * Theme customizer settings with real-time update
 * Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 *
 * @since 1.5
 */

function utopia_theme_customizer($wp_customize) {

    // Highlight and link color
    $wp_customize->add_setting('utopia_link_color', array(
        'default' => '#ffffff',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'utopia_link_color', array(
        'label' => __('Link and Highlight Color','utopia'),
        'section' => 'colors',
        'settings' => 'utopia_link_color',
    )));

    // Logo upload
    $wp_customize->add_section('utopia_logo_section', array(
        'title' => __('Logo', 'utopia'),
        'priority' => 30,
        'description' =>  __('Upload a logo to replace the default site name and description in the header','utopia')
    ));

    $wp_customize->add_setting('utopia_logo', array(
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'utopia_logo', array(
        'label' => __('Logo', 'utopia'),
        'section' => 'utopia_logo_section',
        'settings' => 'utopia_logo',
    )));
// Sidebar position
    $wp_customize->add_setting('sidebar_position', array('default' => 'right',
        'sanitize_callback' => 'utopia_sanitize_sidebar_placement'));
    $wp_customize->add_control('sidebar_position', array(
        'label' => __('Sidebar position', 'utopia'),
        'section' => 'layout',
        'settings' => 'sidebar_position',
        'type' => 'radio',
        'choices' => array(
            'left' => 'left',
            'right' => 'right',
        ),
    ));
    $wp_customize->add_section('layout', array(
        'title' => __('Layout', 'utopia'),
    ));

    $wp_customize->add_setting(
            'logo_placement', array(
        'default' => 'center',
        'sanitize_callback' => 'utopia_sanitize_logo_placement',
            )
    );

    $wp_customize->add_control(
            'logo_placement', array(
        'type' => 'radio',
        'label' => __('Logo placement', 'utopia'),
        'section' => 'utopia_logo_section',
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
            'center' => 'Center',
        ),
            )
    );
    $wp_customize->add_section('copyrigth_text', array(
        'title' => __('Copyrigth text', 'utopia')
    ));

    $wp_customize->add_setting(
            'copyright_textbox', array(
        'default' => __('Default copyright text', 'utopia'),
        'sanitize_callback' => 'utopia_sanitize_text',
            )
    );
    $wp_customize->add_control(
            'copyright_textbox', array(
        'label' => __('Copyright text', 'utopia'),
        'section' => 'copyrigth_text',
        'type' => 'text',
            )
    );

    $wp_customize->add_setting(
            'hide_copyright', array(
        'sanitize_callback' => 'utopia_sanitize_checkbox',
    ));

    $wp_customize->add_control(
            'hide_copyright', array(
        'type' => 'checkbox',
        'label' => __('Hide copyright text', 'utopia'),
        'section' => 'copyrigth_text',
            )
    );
    
   }

add_action('customize_register', 'utopia_theme_customizer');

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function utopia_sanitize_hex_color($color) {
    if ('' === $color)
        return '';

    // 3 or 6 hex digits, or the empty string.
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

    return null;
}



function utopia_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function utopia_sanitize_logo_placement($input) {
    $valid = array(
        'left' => 'Left',
        'right' => 'Right',
        'center' => 'Center',
    );

    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}


function utopia_sanitize_sidebar_placement($input) {
    $valid = array(
        'left' => 'Left',
        'right' => 'Right',
       
    );

    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

function utopia_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function utopia_add_customizer_css() {
    $color = utopia_sanitize_hex_color(get_theme_mod('utopia_link_color'));
    ?>
    <!-- Debut customizer CSS -->
    <style>
        body {
            border-color: <?php echo $color; ?>
        }
        a:visited {
            color: <?php echo $color; ?>
        }
        .main-navigation a:hover,
        .main-navigation .sub-menu a:hover,
        .main-navigation .children a:hover,
        .main-navigation a:focus,
        .main-navigation a:active,
        .main-navigation .current-menu-item > a,
        .main-navigation .current_page_item > a,
        .utopia-lang:hover {
            background-color: <?php echo $color; ?>
        }
    </style>
    <?php
}

add_action('wp_head', 'utopia_add_customizer_css');