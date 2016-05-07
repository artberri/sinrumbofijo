<?php

define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');

define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');

define('WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content' );

define('WP_HOME', '');
define('WP_SITEURL', '');

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '' );

define('WPLANG', 'es_ES');

define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG', false);

define('AUTOMATIC_UPDATER_DISABLED', true);

$table_prefix  = 'wp_';

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );