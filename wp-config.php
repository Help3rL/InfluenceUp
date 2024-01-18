<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'influeneceup' );

/** Database username */
define( 'DB_USER', 'influeneceup' );

/** Database password */
define( 'DB_PASSWORD', 'influeneceup' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'E<&;k8$FYe$EUG=j5{~;8Pm~E_D F^c;yQVCmpW h]iTKS<jN vlaKY8KB(T/)#N' );
define( 'SECURE_AUTH_KEY',   '-F)s6W:57n<0/tB)c~-r0i>vC nYTZ5~2 {rhm(ZA#ubgX:N$#KOF[-9Fd1E*f]O' );
define( 'LOGGED_IN_KEY',     '8?f9#+&*VHML^cX!K8|NEFF,sAz%a?jp~5@=<j1[q&fv=(6@iJHdr:?V$ve4xgC#' );
define( 'NONCE_KEY',         'V{.)KpJ8%IKqG]PES%qBp_F[DD2@)JT0Q#OyvP9aez&;q.|xgUA!2-4Q#YMBvw,P' );
define( 'AUTH_SALT',         '{aqjl|AuwY@eD-|L+69(OW;4%AqK`r>ouvA`:un?pk)oISpt)Y%9h,n?uB8thRfV' );
define( 'SECURE_AUTH_SALT',  'u}Br0N/HpblLi2k4(WbSX0m;W8lB_uDdC7&Wjlvp]+$V3=J4TeC@]+lMh+~0]GTi' );
define( 'LOGGED_IN_SALT',    '5$/Tajp{|dmXuV;[mC*.6m3Ie !zWQr6N&J4BC5.{,8$IYP8s/~Jo/{x&3P.?jtD' );
define( 'NONCE_SALT',        'hvIV6Ld~>7e$nD Y.<j6$ =B8T0(=??hZa+J#IJdW^P73Rj`5o-tSsE/qkY%*Un7' );
define( 'WP_CACHE_KEY_SALT', '%YRMMhMBm9F(^t59]?NSl.s}y^?I>-fyuo0^4#^TYWS&r5Hs7^PgI-Hvs8wTD%F-' );


/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', true );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
