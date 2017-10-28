<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae;

/**
 * Default Avatar Extended Extension base
 */
class ext extends \phpbb\extension\base
{
	/* Define constants */
	const DAE_S = '32';
	const DAE_M = '64';
	const DAE_L = '128';

	/**
	 * Check whether the extension can be enabled.
	 * Provides meaningful(s) error message(s) and the back-link on failure.
	 * CLI and 3.1/3.2 compatible
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$is_enableable = true;

		$user = $this->container->get('user');
		$user->add_lang_ext('threedi/dae', 'ext_require');
		$lang = $user->lang;

		if (!( (phpbb_version_compare(PHPBB_VERSION, '3.2.1', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.3.0@dev', '<')) || (phpbb_version_compare(PHPBB_VERSION, '3.1.11', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.2.0@dev', '<')) ) )
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_MSG_3111_321_MISTMATCH');
			$is_enableable = false;
		}

		$user->lang = $lang;

		return $is_enableable;
	}
}
