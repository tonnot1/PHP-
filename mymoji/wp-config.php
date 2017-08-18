<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'moji_db');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&fZs43mG+ xFeaV~,&v#d9XKl=Pn]6~PJ:Ng`1&8p2`H4mCtr6T/umLMFML]+m!u');
define('SECURE_AUTH_KEY',  '=0Sbn=PS]AJ>7k1:LB,N_s66{I?Z-Tl/rKH M%:q%JBjd(M A47yZm5ZV=7Z5 c6');
define('LOGGED_IN_KEY',    '.7cr9USRr{({rJoHz!v{FJAXEs5;k:i3 %xQ3bS/5*xIl~z+%?,Q|hKJ S<tl-Zf');
define('NONCE_KEY',        'NN8^IkIoLw4q/3^8xN1a]R>!PDe}|_4K$;XR&uA[;Y5o KwwJ8_V,/3f3SgNwmq7');
define('AUTH_SALT',        '>>l}&[ryI|6Ct(TAY]^Kdlj5O3}1QUYX>0/99JJ!];WsoPn]Zo#7]xTO|Gal.kx`');
define('SECURE_AUTH_SALT', '$S>z<>@(4%N=Eu1D^SAbnWUHkjW>+}a]B[Yp(<1%Ng11!b2l7KLREw#17]]^@YfD');
define('LOGGED_IN_SALT',   'QDSt(2|Zc^;$,X0igY{zf!%zqmI.Tg%B7SBB$;dN?eH{{(q3I-7?mSHw8V70n_%y');
define('NONCE_SALT',       '<CaA9pZltkjEjG?E}f=InkSO!KgGtQ)+uQRjz5aChkeB^De EYz+V+)k~*TS]y&g');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');