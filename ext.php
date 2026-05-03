<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree;

class ext extends \phpbb\extension\base
{
	/**
	 * Mindest-phpBB-Version, ab der die Extension aktiviert werden kann.
	 */
	const PHPBB_MIN_VERSION = '3.3.0';

	/**
	 * Prüft Voraussetzungen vor der Aktivierung.
	 *
	 * @return bool|string  true wenn aktivierbar, ansonsten Fehlermeldung
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		if (version_compare($config['version'], self::PHPBB_MIN_VERSION, '<'))
		{
			return 'Forum Tree benötigt phpBB ' . self::PHPBB_MIN_VERSION . ' oder neuer.';
		}

		return true;
	}
}
