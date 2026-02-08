<?php
/**
 * Product badge
 *
 * This template can be overridden by copying it to yourtheme/wp-carousel-pro/templates/loop/product-type/product-badge.php
 *
 * @package WP_Carousel_Pro
 */

$is_on_sale      = $product->is_on_sale();
$is_out_of_stock = ! $product->is_in_stock();

if ( $is_on_sale && $show_product_badge ) {
	?>
		<span class="wpcp-on-sale">
			<?php echo esc_html__( 'On Sale', 'wp-carousel-pro' ); ?>
		</span>
		<?php
} elseif ( $is_out_of_stock && $show_product_badge ) {
	$label = apply_filters( 'wpcp_out_of_stock_label', __( 'Stock Out', 'wp-carousel-pro' ) );
	?>
		<span class="wpcp-on-sale wpcp-out-of-stock">
			<?php echo esc_html( $label ); ?>
		</span>
	<?php
}