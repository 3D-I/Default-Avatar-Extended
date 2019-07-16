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

class initial_user_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		/**
		 * If does NOT exists go ahead
		 */
		return $this->db_tools->sql_column_exists($this->table_prefix . 'users', 'user_dae_choice');
	}

	static public function depends_on()
	{
		return array('\threedi\dae\migrations\initial_data');
	}

	public function update_schema()
	{
		/* User choice is ON as default */
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'user_dae_choice'	=> array('TINT:1', '1'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'user_dae_choice',
				),
			),
		);
	}
}
