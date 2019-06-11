<?php
/**
*
* @package phpBB Extension - Forum Countdown
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\forumcountdown\migrations;

class forumcountdown_install extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('forumcountdown_version', '1.0.0')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'forumcountdown_enable'			=> array('UINT', 0),
					'forumcountdown_date' 			=> array('VCHAR:255', ''),
					'forumcountdown_text' 			=> array('VCHAR:255', ''),
					'forumcountdown_complete' 		=> array('VCHAR:255', ''),
					'forumcountdown_testmode' 		=> array('UINT', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return 	array(
			'drop_columns' => array(
				$this->table_prefix . 'forums'	=> array(
					'forumcountdown_enable',
					'forumcountdown_date',
					'forumcountdown_text',
					'forumcountdown_complete',
					'forumcountdown_testmode',
				),
			),
		);
	}
}
