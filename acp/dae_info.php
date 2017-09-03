<?php
/**
 *
 * Default Avatar Extended. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017, 3Di
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace threedi\dae\acp;

/**
 * Default Avatar Extended ACP module info.
 */
class dae_info
{
	public function module()
	{
		return array(
			'filename'	=> '\threedi\dae\acp\dae_module',
			'title'		=> 'ACP_DAE_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_DAE_SETTINGS',
					'auth'	=> 'ext_threedi/dae && acl_a_dae_admin',
					'cat'	=> array('ACP_DAE_TITLE')
				),
			),
		);
	}
}
