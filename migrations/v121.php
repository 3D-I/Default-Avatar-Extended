<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae\migrations;

class v121 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return phpbb_version_compare($this->config['threedi_default_avatar_version'], '1.2.1', '>=');
	}

	static public function depends_on()
	{
		return array(
			'\threedi\dae\migrations\initial_data',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('threedi_default_avatar_version', '1.2.1')),
			array('config.remove', array('threedi_default_avatar_exists')),
		);
	}
}
