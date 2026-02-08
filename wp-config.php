<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "wordpress" );

/** Database username */
define( 'DB_USER', "wordpress" );

/** Database password */
define( 'DB_PASSWORD', "wordpress" );

/** Database hostname */
define( 'DB_HOST', "db" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h4tx7dbz6kwlzoeiueydjfy69bab9qusxhjqcgz9z4h1bbbbyahtw4ugijzt1sho' );
define( 'SECURE_AUTH_KEY',  'erhfjdhgsdrrlroam5xmyefjiellpaxxvxhphevy4qimiz9zrs07mkh655dedrfz' );
define( 'LOGGED_IN_KEY',    'sn75yuzxucaitzn3as1lygeqcnypdc1yp7hbrbhehaqjuvuytkrwjh2grgexqdot' );
define( 'NONCE_KEY',        'davnzbzgoufasbkytgurocp9valooaa9tt9ztqywuha7smu7mbjdndhcagcn364u' );
define( 'AUTH_SALT',        'vuzptrsy6gzrqao5a9kjaiz9dpqlqnkns8dnzsvtcqke0gqmawo226mg958itb4c' );
define( 'SECURE_AUTH_SALT', 'm5omdtb7xcjxvaoruehzb5qw6rtqflispfsmmcdbp5xshqcks2zhoxcpkkepscih' );
define( 'LOGGED_IN_SALT',   'dv2lx3r56f7jbovijre8x6ev6msw15vyfllkzrrc7ykndkaynss2i2a0trcldbrj' );
define( 'NONCE_SALT',       'bvflbi7swrngc9skbw79qzzfl7sa8c5nn8z9krdjaq3lkdktxivyzqs8pd8gnhwb' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define('CDN_SITE_ID', '219287');
define('CDN_SITE_TOKEN', 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE3NjM0MjE2NjMsIm5iZiI6MTc2MzQyMTY2MywiZXhwIjoyMDc4NzgxNjYzLCJpZGVudGl0eSI6eyJzdWIiOiJqd3Rfb25seTpjYWNoZV9wdXJnZTowIiwicm9ja2V0X2NsYWltcyI6eyJyb2xlcyI6WyJyb2xlOnNpdGVfY2FjaGVfcHVyZ2UiXSwiYWNjb3VudF91c2VyX2lkIjowLCJsb2dpbl9lbWFpbCI6ImNhY2hlX3B1cmdlIiwibG9naW5fdXNlcl9pZCI6MCwidXNlcl90eXBlIjoiand0X29ubHkiLCJyZXNvdXJjZV9jbGFpbXMiOlsid21faW5zdGFsbDoyMTkyODciXX19LCJmcmVzaCI6ZmFsc2UsInR5cGUiOiJhY2Nlc3MifQ.HAdDkkC9MwK_QPKE2UemTjbh_MiO_LxUTlXPygL2jYJYBwaLlhtedm_0tHadUMMe-3s9bK0qr_7s-HunQ8_nbFPeqT3lhEsZiU21MHibVwZztatE-GHRhHkTPR0sD5oqy4WA9jsvuRtJbf3I9NmMwrJCO0K0DKBolddZkWLSyqWcV-WuIZHdhUpyO1zB07nNqVePNEgJXiXyATiZrTih9qivFme9ly7N_LdcMtRfpeMsy17XfdTvgwOaNJ7L52h4Op3Wb24y2gMK0QS1YxkvosnsAtVPtEUCI8Dqii1u5ZoQae6Sj_fbIN-Hv40ODWORIhhFkuJRstS53OAoKzLsSHJeH5pQht5eQL51BojhSHw60AB1b0qgako57ODQoqXRTYWJmpVHcIKiscSjugasgr7db0AEshi6npp9DALGSVucaaBSN9Vn9VgzqwSNgQZUeCIbthTQHYdnfmkiWTOf3ZmH3ojo77x6uDiyPksz1DVsxog9sUusaWFuC8W4BsK9CNBey0qM1cnLfdKzJ8BjmZk43T_pwT3dU4GZWAaECf15UpTwwzpk1cFkhDwRKObjLebRgiIIIeNUzkfDOcm58cgHlzMq8NT0TAXapJpMTcPymkru6tW187RbQ1D-ZdC_A4SFIFcWi5lVmtE0e4o2WeyhKYJa0EYzshiQGmlEdcI');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
