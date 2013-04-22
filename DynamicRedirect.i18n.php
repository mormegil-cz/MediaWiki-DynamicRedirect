<?php
/**
 * Internationalisation for DynamicRedirect
 *
 * @file
 * @ingroup Extensions
 */
$messages = array();

/** English
 * @author Mormegil
 */
$messages[ 'en' ] = array(
	'dynamicredirect' => 'Dynamic Redirect',
	'dynamicredirect-desc' => 'Provides [[Special:DynamicRedirect|a special page]] redirecting to a dynamically determined page',
	'dynamicredirect-nosuchtarget' => 'The destination page [[$1]] you have specified does not exist.',
	'dynamicredirect-mode' => 'Destination selection mode:',
	'dynamicredirect-mode-parse' => 'Parse the given wikitext',
	'dynamicredirect-mode-catfirst' => 'The first page of the given category',
	'dynamicredirect-mode-catlast' => 'The last page of the given category',
	'dynamicredirect-target' => 'Destination parameter:',
	'dynamicredirect-submit' => 'Redirect',
	'dynamicredirect-badtitle' => '„$1“ is not a valid page title',
	'dynamicredirect-emptycategory' => 'Category [[:$1|$1]] is empty or nonexistent',
);

/** Message documentation
 * @author Mormegil
 */
$messages[ 'qqq' ] = array(
	'dynamicredirect' => "The name of the extension's entry in Special:SpecialPages",
	'dynamicredirect-desc' => '{{desc}}',
	'dynamicredirect-nosuchtarget' => 'Error message shown when the destination page does not exist. $1 is the resulting name of the destination page',
	'dynamicredirect-mode' => 'Label for a mode selector on [[Special:DynamicRedirect]]',
	'dynamicredirect-mode-parse' => 'One of destination selection modes: Parse the given parameter as wikitext, and use the result as a page title.',
	'dynamicredirect-mode-catfirst' => 'One of destination selection modes: Redirect to the first page of the category given as the parameter',
	'dynamicredirect-mode-catlast' => 'One of destination selection modes: Redirect to the last page of the category given as the parameter',
	'dynamicredirect-target' => 'Label for an input field for the parameter (category name or wikitext)',
	'dynamicredirect-submit' => 'Submit button at [[Special:DynamicRedirect]]',
	'dynamicredirect-badtitle' => 'Error message shown when a given title is not a valid page title',
	'dynamicredirect-emptycategory' => 'Error message shown when the given category does not contain any pages',
);

/** Czech
 * @author Mormegil
 */
$messages[ 'cs' ] = array(
	'dynamicredirect' => 'Dynamické přesměrování',
	'dynamicredirect-desc' => 'Poskytuje [[Special:DynamicRedirect|speciální stránku]] přesměrovávající na dynamicky určenou stránku',
	'dynamicredirect-nosuchtarget' => 'Specifikovaná cílová stránka [[$1]] neexistuje.',
	'dynamicredirect-mode' => 'Režim výběru cílové stránky:',
	'dynamicredirect-mode-parse' => 'Zpracovat zadaný wikitext',
	'dynamicredirect-mode-catfirst' => 'První stránka v zadané kategorii',
	'dynamicredirect-mode-catlast' => 'Poslední stránka v zadané kategorii',
	'dynamicredirect-target' => 'Parametr cíle:',
	'dynamicredirect-submit' => 'Přesměrovat',
	'dynamicredirect-badtitle' => '„$1“ není platný název stránky',
	'dynamicredirect-emptycategory' => 'Kategorie [[:$1|$1]] je prázdná nebo neexistuje',
);
