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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_appflex');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '_H:)F%pH ~/:E|_tiyIPqRu(-(zbkh4WH9h,65Xn9U:~RUqb#*d[=4~$x)v:BJBb');
define('SECURE_AUTH_KEY',  'TrB0D}uSb/r5oh8V-&K&KjrGB&(ktc}`G|_aszFry@vUbG*qbK a+$m4g+(z3Dls');
define('LOGGED_IN_KEY',    '_&_5.Ucvga+RgT*`X[M.HF7uyE[zkLfxuABljMC#$@3.VEQA$Wz1A)*tt`Z|+g||');
define('NONCE_KEY',        '#2VUBzym/{ORn_-=`tzAGJ48hjC|r;+5b@X*wyOLbaDh$.{(!ANhS@w=KLIeM?~-');
define('AUTH_SALT',        '7S_Z(+PCaz4.b}-j]1W7W+IDFOagWj|rEugZ)^T<CO5LvDa@+ahrhebT4S0R8,fh');
define('SECURE_AUTH_SALT', '%N6++jBL$RoNRD,chaZ|M|)%Ep.vQoiO][A)qxIL2/|VngWpLKfd*pcl^Mw+?qeK');
define('LOGGED_IN_SALT',   '~u)#Dy>u/z2>VspYdUyl-9AFT.%ooPb5u#Z9hT/0*+Zny`DG,-Ev:upiTdIiGjEX');
define('NONCE_SALT',       'T4V;kk,B KW;<l9z%^16oO4[N,&8yNDvQ Hmsmr(@toyxOwob+qt[S30Ov,zDvEs');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
