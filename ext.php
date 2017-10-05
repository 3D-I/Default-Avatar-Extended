<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di, javiexin
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

		if ( !(phpbb_version_compare(PHPBB_VERSION, '3.2.1', '>=') || (phpbb_version_compare(PHPBB_VERSION, '3.1.11', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.2.0@dev', '<'))) )
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_MSG_3111_321_MISTMATCH');
			$is_enableable = false;
		}

		$user->lang = $lang;

		return $is_enableable;
	}

	/**
	 * Assign the right configuration depending on the phpbb version (3.1.x or 3.2.x)
	 *
	 * @param mixed		$old_state		State returned by previous call of this method
	 * @return mixed	Returns false after last step, otherwise temporary state
	 */
	function enable_step($old_state)
	{
		switch ($old_state)
		{
			/* Empty means nothing has run yet */
			case '':

				/* Set the right configuration */
				$this->set_global_configuration(phpbb_version_compare(PHPBB_VERSION, '3.2.1', '>='));
				return 'versionconfig';

			break;

			default:

				/* Run parent enable step method */
				return parent::enable_step($old_state);

			break;
		}
	}

	/**
	 * Clear the version specific configuration
	 *
	 * @param mixed		$old_state	State returned by previous call of this method
	 * @return mixed	Returns false after last step, otherwise temporary state
	 */
	function disable_step($old_state)
	{
		switch ($old_state)
		{
			/* Empty means nothing has run yet */
			case '':

				/* Clear the version dependant configuration */
				$this->clear_global_configuration();
				return 'versionconfig';

			break;

			default:

				/* Run parent disable step method */
				return parent::disable_step($old_state);

			break;
		}
	}

	/**
	 * Services/files that need adaptations between phpbb versions
	 */
	static protected $services = array(
			'gravatar'	=>	['config/gravatar.yml', 'config/gravatar31.yml', 'config/gravatar32.yml'],
		);

	/**
	 * Sets the right configuration for the phpbb version
	 *
	 * @param bool	$is_rhea	Indicates if the version is above 3.2.1 or not
	 * @return void
	 */
	protected function set_global_configuration($is_rhea)
	{
		$is_rhea = $is_rhea ? 2 : 1;
		$dir = __DIR__ . '/';

		foreach (self::$services as $service => $files)
		{
			if (file_exists($dir . $files[$is_rhea]))
			{
				copy($dir . $files[$is_rhea], $dir . $files[0]);
			}
		}
	}

	/**
	 * Clears the phpbb version specific configuration
	 *
	 * @return void
	 */
	protected function clear_global_configuration()
	{
		$dir = __DIR__ . '/';

		foreach (self::$services as $service => $files)
		{
			if (file_exists($dir . $files[0]))
			{
				unlink($dir . $files[0]);
				touch($dir . $files[0]);
			}
		}
	}
}
