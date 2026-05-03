<?php
/**
 * Forum Tree extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Uwe Flagmeyer
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace uflagmey\forumtree\event;

use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	/** @var helper */
	protected $helper;

	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	public function __construct(helper $helper, language $language, template $template)
	{
		$this->helper = $helper;
		$this->language = $language;
		$this->template = $template;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.page_header_after' => 'add_forumtree_link',
		];
	}

	/**
	 * Stellt URL und Beschriftung des Forenbaum-Links global im Template bereit.
	 * Das Template-Event styles/all/template/event/overall_header_navigation_append.html
	 * rendert daraus den eigentlichen Menü-Eintrag.
	 */
	public function add_forumtree_link()
	{
		$this->language->add_lang('common', 'uflagmey/forumtree');

		$this->template->assign_vars([
			'U_FORUMTREE'  => $this->helper->route('uflagmey_forumtree_display'),
			'L_FORUMTREE'  => $this->language->lang('FORUMTREE_TITLE'),
		]);
	}
}
