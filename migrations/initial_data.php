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

class initial_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['threedi_default_avatar_extended']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v3111');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('threedi_default_avatar_extended', 0)),
			array('config.add', array('threedi_default_avatar_exists', 1)), // avatars are correct on first install
			array('config.add', array('threedi_default_avatar_version', '1.1.0-rc1')),

			/* Permissions now */
			array('permission.add', array('u_dae_user')),
			array('permission.permission_set', array('REGISTERED', 'u_dae_user', 'group')),
			array('permission.add', array('a_dae_admin')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_dae_admin', 'group')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_DAE_TITLE'
			)),

			array('module.add', array(
				'acp',
				'ACP_DAE_TITLE',
				array(
					'module_basename'	=> '\threedi\dae\acp\dae_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
