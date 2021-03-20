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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'boledu_coffee_2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'usu *uz7]%&Hr]& 60[*|;%`W,KQ~2TmI;RxR%r_0V1Aaf=g-,koD%~kV`%bdFA{' );
define( 'SECURE_AUTH_KEY',  '<v:w$BJx^ lrb/TVI20P|g)-^^_#}:f? 7=&h*6ODA|K5/`70i![+s>!2F%.[|Ro' );
define( 'LOGGED_IN_KEY',    '`SC.:fJa<.9]G:Am3Qt^Ook@$!_ V+1(3<PF]Mn|waPTe[quvH@PTfitU-hF-;uG' );
define( 'NONCE_KEY',        'bvEo(|DMb<m=v_Voe$@Fyk::f{q36[`s)nwScm3;$VmumXSIQ4%j[3VxvfOus6G<' );
define( 'AUTH_SALT',        '1]x_R8bAt0^`mP4]Fd(d!D)Z![w,$vp%LaJ4&aibHLHp=2>TfuiOACIRp9?l^Au@' );
define( 'SECURE_AUTH_SALT', 'O[3O?~tuFP1$,:;hH|J=L=07rF|G_V~_M?rUL+SG>/YyKjNE>Oi(}:nv~nG{vF@.' );
define( 'LOGGED_IN_SALT',   '51Di7Lf 1+!a[A#^^3sW2aCD[3]Y=)?lf4+XTQ4gPI)<8Oqt?_HDxQfoa>r0M-Vd' );
define( 'NONCE_SALT',       '8_Dw]|>F&kR&^gY[+n>2c{Nflej0puA-$7@c886pZ3_ZC9_R#U?#p80aHsoR#go6' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
