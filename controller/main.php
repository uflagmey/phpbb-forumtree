<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree\controller;

use phpbb\auth\auth;
use phpbb\controller\helper;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\HttpFoundation\Response;

class main
{
	/** @var auth */
	protected $auth;

	/** @var driver_interface */
	protected $db;

	/** @var helper */
	protected $helper;

	/** @var language */
	protected $language;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string */
	protected $forums_table;

	public function __construct(
		auth $auth,
		driver_interface $db,
		helper $helper,
		language $language,
		request $request,
		template $template,
		user $user,
		$forums_table
	)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->helper = $helper;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->forums_table = $forums_table;
	}

	/**
	 * Public route: /app.php/forumtree
	 * Optional ?format=html|ascii|bbcode  (default html)
	 * Optional &counts=1
	 */
	public function display()
	{
		$this->language->add_lang('common', 'uflagmey/forumtree');

		$format = $this->sanitize_format($this->request->variable('format', 'html'));
		$show_counts = (bool) $this->request->variable('counts', 0);

		$children = $this->load_children(/*include_hidden*/ false);

		if ($format === 'ascii' || $format === 'bbcode')
		{
			$tree = $this->render_ascii($children, 0, '', $show_counts);
			if ($format === 'bbcode')
			{
				$tree = "[code]\n" . $tree . "[/code]\n";
			}
			return new Response($tree, 200, ['Content-Type' => 'text/plain; charset=utf-8']);
		}

		// HTML via phpBB-Template
		$this->assign_html_tree($children, 0, $show_counts);
		$this->template->assign_vars([
			'L_FORUMTREE_TITLE'      => $this->language->lang('FORUMTREE_TITLE'),
			'U_FORUMTREE_ASCII'      => $this->helper->route('uflagmey_forumtree_display', ['format' => 'ascii'] + ($show_counts ? ['counts' => 1] : [])),
			'U_FORUMTREE_BBCODE'     => $this->helper->route('uflagmey_forumtree_display', ['format' => 'bbcode'] + ($show_counts ? ['counts' => 1] : [])),
			'U_FORUMTREE_TOGGLE_CNT' => $this->helper->route('uflagmey_forumtree_display', ['counts' => $show_counts ? 0 : 1]),
			'S_SHOW_COUNTS'          => $show_counts,
		]);

		return $this->helper->render('forumtree_body.html', $this->language->lang('FORUMTREE_TITLE'));
	}

	// ---- Datenbeschaffung ---------------------------------------------------

	/**
	 * Lädt alle Foren, gefiltert über phpBBs ACL ("kann sehen"), und gibt sie
	 * als Children-Map (parent_id → list of forums) zurück.
	 */
	public function load_children($include_hidden = false)
	{
		$sql = 'SELECT forum_id, parent_id, forum_name, forum_type,
					   forum_topics_approved, forum_posts_approved
				  FROM ' . $this->forums_table . '
			  ORDER BY left_id ASC';

		$result = $this->db->sql_query($sql);
		$children = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$forum_id = (int) $row['forum_id'];
			// ACL-Filter: nur Foren anzeigen, die der User sehen darf
			// (Kategorien, forum_type=0, immer sichtbar wenn Inhalt sichtbar ist)
			if (!$include_hidden && (int) $row['forum_type'] !== 0
				&& !$this->auth->acl_get('f_list', $forum_id))
			{
				continue;
			}
			$children[(int) $row['parent_id']][] = $row;
		}
		$this->db->sql_freeresult($result);

		return $children;
	}

	// ---- Renderer -----------------------------------------------------------

	public function render_ascii(array $children, $parent = 0, $prefix = '', $show_counts = false)
	{
		$out = '';
		$kids = isset($children[$parent]) ? $children[$parent] : [];
		$n = count($kids);
		foreach ($kids as $i => $f)
		{
			$is_last = ($i === $n - 1);
			$branch = $is_last ? '└── ' : '├── ';
			$tag = ((int) $f['forum_type'] === 0) ? ' [Kategorie]' : '';
			$extra = '';
			if ($show_counts && (int) $f['forum_type'] !== 0)
			{
				$extra = sprintf('  (%d / %d)',
					(int) $f['forum_topics_approved'],
					(int) $f['forum_posts_approved']);
			}
			$out .= $prefix . $branch . $f['forum_name'] . $tag . $extra . "\n";
			$next = $prefix . ($is_last ? '    ' : '│   ');
			$out .= $this->render_ascii($children, (int) $f['forum_id'], $next, $show_counts);
		}
		return $out;
	}

	/**
	 * Pusht die Foren als Template-Block "forums" in eingerückter Reihenfolge.
	 * Tiefe steckt in `depth` für CSS.
	 */
	protected function assign_html_tree(array $children, $parent = 0, $show_counts = false, $depth = 0)
	{
		foreach (($children[$parent] ?? []) as $f)
		{
			$this->template->assign_block_vars('forums', [
				'NAME'      => $f['forum_name'],
				'IS_CAT'    => ((int) $f['forum_type'] === 0),
				'DEPTH'     => $depth,
				'TOPICS'    => (int) $f['forum_topics_approved'],
				'POSTS'     => (int) $f['forum_posts_approved'],
				'PADDING'   => $depth * 24, // px
			]);
			$this->assign_html_tree($children, (int) $f['forum_id'], $show_counts, $depth + 1);
		}
	}

	// ---- Helpers ------------------------------------------------------------

	protected function sanitize_format($format)
	{
		$format = strtolower($format);
		return in_array($format, ['html', 'ascii', 'bbcode'], true) ? $format : 'html';
	}
}
