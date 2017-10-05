<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae\event;

use \threedi\dae\ext;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Default Avatar Extended Event listener.
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/* @var \threedi\dae\core\dae */
	protected $dae;

	/**
		* Constructor
		*
		* @param \phpbb\auth\auth			$auth			Authentication object
		* @param \phpbb\config\config		$config			Config Object
		* @param \phpbb\user				$user			User object
		* @param threedi\dae\core\dae		$dae			Methods to be used by Class
		* @access public
	*/

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\user $user, \threedi\dae\core\dae	$dae)
	{
		$this->auth		=	$auth;
		$this->config	=	$config;
		$this->user		=	$user;
		$this->dae		=	$dae;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=>	'dae_load_language_on_setup',
			'core.permissions'		=>	'dae_permissions',
			'core.get_avatar_after'	=>	'dae_default_avatar',
		);
	}

	/**
	 * Main language file inclusion
	 *
	 * @event core.user_setup
	 */
	public function dae_load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'threedi/dae',
			'lang_set' => 'dae_global',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Permission's language file is automatically loaded
	 *
	 * @event core.permissions
	 */
	public function dae_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions += array(
			'a_dae_admin' => array(
				'lang'	=> 'ACL_A_DAE_ADMIN',
				'cat'	=> 'misc',
			),
			'u_dae_user' => array(
				'lang'	=> 'ACL_U_DAE_USER',
				'cat'	=> 'misc',
			),
		);
		$event['permissions'] = $permissions;
	}

	/**
	* Use the default avatar in place of forum avatar according to selected conditions
	*
	* @event core.get_avatar_after
	*/
	public function dae_default_avatar($event)
	{
		/**
		 * If Img avatar filename(s) are wrong
		 * state configs as false and  go on to the next check
		 */
		$this->dae->check_point_avatar_img();

		/**
		 * If the ACP config is NEVER OR Img avatar filename('s) are wrong do nothing and return
		 */
		if (!$this->config['threedi_default_avatar_exists'] || !$this->config['threedi_default_avatar_extended'])
		{
			return;
		}

		/**
		 * We are in the UCP/ACP, so we should not change the selected avatar
		 */
		if ($event['ignore_config'])
		{
			return;
		}

		/**
		 * Check for DAE permissions prior to run the code.
		 */
		if ($this->config['threedi_default_avatar_extended'] && ($this->auth->acl_get('a_dae_admin') || $this->auth->acl_get('u_dae_user')))
		{
			/**
			 * All of the magic lies here
			 */
			$event_row = $event['row'];
			/**
			 * Check for avatar and ACP settings first:
			 * if no avatar and configuration has been set to avatar as default
			 * or to replace always the avatars
			 */
			if (empty($event_row['avatar']) || (int) $this->config['threedi_default_avatar_extended'] == 2)
			{
				/**
				 * Uses the maximum avatar size possible within the specified configuration
				 * It uses the next biggest default avatar between those three available (all square)
				 */
				$width = $height = min((int) $this->config['avatar_max_width'], (int) $this->config['avatar_max_height'], ext::DAE_L);
				$avatar_sfx = ($width > ext::DAE_M) ? '_full' : (($width > ext::DAE_S) ? '_medium' : '');

				/**
				 * Amend filename to be used now, based on our above conditions
				 */
				$src = 'src="' . ((string) substr_replace($this->dae->style_avatar(), $avatar_sfx, strrpos($this->dae->style_avatar(), '.'), 0)) . '"';

				/**
				 * Avatar size soft-reduced to fit in the specified avatar forum sizes
				 */
				$width = 'width="'. ((int) $width) .'"';
				$height = 'height="'. ((int) $height) .'"';
				$alt = 'alt="'. $this->user->lang('DEFAULT_AVATAR') . '"';

				/**
				 * Let's concatenate and replace - That's all.
				 */
				$event['html'] = '<img class="avatar" ' . "{$src} {$width} {$height} {$alt}" . ' />';
			}
		}
	}
}
