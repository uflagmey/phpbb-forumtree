<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree\acp;

class main_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main($id, $mode)
	{
		global $template, $user, $request, $db, $table_prefix;

		$user->add_lang_ext('uflagmey/forumtree', 'common');
		$user->add_lang_ext('uflagmey/forumtree', 'info_acp_main');

		$format = strtolower((string) $request->variable('format', 'html'));
		if (!in_array($format, ['html', 'ascii', 'bbcode'], true))
		{
			$format = 'html';
		}
		$show_counts = (bool) $request->variable('counts', 0);

		$sql = 'SELECT forum_id, parent_id, forum_name, forum_type,
		               forum_topics_approved, forum_posts_approved
		          FROM ' . $table_prefix . 'forums
		      ORDER BY left_id ASC';

		$result = $db->sql_query($sql);
		$children = [];
		while ($row = $db->sql_fetchrow($result))
		{
			$children[(int) $row['parent_id']][] = $row;
		}
		$db->sql_freeresult($result);

		$ascii = $this->render_ascii($children, 0, '', $show_counts);

		$template->assign_vars([
			'FORUMTREE_ASCII'  => $ascii,
			'FORUMTREE_BBCODE' => "[code]\n" . $ascii . "[/code]\n",
			'S_SHOW_COUNTS'    => $show_counts,
			'S_FORMAT'         => $format,
			'U_TOGGLE_COUNTS'  => $this->u_action . '&amp;counts=' . ($show_counts ? '0' : '1'),
			'U_FORMAT_HTML'    => $this->u_action . '&amp;format=html'   . ($show_counts ? '&amp;counts=1' : ''),
			'U_FORMAT_ASCII'   => $this->u_action . '&amp;format=ascii'  . ($show_counts ? '&amp;counts=1' : ''),
			'U_FORMAT_BBCODE'  => $this->u_action . '&amp;format=bbcode' . ($show_counts ? '&amp;counts=1' : ''),
		]);

		$this->assign_html_tree($template, $children, 0, $show_counts, 0);

		$this->tpl_name   = 'acp_forumtree_body';
		$this->page_title = $user->lang('ACP_FORUMTREE_TITLE');
	}

	protected function render_ascii(array $children, $parent = 0, $prefix = '', $show_counts = false)
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

	protected function assign_html_tree($template, array $children, $parent = 0, $show_counts = false, $depth = 0)
	{
		if (!isset($children[$parent]))
		{
			return;
		}
		foreach ($children[$parent] as $f)
		{
			$template->assign_block_vars('forums', [
				'NAME'    => $f['forum_name'],
				'IS_CAT'  => ((int) $f['forum_type'] === 0),
				'DEPTH'   => $depth,
				'TOPICS'  => (int) $f['forum_topics_approved'],
				'POSTS'   => (int) $f['forum_posts_approved'],
				'PADDING' => $depth * 24,
			]);
			$this->assign_html_tree($template, $children, (int) $f['forum_id'], $show_counts, $depth + 1);
		}
	}
}
