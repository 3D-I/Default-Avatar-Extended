<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di, javiexin
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae\avatar\driver;

/**
* Allows gravatars to be overridden
*/
class gravatar extends \phpbb\avatar\driver\gravatar
{
	/**
	* {@inheritdoc}
	*/
	public function get_config_name()
	{
		return preg_replace('#^phpbb\\\\avatar\\\\driver\\\\#', '', get_parent_class($this));
	}

	/**
	* {@inheritdoc}
	*/
	public function get_data($row)
	{
		return array(
			'src' => $this->get_gravatar_url($row),
			'width' => $row['avatar_width'],
			'height' => $row['avatar_height'],
		);
	}

	/**
	* {@inheritdoc}
	*/
	public function get_custom_html($user, $row, $alt = '')
	{
		return '';
	}
}
