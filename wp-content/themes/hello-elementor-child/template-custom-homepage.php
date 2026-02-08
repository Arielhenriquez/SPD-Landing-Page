<?php
/**
 * Template Name: Homepage (HTML/CSS en proyecto)
 *
 * Plantilla para la portada. El HTML está en template-parts/homepage-content.php
 * y los estilos en css/homepage.css. Edita esos archivos en el proyecto, no en Elementor.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Los CSS/JS se encolan en functions.php cuando se usa esta plantilla (antes de wp_head()).
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
</head>
<body class="custom-homepage <?php echo esc_attr( implode( ' ', get_body_class() ) ); ?>">
<?php
	get_template_part( 'template-parts/homepage', 'content' );
	wp_footer();
?>
</body>
</html>
