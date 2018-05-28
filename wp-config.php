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
define('DB_NAME', '1000womenapp');

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
define('AUTH_KEY',         's]Tw)0QwQbNhm5)bz^3)h @O&ujtQ4PUWP)HehFVk@3xmQ5GG[~gRCsOyi1F+[iN');
define('SECURE_AUTH_KEY',  ':F%[*_<3Cfl5Mw:XRyH6]Lx=Vf`F}n^=JNM*v+CLaJ+DWs<R{(x}IhvQo1,]a&b/');
define('LOGGED_IN_KEY',    '4b5UsP=Q2{i%-a50,<p._P:86a^V?:I^O6.sKcz:v%Yy&{<(Xq85]=D1F^rTNswF');
define('NONCE_KEY',        ';Lh171b=#7=P<@C}69]T*bM|~uC<p@KvfKIkIezUb9L7KpFCGz;UoDAu|:tKIfMw');
define('AUTH_SALT',        'T_ozEs=o1=&qZ8,SdF2B3)Vl[An&mTljUoUc>/AW0$HV1Icabfq~o(AKa.7P`OZI');
define('SECURE_AUTH_SALT', 'F}?S[0|@QyZyO9cq$;~y+>vR#p$+Ry+~*v!kDBD]1-.VAo r8jbx%&p.2!81;w}@');
define('LOGGED_IN_SALT',   'g}gwOZ|/FcP,]pO(^AllwKb&LHQ}IETQc{#MRdHX+m%,$;o#mF[$1FM8.5^U?||A');
define('NONCE_SALT',       'aH8oYH3oz(m@SB&gW3KnJZbDeP^Wn_~M;f6PM`?V$.u:s61}8&tXIu_>tx!mf%Z/');

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
