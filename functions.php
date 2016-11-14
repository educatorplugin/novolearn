<?php

// Include fonts functionality.
require get_template_directory() . '/inc/fonts.php';

// Set maximum content width for the theme.
if ( ! isset( $content_width ) ) {
	$content_width = 730;
}

/**
 * Theme setup.
 */
function novolearn_setup() {
	load_theme_textdomain( 'novolearn' );

	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'primary' => __( 'Top primary menu', 'novolearn' ),
		'auth'    => __( 'User menu', 'novolearn' ),
		'mobile'  => __( 'Mobile menu', 'novolearn' ),
		'footer'  => __( 'Footer menu', 'novolearn' ),
	) );

	add_image_size( 'novo_small', 350, 218, true );
	add_image_size( 'novo_content', 730, 454, true );
	add_image_size( 'novo_large', 1140, 708, true );
	add_image_size( 'novo_wide', 1140, 480, true );
}
add_action( 'after_setup_theme', 'novolearn_setup' );

/**
 * Enqueue scripts, styles, and fonts.
 */
function novolearn_enqueue_scripts() {
	$template_uri = get_template_directory_uri();

	// Enqueue fonts.
	$fonts_url = novolearn_get_fonts_url();

	if ( $fonts_url ) {
		wp_enqueue_style( 'novolearn-fonts', $fonts_url );
	}

	wp_enqueue_style( 'font-awesome', $template_uri . '/css/font-awesome.css', array(), '4.6.3' );
	wp_enqueue_style( 'novolearn', $template_uri . '/style.css', array(), '1.0.0' );
	wp_enqueue_style( 'novolearn-educator', $template_uri . '/css/educator.css', array(), '1.0.0' );

	wp_register_script( 'modernizr', $template_uri . '/js/modernizr-custom.js', array(), '3.3.1', true );
	wp_register_script( 'imagesloaded', $template_uri . '/js/imagesloaded.pkgd.js', array(), '4.1.1', true );
	wp_enqueue_script( 'super-nav', $template_uri . '/js/super-nav.js', array( 'jquery' ), '1.2.0', true );
	wp_enqueue_script( 'novolearn-educator', $template_uri . '/js/educator.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'novolearn', $template_uri . '/js/main.js', array( 'modernizr', 'jquery', 'imagesloaded' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'novolearn_enqueue_scripts' );

/**
 * Enqueue custom CSS.
 */
function novolearn_enqueue_custom_css() {
	$body_font = get_theme_mod( 'body_font', 'Open Sans' );
	$bold_font_weight = get_theme_mod( 'bold_font_weight', '700' );
	$headings_font_weight = get_theme_mod( 'headings_font_weight', '700' );
	$main_color = get_theme_mod( 'main_color', '#02b3e4' );
	$hover_color = get_theme_mod( 'hover_color', '#007898' );
	$body_color = get_theme_mod( 'body_color', '#555' );
	$headings_color = get_theme_mod( 'headings_color', '#222' );

	ob_start();
	include get_template_directory() . '/inc/custom-css.php';
	$custom_css = ob_get_clean();

	wp_add_inline_style( 'novolearn', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'novolearn_enqueue_custom_css' );

/**
 * Setup widget areas.
 */
function novolearn_widgets_init() {
	register_sidebar( array(
		'id'            => 'sidebar-main',
		'name'          => __( 'Main Sidebar', 'novolearn' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'novolearn_widgets_init' );

/**
 * Wrap more link into a container, remove #more tag.
 *
 * @param string $link
 * @return string
 */
function novolearn_content_more_link( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return '<p class="more-link-wrap">' . $link . '</p>';
}
add_filter( 'the_content_more_link', 'novolearn_content_more_link' );

/**
 * Set single font size for the tags in the tag cloud.
 *
 * @param array $args
 * @return array
 */
function novolearn_tag_cloud_args( $args ) {
	$args['smallest'] = 14;
	$args['largest'] = 14;
	$args['unit'] = 'px';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'novolearn_tag_cloud_args' );

/**
 * Wrap the oembed videos into a responsive HTML container.
 *
 * @param string $html
 * @param object $data
 * @param string $url
 * @return string
 */
function novolearn_oembed_dataparse( $html, $data, $url ) {
	if ( isset( $data->type ) && 'video' == $data->type ) {
		return '<div class="video-container">' . $html . '</div>';
	}
	return $html;
}
add_filter( 'oembed_dataparse', 'novolearn_oembed_dataparse', 11, 3 );

/**
 * Remove default styles from the recent comments widget.
 */
add_filter( 'show_recent_comments_widget_style', '__return_false' );

// Include Educator related functionality.
require get_template_directory() . '/inc/educator.php';

// Include template functions.
require get_template_directory() . '/inc/template-tags.php';

// Include Customizer setup.
require get_template_directory() . '/inc/customizer.php';
