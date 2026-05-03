<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree\acp;

class main_info
{
	public function module()
	{
		return [
			'filename' => '\uflagmey\forumtree\acp\main_module',
			'title'    => 'ACP_FORUMTREE_TITLE',
			'modes'    => [
				'display' => [
					'title' => 'ACP_FORUMTREE',
					'auth'  => 'ext_uflagmey/forumtree && acl_a_forum',
					'cat'   => ['ACP_FORUMTREE_TITLE'],
				],
			],
		];
	}
}
