<?php
/**
 * Template Name: Project Single
 *
 * Página individual de proyecto (ej. boone-es-emergency-repairs).
 * El slug de la página debe coincidir con project['slug'] en inc/projects-data.php.
 * Incluye: hero, overview (2 cards), gallery, related projects.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_slug = get_post_field( 'post_name', get_queried_object_id() );
$projects  = include get_stylesheet_directory() . '/inc/projects-data.php';
$project   = null;
foreach ( $projects as $p ) {
	if ( isset( $p['slug'] ) && $p['slug'] === $page_slug ) {
		$project = $p;
		break;
	}
}

if ( ! $project ) {
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
	<title><?php echo esc_html( $project['title'] . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'page-project' ); ?>>
<?php
set_query_var( 'spd_project', $project );
set_query_var( 'spd_projects', $projects );
get_template_part( 'template-parts/header-navbar' );
?>
<main id="main-content" class="project-main">
	<?php get_template_part( 'template-parts/project-single', 'content' ); ?>
</main>
<?php get_template_part( 'template-parts/footer-spd' ); ?>
<?php wp_footer(); ?>
</body>
</html>
