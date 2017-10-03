<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_DAE_TITLE'				=> 'Default Avatar Extended',
	'ACP_DAE_SETTINGS'			=> 'Settings',
	'ACP_DAE_SETTING_SAVED'		=> 'Default Avatar Extended Settings saved.',
	// error logs
	'DAE_AVATAR_IMG_INVALID'	=> '<strong>The avatar filename(s) are/is wrong or totally missing.</strong>',
));
