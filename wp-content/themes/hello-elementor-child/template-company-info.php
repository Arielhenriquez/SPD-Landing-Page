<?php
/**
 * Template Name: Company Info
 *
 * Página Company Info: navbar + hero + contenido + featured carousel + footer.
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
<body <?php body_class( 'page-company-info' ); ?>>
<?php get_template_part( 'template-parts/header-navbar' ); ?>
<?php get_template_part( 'template-parts/company-info', 'content' ); ?>
<?php get_template_part( 'template-parts/footer-spd' ); ?>
<?php wp_footer(); ?>
</body>
</html>
