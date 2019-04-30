<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'a24music');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '$mart_B4');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|*w] V?U[*:~Wm}K?7>d6#-do;*H|vWKc|[z#mELQ|nfpJ9^L,|(AKEFbY!fhXRB');
define('SECURE_AUTH_KEY',  'a$T)yELX4kSHnB82[sncT`$!(<VHxC FsQ2RR?pB:OY+n,#qb!zFUve~re]C5fR&');
define('LOGGED_IN_KEY',    '0Z@:(G/>SpW24?0lx}lm!_Uxc*Jz}oLG>|s?NYqk??`dOG(,{]A>KgD_!;0E _i@');
define('NONCE_KEY',        ' -=7#xX!-QB?d@sZ@V<PF2*d(32%il0qq@-I`4k[:9j59s*,9mCS.g8#gHs`O3iV');
define('AUTH_SALT',        '0~*] D*?Q^Bu(w>L_^Zo6Y+ ZjVPzxKf$7*IMNqu1S+l#jaSr)Qb.fd>if[Ma3;l');
define('SECURE_AUTH_SALT', '-+4lraX5^N^azp0bZFKpj4j^>i_xr34|Bq3@+31[g2+Dk;x7Lp;%N]k6$ ,%C_{Y');
define('LOGGED_IN_SALT',   'JAyV6lM;+M.,IWlq5s]0<usGYy+{b *xXRJxrv+|K5q;ri!;+e$9EPc`g|v>Zqb>');
define('NONCE_SALT',       'I^?M@)<}PL9ssl5ms*l=XiO6U>#P!/EP%+4,sMpi 3M~+s1|ob_eb>[g!W&03p%d');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wpl_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', true);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');