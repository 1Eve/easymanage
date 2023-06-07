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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'easymanage' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
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
define( 'AUTH_KEY',         'DhRU[n(qg=HJwn<~TO$_).R/o#YpdHXPuID`e+|IQB=@v`-|Eaw8F;kn[T}`@})v' );
define( 'SECURE_AUTH_KEY',  'c,yT}2#QDS;dS$,h/u7`5P]3^IPcQ>>+I|` acawb9PskBR,-%W|2)%TP>4*TK!T' );
define( 'LOGGED_IN_KEY',    '>Ig{La[yakaB$@3Rjmyi#A(Un-Y`Rsx5bgL~AT|L4Pqzz}I5LgC4|U h5S,Vo9zO' );
define( 'NONCE_KEY',        '>Q_!xpF=rv<,L&$84zcG@S!1u/{<C;(>NB@:2C<u5-@;u~f)wCR+B6E;86.<QFp:' );
define( 'AUTH_SALT',        'L{Zmnq`{K$p86OKQmo_] gs;l]<6}|Ud(KjkRVr$TD%ZmS}h:ihzH^L:pQq~.?3K' );
define( 'SECURE_AUTH_SALT', '?Q{+>~&%liMv-xS%H1J|*4M}l/YA pPvl-fgV,g`1smw%>i.aTSaRGI(@nfO32=F' );
define( 'LOGGED_IN_SALT',   ',%^5Vu0a9H= ULBu/yw{i+Y<je8JZW.kKRJk}Iru^@G#C-]ejNd|rrKf[l*<.0],' );
define( 'NONCE_SALT',       '8?1r@=bM~gEQO;Y[~!qK?LgM=5DiXmC);sttZVwfVs<#j)hSK*KG;}61cBF:8_fU' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
