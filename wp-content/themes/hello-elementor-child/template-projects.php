<?php
/**
 * Template Name: Projects
 *
 * Página Projects: navbar + contenido (Featured, Services, Government Buildings, Gallery, Related) + footer.
 * Carrusel genérico .c-carousel; datos desde inc/projects-data.php.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'page-projects' ); ?>>
<?php get_template_part( 'template-parts/header-navbar' ); ?>
<?php get_template_part( 'template-parts/projects', 'content' ); ?>
<?php get_template_part( 'template-parts/footer-spd' ); ?>
<?php wp_footer(); ?>
</body>
</html>
