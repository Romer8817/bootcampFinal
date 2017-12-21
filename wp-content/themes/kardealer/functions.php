<?php
/**
 * car dealer functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package kardealer
 * @subpackage Kar_dealer
 * @since car dealer 1.0
 */
/**
 * car dealer only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
function kardealer_fallback_menu()
{
$args = array(
	'depth'       => 1,
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'menu-main-menu', // main-navigation',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => ''
);
//    wp_page_menu($args);
    if(is_admin())
    {
    echo'
    <ul>                  
        <li><a href="' . esc_url(admin_url('nav-menus.php')) . '">', _e( 'Set Up Your Menu', 'kardealer' ) . '</a></li>
    </ul>';
    } 
} 
define('kardealerURL', get_theme_file_uri() );
define('kardealerPATH', get_theme_file_path() );
$theme = wp_get_theme( );
define('kardealerVERSION', $theme->version );
define('SITEURL', esc_url(get_site_url() ));
if ( ! function_exists( 'kardealer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own kardealer_setup() function to override in a child theme.
 *
 * @since car dealer 1.0
 */
function kardealer_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/kardealer
	 * If you're building a theme based on car dealer, use a find and replace
	 * to change 'kardealer' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kardealer' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for custom logo.
	 *
	 *  @since car dealer 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kardealer' ),
		'social'  => __( 'Social Links Menu', 'kardealer' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', kardealer_fonts_url() ) );
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // kardealer_setup
add_action( 'after_setup_theme', 'kardealer_setup' );
/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since car dealer 1.0
 */
function kardealer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kardealer_content_width', 840 );
}
add_action( 'after_setup_theme', 'kardealer_content_width', 0 );
/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since car dealer 1.0
 */
function kardealer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kardealer' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'kardealer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar(array(
      		'name'          => __( 'First Footer Widget', 'kardealer' ),
            'id' => '1-footer',
      		'description'   => __( 'Add widgets here to appear in your left footer.', 'kardealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
        register_sidebar(array(
      		'name'          => __( 'Second Footer Widget', 'kardealer' ),
            'id' => '2-footer',
      		'description'   => __( 'Add widgets here to appear in your center footer.', 'kardealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
            register_sidebar(array(
      		'name'          => __( 'Third Footer Widget', 'kardealer' ),
            'id' => '3-footer',
      		'description'   => __( 'Add widgets here to appear in your right footer.', 'kardealer' ),
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            ));
}
add_action( 'widgets_init', 'kardealer_widgets_init' );
if ( ! function_exists( 'kardealer_fonts_url' ) ) :
/**
 * Register Google fonts for car dealer.
 *
 * Create your own kardealer_fonts_url() function to override in a child theme.
 *
 * @since car dealer 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function kardealer_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'kardealer' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}
	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'kardealer' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}
	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'kardealer' ) ) {
		$fonts[] = 'Inconsolata:400';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since car dealer 1.0
 */
function kardealer_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'kardealer_javascript_detection', 0 );
/**
 * Enqueues scripts and styles.
 *
 * @since car dealer 1.0
 */
function kardealer_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'kardealer-fonts', kardealer_fonts_url(), array(), null );
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	// Theme stylesheet.
	wp_enqueue_style( 'kardealer-style', get_stylesheet_uri() );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'kardealer-ie', get_template_directory_uri() . '/css/ie.css', array( 'kardealer-style' ), '20160816' );
	wp_style_add_data( 'kardealer-ie', 'conditional', 'lt IE 10' );
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'kardealer-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'kardealer-style' ), '20160816' );
	wp_style_add_data( 'kardealer-ie8', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'kardealer-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'kardealer-style' ), '20160816' );
	wp_style_add_data( 'kardealer-ie7', 'conditional', 'lt IE 8' );
	// Load the html5 shiv.
	wp_enqueue_script( 'kardealer-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'kardealer-html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'kardealer-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'kardealer-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}
	wp_enqueue_script( 'kardealer-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );
	wp_localize_script( 'kardealer-script', 'kardealer_screenReaderText', array(
		'expand'   => __( 'expand child menu', 'kardealer' ),
		'collapse' => __( 'collapse child menu', 'kardealer' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'kardealer_scripts' );
/**
 * Tiny MCE Extra Buttons
 *
 * @since kardealer 1.0
 *
 */
if ( ! function_exists( 'kardealer_wp_mce_buttons' ) ) {
    function kardealer_wp_mce_buttons( $buttons ) {
        array_unshift( $buttons, 'fontselect' ); // Add Font Select
        array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
       	array_unshift( $buttons, 6,0, 'backcolor' ); 
        return $buttons;
    }
}
add_filter( 'mce_buttons_2', 'kardealer_wp_mce_buttons' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @since car dealer 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function kardealer_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'kardealer_body_classes' );
/**
 * Converts a HEX value to RGB.
 *
 * @since car dealer 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function kardealer_hex2rgb( $color ) {
	$color = trim( $color, '#' );
	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/pinstaller.php';
require get_template_directory() . '/inc/customizer.php';
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since car dealer 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function kardealer_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];
	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'kardealer_content_image_sizes_attr', 10 , 2 );
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since car dealer 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function kardealer_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'kardealer_post_thumbnail_sizes_attr', 10 , 3 );
/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since car dealer 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function kardealer_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'kardealer_widget_tag_cloud_args' );
function kardealer_sanitizehtml( $str ) {
    $allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
        wp_kses($str, $allowed_html); 
        return trim($str);
    } 
/**
 * Add support to WooCommerce
 *
 * @since kardealer 1.0
 *
 */
function kardealer_wrapper_start() {
  echo '<section id="main">';
}
function kardealer_wrapper_end() {
  echo '</section>';
} 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'kardealer_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'kardealer_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'kardealer_remove_sidebar' );
    function kardealer_remove_sidebar()
    {
        if ( is_shop() ) { 
         remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
       }
    }
add_action( 'after_setup_theme', 'kardealer_woocommerce_support' );
function kardealer_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}  
// End WooCommerce
function kardealer_customize_control_js() {
    wp_enqueue_script( 'kardealer_customizer_control', kardealerURL . '/js/customizer-control.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'kardealer_customize_control_js' );
   function kardealer_dashboard_help() {
                echo '<div style="text-align: center">';
                echo '<img src="'.kardealerURL.'/images/infox350.png" style="text-align:center; width:100%; margin: 0px 0 auto;"  />';
                echo '<a target="blank" href="http://kardealertheme.com">';
                echo '<img id="kardealer-logo-dashboard" src="'.kardealerURL.'/images/logo.png" style="max-width: 300px;" />';
                echo '</a>';
                $bd_msg = '<br /><br />';
                // $bd_msg .= '<h3>For details and help, take a look at our Help Page at your left menu';
                $bd_msg .= '<center><h3>For details, support and help, visit our site.</h3></center>';
               // $bd_msg .= '<br />';
               // $bd_msg .= 'Appearance => kardealer Theme Help';
                $bd_msg .= '<br /><br />'; 
                // $bd_msg = '  <a <a class="button button-primary" target="blank" href="'.SITEURL.'/wp-admin/themes.php?page=kar_dealer"> Help Page</a>';
                $bd_msg .= '&nbsp;&nbsp;&nbsp;'; 
                $bd_msg .= '<a href="'.SITEURL.'/wp-admin/themes.php?page=kar_dealer" class="button button-primary">Theme Help</a>';
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '  <a class="button button-primary" target="blank" href="http://kardealertheme.com">Visit Our Site</a>';
                $bd_msg .=  $bd_url;
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '<a class="button button-primary" target="blank" href="http://kardealertheme.com/help/index.html">OnLine Guide</a>';
                $bd_msg .=  $bd_url; 
                // $bd_msg .= ', Support, Demo Video and more.';
                echo $bd_msg;
                echo "</p>";
                echo "</h3>";
                echo "</div>";
   }
    function kardealer_add_dashboard_widgets() 
    {
      add_meta_box('kardealer-dashboard', 'Kar Dealer Theme Help and Support', 'kardealer_dashboard_help', 'dashboard', 'normal', 'high');
    }
  add_action("wp_dashboard_setup", "kardealer_add_dashboard_widgets");
function kardealer_admin_notice() {
                echo '<div class="updated"><p>';
                echo '<br />';
                echo '<img src="'.get_template_directory_uri().'/images/infox350.png" />';
                $bd_msg = '<h2>Welcome.  KarDealer Theme was activated! </h2>';
                $bd_msg .= '<h3>For details and help, take a look at our Help Page at your left menu Appearance => Kar Dealer Help';
                $bd_url = '  <a class="button button-primary" href="'.SITEURL.'/wp-admin/themes.php?page=kar_dealer"> or click here</a>';
                $bd_msg .= '<br />';
                $bd_msg .=  $bd_url;
                echo $bd_msg;
                echo "</p>";
                echo "</h3></div>";
}
function kardealer_theme_was_activated() {
        add_action('admin_notices', 'kardealer_admin_notice');
        $bill_installed = trim(get_option( 'bill_installed',''));
        if(empty($bill_installed)){
            add_option( 'bill_installed', time() );
            update_option( 'bill_installed', time() );
     } 
    }
if(is_admin())
{
    add_action("after_switch_theme", "kardealer_theme_was_activated");
    /*
    require_once (kardealerPATH . '/inc/activated-manager.php');
    require_once (kardealerPATH . "/inc/feedback-last.php");
    if(memory_status())   
       require_once(kardealerPATH . '/inc/feedback.php');
    */   
    require_once kardealerPATH . '/inc/help.php';
   function kardealer_custom_dashboard_help() {
                echo '<div class="kardealer-center">';
                echo '<img src="'.get_template_directory_uri().'/images/infox350.png" style="text-align:center; width:100%; margin: 0px 0 auto;"  />';
                echo '<a target="blank" href="http://kardealertheme.com">';
                echo '<img src="'.get_template_directory_uri().'/images/logo.png" style="text-align:center; width:70%; margin: 0px 0 auto;"  />';
                echo '</a>';
                $bd_msg = '<h3>For details and help, take a look at our Help Page at your left menu';
                $bd_msg .= '<br />';
                $bd_msg .= 'Appearance => KarDealer Theme Help';
                $bd_msg .= '<br /><br />'; 
                $bd_msg .= '  <a <a class="button button-primary" target="blank" href="'.SITEURL.'/wp-admin/themes.php?page=kar_dealer"> Help Page</a>';
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '  <a class="button button-primary" target="blank" href="http://kardealertheme.com">Visit Our Site</a>';
                $bd_msg .=  $bd_url;
                $bd_msg .= '&nbsp;&nbsp;&nbsp;';
                $bd_url = '<a class="button button-primary" target="blank" href="http://kardealertheme.com/help/index.html">OnLine Guide</a>';
                $bd_msg .=  $bd_url;       
                // $bd_msg .= ', Support, Demo Video and more.';
                echo $bd_msg;
                echo "</p>";
                echo "</h3>";
                echo "</div>";
   }
    function kardealer_memory_notice() {
        if(isset($_GET["tab"]))
        {
            if (strip_tags($_GET["tab"]) == 'memory')
                return;
        }
                    echo '<div class="update-nag"><p>';
                    echo '<img width="100px" src="'.get_template_directory_uri().'/images/lock.png" />';
                    $bd_msg = '<h1>Kar Dealer Theme running  in save memory mode.</h1>';
                    $bd_msg .= '<h3>To release all theme power, please, increase the WordPress memory limit.';
                    $bd_msg .= ' For details and help, take a look at our Help Page (memory tab) at your left menu Appearance => Kar Dealer Help';
                    $bd_url = '  <a class="button button-primary" target="blank" href="'.SITEURL.'/wp-admin/themes.php?page=kar_dealer&tab=memory"> or click here</a>';
                    $bd_msg .= '<br />';
                    $bd_msg .=  $bd_url;
                    echo $bd_msg;
                    echo "</p>";
                    echo "</h3></div>";
    }
    if(! memory_status())
      add_action( 'admin_notices', 'kardealer_memory_notice' );
}
if (get_site_option('kardealer_update_theme', '0') == '1')
  add_filter( 'auto_update_theme', '__return_true' );
if ( ! function_exists( 'kardealer_import_files' ) ) :
 function kardealer_import_files() {
    $important_notice = 'Important Notes:
    <br>
    We recommend to run the Demo Import on a clean WordPress installation.
    <br>
    To reset your installation (if the import fails) we recommend <a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">Wordpress Reset Plugin</a>.
    <br>
    Do not run the Demo Import multiple times, it will result in duplicated content.
    <br>
    After you import this demo, you will have to setup the slider separately.';
    return array(
        array(
            'import_file_name'           => 'Demo Import 1',
            'import_file_url'            => 'http://www.kardealertheme.com/demo/demo-content.xml',
            'import_widget_file_url'     => 'http://www.kardealertheme.com/demo/widgets.json',
            'import_customizer_file_url' => 'http://www.kardealertheme.com/demo/customizer.dat',
            'import_notice'              => $important_notice,
        ),
    );
}
endif;
add_filter( 'pt-ocdi/import_files', 'kardealer_import_files' );
if ( ! function_exists( 'kardealer_after_import' ) ) :
function kardealer_after_import( $selected_import ) {
         //Set Menu
         $social_menu = get_term_by('name', 'social menu', 'nav_menu');
         $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
        set_theme_mod( 'nav_menu_locations' , array( 
              'primary' => $main_menu->term_id,
              'top-menu' => $main_menu->term_id,  
              'social' => $social_menu->term_id 
             ) 
        );
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home' );
        $blog_page_id  = get_page_by_title( 'Blog' );
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'kardealer_after_import' );
endif;
// require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/class-customize.php' );
function memory_status()
{
    $ret = false;
    if(defined("WP_MEMORY_LIMIT"))
    {
      $wplimite =  trim(WP_MEMORY_LIMIT) ;
      $wplimite = substr($wplimite,0,strlen($wplimite)-1);
      if($wplimite >= 128)
         $ret = true;
    }
    return $ret; 
}
?>