<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'swayy_wp22' );

/** Database username */
define( 'DB_USER', 'swayy_wp22' );

/** Database password */
define( 'DB_PASSWORD', 'SJdp178)]X' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'nki7qjjk2hgrncyvapdg31madmoceytejwchtrtxompntzgqekeeyuagg723b6wo' );
define( 'SECURE_AUTH_KEY',  'ihhon33iml6pig2mfspotehwsrqsrgbug3b2p5gxmi8khabaak1wm5prft6gfuaw' );
define( 'LOGGED_IN_KEY',    'l0z6i5nyb0tdvdu9vyd4tmczqajbnww0bbfnv3hjzjhimaidvww7xja6rmbqabjq' );
define( 'NONCE_KEY',        'r3ce2gkeryoi2zuvpxveh01mbte4b35hdfvebvbct5tbv07irdz1dkpholu1xydb' );
define( 'AUTH_SALT',        'ab59wxijuulitvgh1tikfn4kfbcyyqwxjijrbs8usyizct9nrrjwrdgrsz1xpxzv' );
define( 'SECURE_AUTH_SALT', 'va6epxdfzqz6dpnxnb40firgd6fbveoohbyfeqwdqcpis8pxmzwtp8xbijas3alh' );
define( 'LOGGED_IN_SALT',   'lnu3r2wh44itsgmsiyteqsmihxgmqaj4nwom1i44l2syua6c4ld3jtbd68ovcntl' );
define( 'NONCE_SALT',       'prygypnh74dxwtxtnr4bvlpug6ugolnwcjsebpbo9hvurzke5pvu0kh8zgmrbl1m' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpmq_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
