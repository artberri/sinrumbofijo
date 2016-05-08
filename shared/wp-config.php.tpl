<?php
define('WP_CACHE', true);

define('DB_NAME', '{{app.db.name}}');
define('DB_USER', '{{app.db.user}}');
define('DB_PASSWORD', '{{app.db.pass}}');
define('DB_HOST', '{{app.db.host}}');

define('WP_DEBUG', false);

define('AUTH_KEY',         '{{app.secret.auth_key}}');
define('SECURE_AUTH_KEY',  '{{app.secret.secure_auth_key}}');
define('LOGGED_IN_KEY',    '{{app.secret.logged_in_key}}');
define('NONCE_KEY',        '{{app.secret.nonce_key}}');
define('AUTH_SALT',        '{{app.secret.auth_salt}}');
define('SECURE_AUTH_SALT', '{{app.secret.secure_auth_salt}}');
define('LOGGED_IN_SALT',   '{{app.secret.logged_in_salt}}');
define('NONCE_SALT',       '{{app.secret.nonce_salt}}');

define('WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content');
define('WP_CONTENT_URL', '{{app.url}}/wp-content');

define('WP_HOME', '{{app.url}}');
define('WP_SITEURL', '{{app.url}}/wp');

define('UPLOADS', '../wp-content/uploads');

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('WPLANG', 'es_ES');

define('AUTOMATIC_UPDATER_DISABLED', true);

$table_prefix  = 'wp_';

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}
require_once( ABSPATH . 'wp-settings.php' );
