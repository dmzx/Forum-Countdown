<?php
/**
*
* @package phpBB Extension - Forum Countdown
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_FORUM_COUNTDOWN_CONFIG'			=> 'Forum Countdown',
	'FORUM_COUNTDOWN_VERSION'				=> 'Version',
	'FORUM_COUNTDOWN_ENABLE'				=> 'Enable Forum Countdown',
	'FORUM_COUNTDOWN_ENABLE_EXPLAIN'		=> 'Enable or disable the Forum Countdown here.',
	'FORUM_COUNTDOWN_DATE' 					=> 'Forum Countdown date',
	'FORUM_COUNTDOWN_DATE_EXPLAIN'			=> 'Example: 2019/12/31 24:00:00',
	'FORUM_COUNTDOWN_TEXT' 					=> 'Forum Countdown text',
	'FORUM_COUNTDOWN_TEXT_EXPLAIN'			=> 'Forum Countdown text will be displayed right before the countdown.',
	'FORUM_COUNTDOWN_COMPLETE'	 			=> 'Forum Countdown complete text',
	'FORUM_COUNTDOWN_COMPLETE_EXPLAIN' 		=> 'This text will replace the forum countdown when complete.',
	'FORUM_COUNTDOWN_TESTMODE' 				=> 'Activate testmode',
	'FORUM_COUNTDOWN_TESTMODE_EXPLAIN'		=> 'If testmode is activated only admins can view the forum countdown.',
));
