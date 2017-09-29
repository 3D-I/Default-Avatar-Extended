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
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\user */
	protected $user;

	/**
		* Constructor
		*
		* @param \phpbb\config\config		$config			Config Object
		* @param \phpbb\path_helper			$path_helper	Path helper object
		* @param \phpbb\user				$user			User object
		* @access public
	*/

	public function __construct(\phpbb\config\config $config, \phpbb\path_helper $path_helper, \phpbb\user $user)
	{
		$this->config			=	$config;
		$this->path_helper		=	$path_helper;
		$this->user				=	$user;
	}

	/**
	 * Returns the absolute URL to the image file
	 *
	 * @return void
	 */
	public function style_avatar()
	{
		return ($this->path_helper->get_web_root_path() . 'ext/threedi/dae/styles/'
 . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar.png');
	}

	/**
	 * Returns whether the basic avatar img exists
	 *
	 * @return	bool
	 */
	public function style_avatar_is_true()
	{
		return (file_exists($this->path_helper->get_web_root_path() . 'ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar.png') && file_exists($this->path_helper->get_web_root_path() . 'ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar_medium.png') && file_exists($this->path_helper->get_web_root_path() . 'ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar_full.png')) ? true : false;
	}

	/**
	 * Avatar IMG check-point
	 *
	 * @return void
	 */
	public function check_point_avatar_img()
	{
		if ($this->style_avatar_is_true())
		{
			$this->config->set('threedi_default_avatar_exists', 1);
		}
		else
		{
			$this->config->set('threedi_default_avatar_exists', 0);
		}
	}
}
