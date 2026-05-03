<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

if (!defined('IN_PHPBB')) {
	exit;
}

if (empty($lang) || !is_array($lang)) {
	$lang = [];
}

$lang = array_merge($lang, [
	'FORUMTREE_TITLE'         => 'Forenbaum',
	'FORUMTREE_VIEW_ASCII'    => 'Als ASCII anzeigen',
	'FORUMTREE_VIEW_BBCODE'   => 'Als BBCode anzeigen',
	'FORUMTREE_SHOW_COUNTS'   => 'Themen-/Beitragsanzahl einblenden',
	'FORUMTREE_HIDE_COUNTS'   => 'Themen-/Beitragsanzahl ausblenden',
	'FORUMTREE_FORMAT'        => 'Format',
]);
