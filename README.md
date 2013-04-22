MediaWiki-DynamicRedirect
=========================

© Petr Kadlec <mormegil@centrum.cz>

DynamicRedirect extension for MediaWiki. It provides redirection to
a dynamically determined page. In the current version, the target can be
determined either by evaluating a piece of wikitext, or chosen from
a category.

See also https://www.mediawiki.org/wiki/Extension:DynamicRedirect

Installation
------------

* Copy all extension files in a directory called "DynamicRedirect" in your extensions/ folder.
* Add the following code to your LocalSettings.php (at the bottom)

`require_once( "$IP/extensions/DynamicRedirect/DynamicRedirect.php" );`

* Done – Navigate to Special:Version on your wiki to verify that the extension is successfully installed.

Usage
-----

By going to a URL in the form of

    .../Special:DynamicRedirect?mode=MODE&target=TARGET

the user is redirected to a page chosen based on the values of the parameters:

* `MODE` is the primary mode selector, the currently supported values are:
 * `parse` – parse the expression given in `TARGET` and use the resulting text as the page title to redirect to
 * `catfirst` – redirect to the first page in the category which title is in `TARGET` (without the _Category:_ prefix)
 * `catlast` – redirect to the last page in the category which title is in `TARGET` (without the _Category:_ prefix)
* `TARGET`– parameter containing either the wikitext, or the category name

If the parameters are not valid, or there is no target page fulfilling the parameters, Special:DynamicRedirect displays a UI (and possible an error message) showing the possible options.

Feedback
--------

All feedback, bug reports, etc. welcome at <mormegil@centrum.cz>.

License
-------

Copyright © 2013 Petr Kadlec <mormegil@centrum.cz>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.