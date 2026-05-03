<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'FORUMTREE_TITLE'         => 'Forum tree',
	'FORUMTREE_VIEW_ASCII'    => 'View as ASCII',
	'FORUMTREE_VIEW_BBCODE'   => 'View as BBCode',
	'FORUMTREE_SHOW_COUNTS'   => 'Show topic/post counts',
	'FORUMTREE_HIDE_COUNTS'   => 'Hide topic/post counts',
	'FORUMTREE_FORMAT'        => 'Format',
]);
