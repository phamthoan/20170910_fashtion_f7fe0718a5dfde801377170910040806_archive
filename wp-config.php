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
define('DB_NAME', 'batdongsan');

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
define('AUTH_KEY',         'Z1I9pSe,S4DRI>XVtuDse.)w4u.[|lRfcW>4Zq-Ld%>?KY FOJgGI=WHo67@M7PY');
define('SECURE_AUTH_KEY',  '%i/i2gF~NiBMdCBCk)~Qm?BeKgj?Sn>`O[^+WuExe`IFm:`-Ylf*]=;|K.Y#qTHa');
define('LOGGED_IN_KEY',    '-]xFOW0_6q@rw[HN^6Rra3S<mf*NNKwK>!Zd}$7nj()W}*Lr*X!FESA#S)hJ,Z(N');
define('NONCE_KEY',        'ZsIH#|-.x6ToMUL{J8}Ie*u8(*13q::{m<-6+#CKqEL5+RYQr-)!4XjZ-S&&2y^p');
define('AUTH_SALT',        '`kq=],aOau a^vGl4b<|6e2E.ni,bsoQm=dNQEov<3_ScktkZ|[M$;B_Xp:L>`Y4');
define('SECURE_AUTH_SALT', '<TBv..%cr/#$g8j75+)&HU[btF7H(p++dJ7,s7|A:3,%M;kw1xZA&Jva/muQh//h');
define('LOGGED_IN_SALT',   '|aPE$8T#u}M!T>-GmG1ww8]xc(ys e--;V6Wwx3tc,Tj;Xv!uww`TD13Zms3Q>#{');
define('NONCE_SALT',       'AN+XY-mzZM(GzW*|](6UTJ$X0s94Df7dIEg8=y:C;e+(^gfLH]W9ZedMHq&~_<_e');

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
