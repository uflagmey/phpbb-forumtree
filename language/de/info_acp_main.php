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
	'ACP_FORUMTREE_TITLE'   => 'Forenbaum',
	'ACP_FORUMTREE'         => 'Baum anzeigen',
	'ACP_FORUMTREE_EXPLAIN' => 'Übersichtliche Darstellung aller Kategorien, Foren und Unterforen. Hilfreich beim Aufbau oder Umstrukturieren des Forums. Wechsele zwischen HTML, ASCII und BBCode – die BBCode-Variante lässt sich direkt in einen Forenbeitrag kopieren.',
]);
