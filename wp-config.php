<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'db_harmony' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', '' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/~FF88W-0ZzgFFC(+vr+knAlx{}E0P]5emS <H6K%EZ<n(4%m<(V@P?/t %@JHrP' );
define( 'SECURE_AUTH_KEY',  'oOtg*/a``$`1^CC~qp#AM;o}a~Ws@HHw,n4L2Vr6&9a5Hoqmm?WqrvIT<#_sfg<X' );
define( 'LOGGED_IN_KEY',    'GlbAEXlkQ8&d24EP|_VUwtu[.c$]ajsdQ#yakf@L;-1M|>{nt!`u8TR*r~e+1vIB' );
define( 'NONCE_KEY',        'TBc:M )GAL?}hEloeo/ogxX,~7zWFTQPVfI]t,GYR2P!>nYcMa*uXdSDFZ@YODAb' );
define( 'AUTH_SALT',        'ec|&L^F;*b4O/5wL4yY|zF14&<+t5GgL5<H7uq^}3s8v(|;+QpOQ=<C/fc[,/R{/' );
define( 'SECURE_AUTH_SALT', '3&e<+iR!0<CTeVFe!Z ,vHx=y1[Jul6qzi*N!Kg8LIQ{TPUqcj.DQ?zxt;4OeXq9' );
define( 'LOGGED_IN_SALT',   'ZR,;u48J%]84Y_#+`Bn6XE?ESjw=<ZP%CKl6,$q^itp`mMvd$guIq]ti T0Wk9Wa' );
define( 'NONCE_SALT',       'm41|9XF X+8L1]<j40tqy<#G>nhz>Ojz@<zB<~-cwLaI@Z+fm)gG8ve$etgg|Mx)' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );



/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
