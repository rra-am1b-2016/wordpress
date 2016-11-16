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
define('DB_NAME', 'am1b_2016_wordpress_groenten');

/** MySQL database username */
define('DB_USER', 'rra');

/** MySQL database password */
define('DB_PASSWORD', 'geheim');

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
define('AUTH_KEY',         'j/1AZ$QY5>=MBcpuf9DHgv:nbowfl6:-u(.D*VIp[/76^iF0C5uMeqw,&Js!t.zb');
define('SECURE_AUTH_KEY',  'PH:h)%@U}].?F{;-s;D*w;@W6ncWgT??amxxuvaDhd$rL#5>0p|K0^F*-b}i|Pm>');
define('LOGGED_IN_KEY',    ')8FTm9b=ks!tS^[^>i #B.|T8hSvf[@ZP>x+!D!niE(Q0I.2BeXycEyE(;s(#EP1');
define('NONCE_KEY',        '/.34A*mXgZ|8D+wa-J<V%7xn8k :/I_2X/<j5|k`IJ9.B2|B)u5Gy!Nb}8LhII{D');
define('AUTH_SALT',        'hl;m0vT*33boA#XqWio-sl*5*qoE(;2G:)a,--O1hJ6y`ZIX;q&eG{`:},btG~|m');
define('SECURE_AUTH_SALT', 'iv1xq61ZRAXcET`rH,i=b5#-`Gpv-<F%e|H9g.W>JSbLWkB/cX={[f09i+x[Trn#');
define('LOGGED_IN_SALT',   'c|0O@{cFA)WCNQ:;kZjvh;tt7M+[,Ys46n$D:[fsg0#@pmy --6#|yhA]`Jd+!;q');
define('NONCE_SALT',       'Zd lchw6tv:)c7k+zC+U&7Q3&_V]mpIs-<U_;Q9UJ|Jm-1}uw*(zdgG!e5Aj-q)h');

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
