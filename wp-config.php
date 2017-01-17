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
define('DB_NAME', 'wp_cimroofing');

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
define('AUTH_KEY',         '>DYZ}AD>[YyG;5y31>aL,QfL^=$Ri%h;4*IH)x&s1Si~(Oc:_Ooc)Ib4X,XLOXo@');
define('SECURE_AUTH_KEY',  'W4n0<Y$TPsd[m:S`,?3;_!%?d_4WT5K!K`aRGfxqdyv{HBa!1pEm&[/4vHZw)_x4');
define('LOGGED_IN_KEY',    '[Be/}4Oyg;-4a[Fd}@{`1Ph/O$O[c$W!QqeGGeTfCB:Wt|!(U01_cy;K$npfOF~h');
define('NONCE_KEY',        ':o%9-P+aFpEjwM$&REKX9@dpHRJf)X@p};|V0Ccm7 V7opcNn4FKX;8PEuv)bs~u');
define('AUTH_SALT',        '/q3YL,Qe{!CB5__~JvKn0]mcNrF)il4&U*W5reHNr65!kL5=g;6 r 6.;ISj4G&@');
define('SECURE_AUTH_SALT', '9[mus/*654?[Tpc~58v`0R{Xd8R~uVjrS@49WUGe/#K`9Ocqn&c!:TKfQ>Y/J=m5');
define('LOGGED_IN_SALT',   '_IRf#]_|7lRzs_|j;c<]QSkpY9uxopa:UKGul?@?IGG<LBHvgtM@EFnN1U@U&-!(');
define('NONCE_SALT',       ',:7Su-O>80eNhu{is8LS?Yira`?,N]TR5n^~]k<U{O_-Tj`o^^-ruc4/;%0]#$DL');

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
