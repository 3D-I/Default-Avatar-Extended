<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae\core;

class dae
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\log */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\extension\manager "Extension Manager" */
	protected $ext_manager;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/**
		* Constructor
		*
		* @param \phpbb\auth\auth			$auth			Authentication object
		* @param \phpbb\config\config		$config			Config Object
		* @param \phpbb\log\log				$log			phpBB log
		* @param \phpbb\user				$user			User object
		* @param \phpbb\extension\manager	$ext_manager	Extension manager object
		* @param \phpbb\path_helper			$path_helper	Path helper object
		* @access public
	*/

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\log\log $log, \phpbb\user $user, \phpbb\extension\manager $ext_manager, \phpbb\path_helper $path_helper)
	{
		$this->auth				=	$auth;
		$this->config			=	$config;
		$this->log				=	$log;
		$this->user				=	$user;
		$this->ext_manager		=	$ext_manager;
		$this->path_helper		=	$path_helper;

		$this->ext_path			=	$this->ext_manager->get_extension_path('threedi/dae', true);
		$this->ext_path_web		=	$this->path_helper->update_web_root_path($this->ext_path);
	}

	/**
	 * Returns the absolute URL to the image file
	 *
	 * @return void
	 */
	public function style_avatar()
	{
		return ($this->ext_path_web . 'styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar.png');
	}

	/**
	 * Returns whether the basic avatar img exists
	 *
	 * @return	bool
	 */
	public function style_avatar_is_true()
	{
		return file_exists(self::style_avatar());
	}

	/**
	 * Update config to false
	 *
	 * @return void
	 */
	public function update_img_config_to_false()
	{
		$this->config->set('threedi_default_avatar_exists', 0);
	}

	/**
	 * Update config to true
	 *
	 * @return void
	 */
	public function update_img_config_to_true()
	{
		$this->config->set('threedi_default_avatar_exists', 1);
	}

	/**
	 * Avatar IMG check-point
	 *
	 * @return void
	 */
	public function check_point_avatar_img()
	{
		/* If Img avatar filename mistmach error, state is false and return */
		if (!self::style_avatar_is_true())
		{
			self::update_img_config_to_false();
			return;
		}
		else
		{
			/* Check passed, let's set it back to true. */
			self::update_img_config_to_true();
		}
	}
}
