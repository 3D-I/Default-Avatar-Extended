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

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $ext_root_path;

	/**
		* Constructor
		*
		* @param \phpbb\config\config		$config			Config Object
		* @param \phpbb\user				$user			User object
		* @param string						$ext_root_path	Path to DAE extension root
		* @access public
	*/

	public function __construct(\phpbb\config\config $config, \phpbb\user $user, $ext_root_path)
	{
		$this->config			=	$config;
		$this->user				=	$user;
		$this->ext_root_path	=	$ext_root_path;
	}

	/**
	 * Returns the absolute URL to the image file
	 *
	 * @return void
	 */
	public function style_avatar()
	{
		return (generate_board_url() . '/ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar.png');
	}

	/**
	 * Returns whether the basic avatar img exists
	 *
	 * @return	bool
	 */
	public function style_avatar_is_true()
	{
		$ext_path = $this->ext_root_path . 'styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar';

		return (file_exists($ext_path . '.png') && file_exists($ext_path . '_medium.png') && file_exists($ext_path . '_full.png')) ? true : false;
	}

	/**
	 * Avatar IMG check-point
	 *
	 * @return void
	 */
	public function check_point_avatar_img()
	{
		if (!$this->style_avatar_is_true())
		{
			$this->config->set('threedi_default_avatar_exists', 0);
		}
		else
		{
			$this->config->set('threedi_default_avatar_exists', 1);
		}
	}
}
