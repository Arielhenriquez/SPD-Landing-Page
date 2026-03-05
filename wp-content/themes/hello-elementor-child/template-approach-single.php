<?php
/**
 * Backward-compatibility shim.
 *
 * The canonical "Approach Single" page template was moved to:
 *   page-templates/template-approach-single.php
 *
 * This file has NO "Template Name:" header on purpose — it must not create a
 * second entry in the WP template dropdown.  It exists only so that any WP Page
 * whose _wp_page_template meta still holds the old value "template-approach-single.php"
 * continues to render correctly without needing a DB update.
 *
 * To keep a page working long-term, edit it in WP Admin and re-select
 * "Approach Single" from the Template dropdown (which now points here correctly).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_stylesheet_directory() . '/page-templates/template-approach-single.php';
