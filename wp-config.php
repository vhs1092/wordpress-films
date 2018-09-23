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
define('DB_NAME', 'wordpress_codeline_test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JEMNBGV<}w3-lI)u0]/P8rPWv#,{$C+!wt]sxY/enubXdLOu$TG&s[gK()`%XW&~');
define('SECURE_AUTH_KEY',  'JUB)fn,#v2QIn.Zw:DPcfxc=Q#d{jSl}9EwHALlQ+PS@rlf8Req74,3hl3DW<ls@');
define('LOGGED_IN_KEY',    'I{los  ?A;f|=_/3id,C r[]=IBdJ--Lo1p}Z<}5`rr]jyhJ`L#:AOxb>fycNtC}');
define('NONCE_KEY',        'Tc`Gt6FC_7#tS[>u@y,LpZzF4+O_HLdcw2Jp:ynCR.Id1yZSVoYl.b9MqxT|a<tq');
define('AUTH_SALT',        'd[&AiI%i3HwdTGP1,=}Vw=uZ^Yu8I|93dbx+lV7&Es-idKd^Tb#&v}9KbRYq:V-s');
define('SECURE_AUTH_SALT', '-{cgD_5p&Tzb!5uicjTVEVo4*+m/p>IjVc0TL clloT0^1#MLdT`UL#@qKsMUHcA');
define('LOGGED_IN_SALT',   'G=w>55~B9u|h-^x]FQ;c#@G[rzu9.)41%-Mfik8+hWWm(XV~:x}C1GR/KD|uV^{o');
define('NONCE_SALT',       'QJ$Pde62Saam!Ul-le;$dS6%>aLY<&[SaUfS#l7M#PUa0GSYRMz*6h{BhV#v J|.');

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
