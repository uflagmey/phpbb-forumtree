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
	'ACP_FORUMTREE_TITLE'   => 'Forum Tree',
	'ACP_FORUMTREE'         => 'Display tree',
	'ACP_FORUMTREE_EXPLAIN' => 'A condensed view of all categories, forums and subforums. Useful while building or restructuring the board. Switch between HTML, ASCII and BBCode output – the BBCode variant can be copy-pasted into a forum post.',
]);
