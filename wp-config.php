<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'marketing_website' );

/** Database username */
define( 'DB_USER', 'grubrunner' );

/** Database password */
define( 'DB_PASSWORD', 'Grubrunner4321' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'nm4hezgvavjezaycha5ojj0ay8qq5khex60dpaspa2tjjb0exzctycdg2vuhdkjg' );
define( 'SECURE_AUTH_KEY',  't7ohi6zrkkfjaipdkyfcaqdhmc054doqhucjeeasvbi5xom1gcmuh9owmhhpkd5n' );
define( 'LOGGED_IN_KEY',    'phz53jykvc21a760cxtqd2pbhxdecpdovfjylhibzu3rnwuqnjmbyu1xdiwbj8fq' );
define( 'NONCE_KEY',        'ec4fxjhe7lkwvcgltrhrako1bzktuijpu9y0kxbg6ewnj9avcxjgb3klqj2i0kb5' );
define( 'AUTH_SALT',        'eonzjfdd5swffymiyavctndwmuxtj721a7v9hou8ltumw3pizno80zbioybhc3ds' );
define( 'SECURE_AUTH_SALT', 'tjioxjjm7yrcalaxcz9jhl4u1lyj4zmlxfuq2anvjneoudrni59lythosnsavnxu' );
define( 'LOGGED_IN_SALT',   'bpk4pvilavdojrhbyii8ah4xfoiivtermb1agyfv9wllquvugvitmchd0rucbxxm' );
define( 'NONCE_SALT',       'tmig4zo4alediotjxflnvon6zozcwcvnfoupijzy0whqwwkwmld0e5h7pgsazcae' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpgs_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
