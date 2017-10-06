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
	'DAE_DEFAULT_AVATAR'					=>	'Default avatar',
	'DAE_DEFAULT_AVATAR_EXPLAIN'			=>	'<strong>Default avatar as user avatar</strong><br>Use the default avatar as user forum avatar. The size of the default avatar used is adapted to be the biggest that fits in the forum maximum avatar dimensions. Note, the stored user avatars will be not overwritten, just overriden and visible only to users while logged in.',
	'DAE_DEFAULT_AVATAR_REPLACE'			=>	'Always',
	'DAE_DEFAULT_AVATAR_REPLACE_EXPLAIN'	=>	'Replace the forum avatar even if this is configured by the user',
	'DAE_DEFAULT_AVATAR_DEFAULT'			=>	'As Default',
	'DAE_DEFAULT_AVATAR_DEFAULT_EXPLAIN'	=>	'Use default avatar only for users that have not specified a forum avatar.',
	'DAE_DEFAULT_AVATAR_NEVER'				=>	'Never',
	'DAE_DEFAULT_AVATAR_NEVER_EXPLAIN'		=>	'Do not use the Default avatar as forum avatar in any case',
	'DAE_DEFAULT_AVATAR_YES_REPLACE'		=>	'Replace always.',
	'DAE_DEFAULT_AVATAR_YES_USE'			=>	'Only use as default avatar.',
	'DAE_DEFAULT_AVATAR_NO_THANKS'			=>	'Do not use it.',
	// Errors
	'ACP_DAE_ERRORS'						=>	'Errors explaination',
	'DAE_AVATAR_IMG_INVALID'				=>	'One or more of the Avatar filenames are wrong or totally missing.<br>Check your relative extension/style <strong>Images</strong> folder.<br><br>Avatar filenames must be:<br><strong>dae_noavatar.png</strong> (32x32) - <strong>dae_noavatar_medium.png</strong> (64x64) - <strong>dae_noavatar_full.png</strong> (128x128).<br><br>The extension is now in a dormant status.<br>Fix the issue and it will automatically wake-up at runtime.'
));
