<?php
/**
 * [[Special:DynamicRedirect]] – Provide dynamically determined redirections
 *
 * @file
 * @ingroup Extensions
 * @author Petr Kadlec <mormegil@centrum.cz>
 * @copyright © 2013 Petr Kadlec
 * @license GNU General Public Licence 2.0 or later
 */

class SpecialDynamicRedirect extends IncludableSpecialPage {

	function __construct() {
		parent::__construct( 'DynamicRedirect' );
	}

	function execute( $par ) {
		global $wgUser, $wgTitle;

		$this->setHeaders();
		$this->outputHeader();
		$request = $this->getRequest();

		$mode = $request->getText( 'mode' );
		$target = $request->getText( 'target' );

		$destination = false;

		if ( $mode !== '' && $target !== '' ) {
			switch( $mode ) {
			case 'parse':
				$destination = $this->getFromParse( $target );
				break;
			case 'catfirst':
				$destination = $this->getFromCategory( $target, 'ASC' );
				break;
			case 'catlast':
				$destination = $this->getFromCategory( $target, 'DESC' );
				break;
			default:
				$this->showError( 'dynamicredirect-badmode' );
				break;
			}
		} else {
			if ( $this->including() ) {
				$this->showError( 'dynamicredirect-badparams' );
			}
		}

		if ( ! $destination instanceof Title ) {
			if ( ! $this->including() ) {
				$this->showForm( $mode, $target );
			}
		} else if ( $destination->exists() ) {
			if ( $this->including() ) {
				$myParser = new Parser();
				$myParserOptions = ParserOptions::newFromUser( $wgUser );
				$parsed = $myParser->parse( '{{:' . $destination->getPrefixedText() . '}}', $wgTitle, $myParserOptions, true )->getText();
				$this->getOutput()->addHtml( $parsed );
			} else {
				$this->getOutput()->redirect( $destination->getFullUrl() );
			}
		} else {
			$this->showError( 'dynamicredirect-nosuchtarget', htmlspecialchars( $destination->getPrefixedText() ) );
			if ( ! $this->including() ) {
				$this->showForm( $mode, $target );
			}
		}
	}

	private function showError( /* ... */ ) {
		$args = func_get_args();
		if ( $this->including() ) {
			$this->getOutput()->wrapWikiMsg( "<div class='error'>\n$1\n</div>", $args );
		} else {
			$msg = array_shift( $args );
			$this->getOutput()->addWikiMsgArray( $msg, $args );
		}
	}

	private function showForm( $mode, $target ) {
		global $wgScript;

		$modes = array();
		foreach ( array( 'parse', 'catfirst', 'catlast' ) as $modeOption ) {
			$modes[] = Xml::option( $this->msg( "dynamicredirect-mode-$modeOption" ), $modeOption, $mode == $modeOption );
		}

		$this->getOutput()->addHTML(
			Html::openElement( 'form', array( 'method' => 'get', 'action' => $wgScript, 'id' => 'specialdynamicredirect' ) ) .
			Html::openElement( 'fieldset' ) .
			Html::element( 'legend', null, $this->msg( 'dynamicredirect' )->text() ) .
			Html::hidden( 'title', $this->getTitle()->getPrefixedText() ) .
			Xml::label( $this->msg( 'dynamicredirect-mode' )->text(), 'dynamicredirect-mode' ) . " " .
			Html::openElement( 'select', array( 'id' => 'dynamicredirect-mode', 'name' => 'mode' ) ) . "\n" .
			implode( "\n", $modes ) .
			Html::closeElement( 'select' ) . "<br />\n" .
			Xml::inputLabel( $this->msg( 'dynamicredirect-target' )->text(), 'target', 'dynamicredirect-target', 40, $target ) . "<br />\n" .
			Xml::submitButton( $this->msg( 'dynamicredirect-submit' )->text() ) . "\n" .
			Html::closeElement( 'fieldset' ) .
			Html::closeElement( 'form' )
		);
	}

	private function getFromParse( $wikiText ) {
		global $wgTitle, $wgUser;
		$myParser = new Parser();
		$myParserOptions = ParserOptions::newFromUser( $wgUser );
		$parsed = $myParser->parse( $wikiText, $wgTitle, $myParserOptions, true )->getText();
		$m = array();
		if ( preg_match( '/^<p>(.*)\n?<\/p>\n?/sU', $parsed, $m ) ) {
			$parsed = $m[1];
		}
		$result = Title::newFromText( $parsed );
		if ( $result == null ) {
			$this->showError( 'dynamicredirect-badtitle', htmlspecialchars( $parsed ) );
		}
		return $result;
	}

	private function getFromCategory( $categoryName, $ordering ) {
		$categoryTitle = Title::makeTitleSafe( NS_CATEGORY, $categoryName );
		if ( $categoryTitle == null || $categoryTitle->getNamespace() != NS_CATEGORY ) {
			$this->showError( 'dynamicredirect-badtitle', htmlspecialchars( $categoryName ) );
			return false;
		}

		$dbr = wfGetDB( DB_SLAVE, 'category' );

		$res = $dbr->select(
			array( 'page', 'categorylinks', 'category' ),
			array( 'page_title', 'page_namespace' ),
			array( 'cl_to' => $categoryTitle->getDBKey() ),
			__METHOD__,
			array(
				'USE INDEX' => array( 'categorylinks' => 'cl_sortkey' ),
				'LIMIT' => 1,
				'ORDER BY' => 'cl_sortkey ' . $ordering
			),
			array(
				'categorylinks' => array( 'INNER JOIN', 'cl_from = page_id' ),
				'category' => array( 'LEFT JOIN', array(
					'cat_title = page_title',
					'page_namespace' => NS_CATEGORY
				) )
			)
		);

		$row = $dbr->fetchObject( $res );
		if ( $row === false ) {
			$this->showError( 'dynamicredirect-emptycategory', htmlspecialchars( $categoryName ) );
			return false;
		}

		return Title::newFromRow( $row );
	}

	protected function getGroupName() {
		return 'redirects';
	}
}
