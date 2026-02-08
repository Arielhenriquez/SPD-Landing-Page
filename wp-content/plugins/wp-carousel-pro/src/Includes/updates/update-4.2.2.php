<?php
/**
 * Update options for the version 4.2.2
 *
 * @link       https://shapedplugin.com
 *
 * @package    WP_Carousel_Pro
 * @subpackage WP_Carousel_Pro/includes/updates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

update_option( 'wp_carousel_pro_version', '4.2.2' );
update_option( 'wp_carousel_pro_db_version', '4.2.2' );

// Delete old options related to page ID.
global $wpdb;
$wp_sitemeta = $wpdb->prefix . 'sitemeta';
$wp_options  = $wpdb->prefix . 'options';
if ( is_multisite() ) {
	$wpdb->query( "DELETE FROM {$wp_sitemeta} WHERE meta_key LIKE 'sp_wpcp_page_id%';" ); // phpcs:ignore -- $wpdb->prepare not needed.
} else {
	$wpdb->query( "DELETE FROM {$wp_options} WHERE option_name LIKE 'sp_wpcp_page_id%';" );  // phpcs:ignore -- $wpdb->prepare not needed.
}
