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
	'DEFAULT_AVATAR'				=>	'DAE avatar',
	// Translators please do not change the following line, no need to translate it!
	'DAE_CREDIT_LINE'	=>	' | <a href="https://github.com/3D-I/Default-Avatar-Extended">Default Avatar Extended</a> &copy; 2017 - 3Di',
));
