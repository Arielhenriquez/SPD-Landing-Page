<?php
/**
 * Template Name: Approach Single
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_slug    = get_post_field( 'post_name', get_queried_object_id() );
$approach_map = include get_stylesheet_directory() . '/inc/approach-data.php';
$service      = isset( $approach_map[ $page_slug ] ) ? $approach_map[ $page_slug ] : null;

/* --- Fallback: derivar slug desde URL /expertise/{slug} o /approach-expertise/{slug} --- */
if ( ! $service ) {
	$uri_path = isset( $_SERVER['REQUEST_URI'] )
		? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )
		: '';
	if ( $uri_path && preg_match( '#/(?:expertise|approach-expertise)/([^/?#]+)/?$#', $uri_path, $m ) ) {
		$url_slug = $m[1];
		if ( isset( $approach_map[ $url_slug ] ) ) {
			$service = $approach_map[ $url_slug ];
		}
	}
}

/* --- 404 si el slug no existe en el mapa de servicios --- */
if ( ! $service ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
	$template_404 = get_query_template( '404' );
	if ( $template_404 ) {
		include $template_404;
	}
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo esc_html( get_the_title() . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'page-approach-single' ); ?>>
<?php
set_query_var( 'spd_service', $service );
set_query_var( 'spd_projects', include get_stylesheet_directory() . '/inc/projects-data.php' );
get_template_part( 'template-parts/header-navbar' );
?>
<main id="main-content" class="project-main">
	<?php get_template_part( 'template-parts/approach-single', 'content' ); ?>
</main>
<?php get_template_part( 'template-parts/footer-spd' ); ?>
<?php wp_footer(); ?>
</body>
</html>
