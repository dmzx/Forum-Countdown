<?php
/**
*
* @package phpBB Extension - Forum Countdown
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\forumcountdown\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\user;
use phpbb\template\template;
use phpbb\config\config;
use phpbb\request\request_interface;

class listener implements EventSubscriberInterface
{
	/** @var user */
	protected $user;

	/** @var template */
	protected $template;

	/** @var config */
	protected $config;

	/** @var request_interface */
	protected $request;

	/**
	* Constructor
	*
	* @param user			$user
	* @param template		$template
	* @param config			$config
	* @param request		$request
	*
	*/
	public function __construct(
		user $user,
		template $template,
		config $config,
		request_interface $request
	)
	{
		$this->user 				= $user;
		$this->template 			= $template;
		$this->config 				= $config;
		$this->request				= $request;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.acp_manage_forums_request_data'		=> 'acp_manage_forums_request_data',
			'core.acp_manage_forums_initialise_data'	=> 'acp_manage_forums_initialise_data',
			'core.acp_manage_forums_display_form'		=> 'acp_manage_forums_display_form',
			'core.viewforum_get_topic_data'				=> 'viewforum_get_topic_data',
		);
	}

	// Submit form (add/update)
	public function acp_manage_forums_request_data($event)
	{
		$forum_data = $event['forum_data'];

		$forum_data = array_merge($forum_data, array(
			'forumcountdown_enable' 	=> $this->request->variable('forumcountdown_enable', false),
			'forumcountdown_date'	 	=> $this->request->variable('forumcountdown_date', ''),
			'forumcountdown_text'	 	=> $this->request->variable('forumcountdown_text', ''),
			'forumcountdown_complete'	=> $this->request->variable('forumcountdown_complete', ''),
			'forumcountdown_testmode' 	=> $this->request->variable('forumcountdown_testmode', false),
		));
		$event['forum_data'] = $forum_data;
	}

	// Default settings for new forums
	public function acp_manage_forums_initialise_data($event)
	{
		$forum_data = $event['forum_data'];

		if ($event['action'] == 'add')
		{
			$forum_data['forumcountdown_enable'] =	false;
			$forum_data['forumcountdown_date'] = '';
			$forum_data['forumcountdown_text'] = '';
			$forum_data['forumcountdown_complete'] = '';
			$forum_data['forumcountdown_testmode'] =	false;
		}
		$event['forum_data'] = $forum_data;
	}

	// ACP forums template output
	public function acp_manage_forums_display_form($event)
	{
		$this->user->add_lang_ext('dmzx/forumcountdown', 'common');

		$template_data = $event['template_data'];
		$forum_data = $event['forum_data'];

		$template_data = array_merge($template_data, array(
			'FORUM_COUNTDOWN_ENABLE' 		=> $forum_data['forumcountdown_enable'] ? true : false,
			'FORUM_COUNTDOWN_DATE'			=> (isset($forum_data['forumcountdown_date'])) ? $forum_data['forumcountdown_date'] : '',
			'FORUM_COUNTDOWN_TEXT'			=> (isset($forum_data['forumcountdown_text'])) ? $forum_data['forumcountdown_text'] : '',
			'FORUM_COUNTDOWN_COMPLETE'		=> (isset($forum_data['forumcountdown_complete'])) ? $forum_data['forumcountdown_complete'] : '',
			'FORUM_COUNTDOWN_TESTMODE'		=> $forum_data['forumcountdown_testmode'] ? true : false,
			'FORUM_COUNTDOWN_VERSION'		=> $this->config['forumcountdown_version'],
		));
		$event['template_data'] = $template_data;
	}

	public function viewforum_get_topic_data($event)
	{
		$forum_data = $event['forum_data'];

		if ($event['forum_data']['forumcountdown_enable'] ? true : false)
		{
			$this->template->assign_vars(array(
				'FORUM_COUNTDOWN_ENABLE' 		=> $forum_data['forumcountdown_enable'] ? true : false,
				'FORUM_COUNTDOWN_DATE'			=> (isset($forum_data['forumcountdown_date'])) ? $forum_data['forumcountdown_date'] : '',
				'FORUM_COUNTDOWN_TEXT'			=> (isset($forum_data['forumcountdown_text'])) ? $forum_data['forumcountdown_text'] : '',
				'FORUM_COUNTDOWN_COMPLETE'		=> (isset($forum_data['forumcountdown_complete'])) ? $forum_data['forumcountdown_complete'] : '',
				'FORUM_COUNTDOWN_TESTMODE'		=> $forum_data['forumcountdown_testmode'] ? true : false,
			));
		}
	}
}
