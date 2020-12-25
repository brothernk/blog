<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'J12GHlujzyue+UAS3F+4tQeEt22g9tzdeDM9Sfd4Tb2Z0rvP22q+S2mE3LOgXVj0+usqDvv11F1KSaMV39GaOA==');
define('SECURE_AUTH_KEY',  'RGvo2HjloVaS981q8dKg9vWuZbOqQWALrPXH6OvkhaHCiZVq8ohPjUR6PAsC4xZoofybYgpK0brc2K+sgR/spA==');
define('LOGGED_IN_KEY',    'rzSrZPUj2BWUI+FOmsuJkx7w38cbzUL5qcJBP7cgzJBIG1p8+CzL/aFMJzZJkbLyBeleqG8+g8HCElgRInxSNA==');
define('NONCE_KEY',        'cdvCSV4MwK6ws9vt6Z4rxIJd/Dn3EiExYVOw9uGPemVk9tcjel0PtB5cA/RD0cUJSM4v/Hno80bYn1j7krFLPQ==');
define('AUTH_SALT',        'Zy0NDWyFY/bWMgX+sVCf8tmdYZLzzgnpZO7hmh4EIVmOf99y501AlBe/5NCg15yY2cwQ7+HA/GGVq7mdetUU9Q==');
define('SECURE_AUTH_SALT', 'h7RnXKf4D0uoEfJRr2j+tHig8v0fFMuz296spetlIca4SQjEnv8fRK5lIkIUoJK3KN9M/7s8if16Hft8Wa9E4A==');
define('LOGGED_IN_SALT',   '5liHUE36Zjl9rFDO6vrckVsODxsKS7ry9610UPjD+mGUO+CiCIou8X8XDDStlZPTrIinQ9ohB5cF15flbzIJJw==');
define('NONCE_SALT',       'ATdb1nq5z1wsYORLn89BWzcWGOisxP9jlVwKdbnHZWFdldbEOlxuG2t1gjygDE1EvKid6mJH7JO8GotY95JF5w==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
