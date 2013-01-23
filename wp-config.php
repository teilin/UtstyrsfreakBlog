<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('RELOCATE',true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'godpaski');

/** MySQL database username */
define('DB_USER', 'godpaski');

/** MySQL database password */
define('DB_PASSWORD', 'WR2MfHgy');

/** MySQL hostname */
define('DB_HOST', 'godpaski.mysql.domeneshop.no');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '?$+7oIO!mFbb6x,`Ys ^+Qx7fnU/nn0Ls1Oz0w?2;<4_d+1hdh*u:l$5{k.H:b|E');
define('SECURE_AUTH_KEY',  ',.w~J6MD4fy9RIXW|/! ;/3B8+cJ;_,[9$,$;}iMZB}iExnYf-fN[.>m+d(yW]PD');
define('LOGGED_IN_KEY',    'a(owLSr9-C#.NH~>FkQ:_EU^shyNx8f+AdL%t@wjwq3VEL?_:.^wL s n$>JBe-@');
define('NONCE_KEY',        'ad5K6.Pm5?qjHc=jsW<mk{@UzgnxJj(PApYn+[2m@q-pf8><WqA:[BD~07yvO;}T');
define('AUTH_SALT',        'kcMW2[^aipYU{+m-w,p/~,_S%#_8pl~dY-uxW+-V;fV}R~-O|@kkG_C&p>@#GtO5');
define('SECURE_AUTH_SALT', 'ZZ!)!4{SvXXp;nKf|];YxO|c$*%<=Du?Q7n2%N|Gu$<e[Q-&!D*ujoH2Jw[r$Ij1');
define('LOGGED_IN_SALT',   '.?nUZle|7T~7KO,/X${Ly#D:f|L+&NRm-+_z66!sR1eXJ@_WjhXEo%J*vTT@z^p)');
define('NONCE_SALT',       'k/==:p?oT8iF+Ft!PO9wpb`Zz/@`rS:u_sY+KhaI/R^Gi;k-0elA;=1IgS;lxz2D');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_utstrsfreak_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
