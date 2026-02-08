<?php
/**
 * Hello Elementor Child - Carga CSS global y CSS por página desde archivos.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carga los estilos personalizados del tema hijo.
 */
function hello_elementor_child_enqueue_styles() {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' ) ?: '1.0.0';
	$base    = get_stylesheet_directory_uri();
	$path    = get_stylesheet_directory();

	// 1. CSS global: wp-content/themes/hello-elementor-child/css/custom.css
	$custom_file = $path . '/css/custom.css';
	if ( file_exists( $custom_file ) ) {
		wp_enqueue_style(
			'hello-elementor-child-global',
			$base . '/css/custom.css',
			array(),
			filemtime( $custom_file )
		);
	}

	// 2. CSS por página: solo en páginas individuales
	if ( is_singular( 'page' ) ) {
		$post = get_queried_object();
		if ( $post && ! empty( $post->post_name ) ) {
			$slug = $post->post_name;
			$page_file = $path . '/css/pages/' . $slug . '.css';
			if ( file_exists( $page_file ) ) {
				wp_enqueue_style(
					'hello-elementor-child-page-' . sanitize_key( $slug ),
					$base . '/css/pages/' . $slug . '.css',
					array(),
					filemtime( $page_file )
				);
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles', 20 );

/**
 * Para la plantilla "Homepage (HTML/CSS en proyecto)" carga Inter, homepage.css y opcional homepage.js.
 */
function hello_elementor_child_enqueue_homepage_assets() {
	if ( ! is_page_template( 'template-custom-homepage.php' ) ) {
		return;
	}
	$path = get_stylesheet_directory();
	$uri  = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'hello-child-inter-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	$homepage_css = $path . '/css/homepage.css';
	if ( file_exists( $homepage_css ) ) {
		wp_enqueue_style(
			'hello-child-homepage',
			$uri . '/css/homepage.css',
			array( 'hello-child-inter-font' ),
			filemtime( $homepage_css )
		);
	}

	$homepage_js = $path . '/js/homepage.js';
	if ( file_exists( $homepage_js ) ) {
		wp_enqueue_script(
			'hello-child-homepage',
			$uri . '/js/homepage.js',
			array(),
			filemtime( $homepage_js ),
			true
		);
	}
}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_homepage_assets', 15 );
