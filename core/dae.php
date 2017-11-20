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

	/* @var string phpBB root path */
	protected $root_path;

	/**
	 * Constructor
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\user $user, $root_path)
	{
		$this->config		=	$config;
		$this->user			=	$user;
		$this->root_path	=	$root_path;
	}

	/**
	 * Returns the absolute URL to the image file for each user style
	 *
	 * @return string	URL
	 */
	public function style_avatar()
	{
		return (generate_board_url() . '/ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar.png');
	}

	/**
	 * Returns the absolute URL to the image file in the prosilver style
	 *
	 * @return string	URL
	 */
	public function style_avatar_prosilver()
	{
		return (generate_board_url() . '/ext/threedi/dae/styles/prosilver/theme/images/dae_noavatar.png');
	}

	/**
	 * Returns whether the avatar imgs exist
	 *
	 * @return	bool
	 */
	public function style_avatar_is_true()
	{
		$dae_rootpath = (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : $this->root_path;

		$dae_img_path = $dae_rootpath . 'ext/threedi/dae/styles/' . rawurlencode($this->user->style['style_path']) . '/theme/images/dae_noavatar';

		return (file_exists($dae_img_path . '.png') && file_exists($dae_img_path . '_medium.png') && file_exists($dae_img_path . '_full.png')) ? true : false;
	}

	/**
	 * Avatar IMG check-point
	 *
	 * @return string	Formatted URL, language string otherwise.
	 */
	public function check_point_avatar_img()
	{
		if ( ($this->user->style['style_path'] !== 'prosilver') && $this->style_avatar_is_true() )
		{
			return $this->style_avatar();
		}
		else
		{
			return $this->style_avatar_prosilver();
		}
	}
}
