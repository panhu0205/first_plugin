<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ngocanhdaothi01' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '];jmeT]<BORL.yYv).LI5jHvj1)LxgN2]~I^p -<&Uyi8i Az8>.@UO;##8L[9#%' );
define( 'SECURE_AUTH_KEY',  's<S#?k3v7h_sFUI<`$oAMf:r4D@t%^Uusn2L ?3N}VblEeMBDUoq(56u#_O92xn<' );
define( 'LOGGED_IN_KEY',    '5#gpD+0u*U#Vnz(b:iA#E!H0Zvo|3^0Fiw Y,.<MTDJ7j[lp<;-YQu6K8Cu]FcMX' );
define( 'NONCE_KEY',        'nhc9dqr;hy_EFeoP[U .P{q&hR*P$ubvp.Wr)-/jf&=sdivxC*w=demC,9q$N3XN' );
define( 'AUTH_SALT',        '~E6A^E2ta.s~:Wv*SM&AwO_og`c60[xS3,#{%NsaoVSf3wJ&g&5}rH`&|pW9^YIa' );
define( 'SECURE_AUTH_SALT', ' ,g`(P&l}@zs&jL:U^u }ldkGqWdoRpf7EjmENh6QUG[tS9@mOd*-8%R]uCUD2|Q' );
define( 'LOGGED_IN_SALT',   'u ,k&IpQd_cmjc=0xeqaqkK^ mzzT8}&NM/@n8p%>2P2w6[~CVTmYvW{xM:~5C@%' );
define( 'NONCE_SALT',       'ZqZm[qj@gTveGTY]~M!0$-i*4BR~4`oF+1iV$[y5c!)ML )4sZp*w 4mRr*(Y^:)' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
