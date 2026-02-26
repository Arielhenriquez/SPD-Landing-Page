<?php
/**
 * Footer – SPD footer en todo el sitio.
 * Sustituye el footer del tema padre por template-parts/footer-spd.
 *
 * @package Hello Elementor Child
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/footer', 'spd' );
?>

<?php wp_footer(); ?>

</body>
</html>
