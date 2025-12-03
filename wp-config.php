<?php
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
define( 'DB_NAME', 'elmonjedb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '5Pk<=f?yzl3gSPSidO3X}2Y_j!h0}^VVf]>>:JKTiQ8,(7q,w8EWze=&~5:d`am8' );
define( 'SECURE_AUTH_KEY',  '0X]f*3~m#X%4?jD4}]8p7(Ns-#G|f_k]at,dG,OM1#i(,&GG=a<;lSFjMS x5q12' );
define( 'LOGGED_IN_KEY',    '|(Z`SNb!s7r3F3;WzV^As*CjTj!~.VbET2f<$Ic>-c<L3$ja Xl!tyX|6XUS6t9o' );
define( 'NONCE_KEY',        'YE{0f=(W}g?b`jrn*pzfK]`,$(kV{W?en!*f>/Z &>x}N3U29u0v`mCPuy;$<KQ=' );
define( 'AUTH_SALT',        ']/V,B3z2[OX]cTk;$Z4s~*Hd_07PP:xHn[_f<_.KuD:j1}e({BmPJbd|;cY0|r,i' );
define( 'SECURE_AUTH_SALT', '9~) 1&Y5f+-+$0Tf#L|kY4e0LG~);SGip(z*`>2[Up+12;Jf!CHO9.@A=k-/EZf-' );
define( 'LOGGED_IN_SALT',   'z7w3@c2B(N{p_^=lPU#)X!x=oU.nB@_@ l_!v/9VHX^eHA{ZPDKg%0?3x!~ k;m>' );
define( 'NONCE_SALT',       '$~+XO+zd(x,bz*Sh| &_`ykLVRVKN)VKivH~v%5m(sx*_j|Sr6.x4g~J$-(20CBo' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
