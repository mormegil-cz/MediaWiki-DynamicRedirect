<?php
/**
 * DynamicRedirect extension - Provide dynamically determined redirections
 *
 * @file
 * @ingroup Extensions
 * @author Petr Kadlec <mormegil@centrum.cz>
 * @copyright © 2013 Petr Kadlec
 * @license GNU General Public Licence 2.0 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	echo <<<EOT
To install DynamicRedirect, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/DynamicRedirect/DynamicRedirect.php" );
EOT;
	exit( 1 );
}
 
$wgExtensionCredits[ 'specialpage' ][] = array(
	'path' => __FILE__,
	'name' => 'DynamicRedirect',
	'author' => 'Petr Kadlec',
	'url' => 'https://www.mediawiki.org/wiki/Extension:DynamicRedirect',
	'descriptionmsg' => 'dynamicredirect-desc',
	'version' => '0.1.0',
);

$wgAutoloadClasses[ 'SpecialDynamicRedirect' ] = __DIR__ . '/SpecialDynamicRedirect.php';
$wgExtensionMessagesFiles[ 'DynamicRedirect' ] = __DIR__ . '/DynamicRedirect.i18n.php';
$wgExtensionMessagesFiles[ 'DynamicRedirectAlias' ] = __DIR__ . '/DynamicRedirect.alias.php';
$wgSpecialPages[ 'DynamicRedirect' ] = 'SpecialDynamicRedirect';
