<?php
/**
 * Template Name: Contact Us (Tailwind Integrated)
 *
 * Navbar + footer del theme. Contenido en template-parts/contact-us-content.php.
 * Estilos: contact-us.css + base, layout, components, navbar, carousel, pages.
 * Solo fuentes extra en head (Dancing Script, Material Symbols); el resto por CSS del theme.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', function () {
	?>
	<!-- Fuentes Contact: Dancing Script (hero "Us"), Material Symbols (iconos) -->
	<link href="https://fonts.googleapis.com" rel="preconnect"/>
	<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&amp;display=swap" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
	<?php
}, 5 );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'page-projects page-contact' ); ?>>
<?php get_template_part( 'template-parts/header-navbar' ); ?>
<?php get_template_part( 'template-parts/contact-us', 'content' ); ?>
<?php get_template_part( 'template-parts/footer-spd' ); ?>
<?php wp_footer(); ?>
</body>
</html>
