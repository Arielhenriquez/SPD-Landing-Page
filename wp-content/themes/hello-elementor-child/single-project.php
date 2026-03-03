<?php
/**
 * Single project (CPT "project") – misma estructura que template-single-project.php.
 * Busca el proyecto en inc/projects-data.php por el slug del post (ej. randall-recreation-center-project).
 * Coincidencia: slug exacto o slug del post sin sufijo "-project" (randall-recreation-center-project → randall-recreation-center).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_slug = get_post_field( 'post_name', get_queried_object_id() );
$projects  = include get_stylesheet_directory() . '/inc/projects-data.php';
$project   = null;

foreach ( $projects as $p ) {
	if ( empty( $p['slug'] ) ) {
		continue;
	}
	if ( $p['slug'] === $post_slug ) {
		$project = $p;
		break;
	}
}
/* Intento 2: slug sin sufijo "-project" (randall-recreation-center-project → randall-recreation-center) */
if ( ! $project && substr( $post_slug, -8 ) === '-project' ) {
	$slug_alt = substr( $post_slug, 0, -8 );
	foreach ( $projects as $p ) {
		if ( isset( $p['slug'] ) && $p['slug'] === $slug_alt ) {
			$project = $p;
			break;
		}
	}
}

/* Intento 3: derivar slug desde URL /project(s)/{slug} (CPT sin página WP o permalink raro) */
if ( ! $project ) {
	$uri_path = isset( $_SERVER['REQUEST_URI'] )
		? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )
		: '';
	if ( $uri_path && preg_match( '#/projects?/([^/?#]+)/?$#', $uri_path, $m ) ) {
		$url_slug = $m[1];
		foreach ( $projects as $p ) {
			if ( isset( $p['slug'] ) && $p['slug'] === $url_slug ) {
				$project = $p;
				break;
			}
		}
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
