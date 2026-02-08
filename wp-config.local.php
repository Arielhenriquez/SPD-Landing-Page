<?php
/**
 * Configuración local para WordPress - SPD Contracting, Inc.
 * Copia este archivo a wp-config.php y edita DB_NAME, DB_USER, DB_PASSWORD.
 */

// ** Configuración de la base de datos ** //
define( 'DB_NAME', 'spd_wp_local' );      // Nombre de tu base de datos
define( 'DB_USER', 'root' );              // Usuario de MySQL (en XAMPP suele ser "root")
define( 'DB_PASSWORD', '' );              // Contraseña (en XAMPP a menudo vacía)
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

/** Claves y sales del sitio original (para que los logins sigan funcionando) */
define( 'AUTH_KEY',         'h4tx7dbz6kwlzoeiueydjfy69bab9qusxhjqcgz9z4h1bbbbyahtw4ugijzt1sho' );
define( 'SECURE_AUTH_KEY',  'erhfjdhgsdrrlroam5xmyefjiellpaxxvxhphevy4qimiz9zrs07mkh655dedrfz' );
define( 'LOGGED_IN_KEY',    'sn75yuzxucaitzn3as1lygeqcnypdc1yp7hbrbhehaqjuvuytkrwjh2grgexqdot' );
define( 'NONCE_KEY',        'davnzbzgoufasbkytgurocp9valooaa9tt9ztqywuha7smu7mbjdndhcagcn364u' );
define( 'AUTH_SALT',        'vuzptrsy6gzrqao5a9kjaiz9dpqlqnkns8dnzsvtcqke0gqmawo226mg958itb4c' );
define( 'SECURE_AUTH_SALT', 'm5omdtb7xcjxvaoruehzb5qw6rtqflispfsmmcdbp5xshqcks2zhoxcpkkepscih' );
define( 'LOGGED_IN_SALT',   'dv2lx3r56f7jbovijre8x6ev6msw15vyfllkzrrc7ykndkaynss2i2a0trcldbrj' );
define( 'NONCE_SALT',       'bvflbi7swrngc9skbw79qzzfl7sa8c5nn8z9krdjaq3lkdktxivyzqs8pd8gnhwb' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
