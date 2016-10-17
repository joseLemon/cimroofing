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
define('DB_NAME', 'wp_cim');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/rK?}Dr&R0b/]=jXF Tp34xt)(7iCZkod#IyE#{c>57laW> q/:2V~FP+]0S;}w+');
define('SECURE_AUTH_KEY',  'ou0c#H~.UjDTqKNHc/ex14r1a&UW=qj!#DZL9:G*eKKwDe$#;5/a4NX:w@oq *`8');
define('LOGGED_IN_KEY',    'L;|~l9O1?dQ$2bLEMHgP+,U%d2RN&1uSF(ur2k$|z33N{DTca+8q6W?Js({6Z%HJ');
define('NONCE_KEY',        'x508aeQ-f&e:DdzuJ)7MLt ~loq G|${A[#gH%q!:ZJ7@6BCd0APtt!jd|1/`K*L');
define('AUTH_SALT',        '$}H)8F4Dn8(!Hh3IapMBGAqJ(6@xc=uculXgf+ZCU7Rv??)Z %5R#87U-ww<5$QC');
define('SECURE_AUTH_SALT', '%!S_4#c*B`m_cJ)h7+%a}w.wyxVTDvx<w=p*kS{9,~wER8RyEq!3r.cCc]v.E4y2');
define('LOGGED_IN_SALT',   '?AqG<%7*j&JKUWXNp=p91*,N7;12vJW9kiFx]UGN<2mzZVg1o/o9hua+QS8Qpo)>');
define('NONCE_SALT',       '-*R*b0PsBuB:-h.qpn ~qQWQZ!(}Q%+[p`-?dt}B6cHB[U}=:EcwTd}x]to6I&7.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
