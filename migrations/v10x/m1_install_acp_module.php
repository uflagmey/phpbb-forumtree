<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree\migrations\v10x;

class m1_install_acp_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function update_data()
	{
		return [
			// Container-Kategorie unter "Foren"
			['module.add', [
				'acp',
				'ACP_CAT_FORUMS',
				'ACP_FORUMTREE_TITLE',
			]],
			// Anzeige-Modus darunter hängen
			['module.add', [
				'acp',
				'ACP_FORUMTREE_TITLE',
				[
					'module_basename' => '\uflagmey\forumtree\acp\main_module',
					'modes'           => ['display'],
				],
			]],
		];
	}
}
