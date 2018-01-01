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
 * Default Avatar Extended ACP module.
 */
class dae_module
{
	public $page_title;
	public $tpl_name;
	public $u_action;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user, $phpbb_log, $db, $phpbb_root_path;

		$dae_rootpath = (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? generate_board_url() . '/' : $phpbb_root_path;

		$user->add_lang_ext('threedi/dae', 'acp_dae');
		$this->tpl_name = 'dae_body';
		$this->page_title = $user->lang('ACP_DAE_TITLE');

		add_form_key('threedi/dae');

		/* Do this now and forget */
		$errors = array();

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('threedi/dae'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			/* Check for all installed styles first */
			$sql = 'SELECT style_path
				FROM ' . STYLES_TABLE;
			$result = $db->sql_query($sql);

			while ($rows = $db->sql_fetchrow($result))
			{
				$styles_installed[] = $rows['style_path'];
			}
			$db->sql_freeresult($result);

			/**
			 * Now check for the correct existance of all of the DAE's images into
			 * each of the effectively installed styles and report a detailed list on failure.
			 */
			foreach ($styles_installed as $style_installed)
			{
				$ext_path_img = $dae_rootpath . 'ext/threedi/dae/styles/' . $style_installed . '/theme/images/dae_noavatar';

				if ( ! (file_exists($ext_path_img . '.png') && file_exists($ext_path_img . '_medium.png') && file_exists($ext_path_img . '_full.png')) )
				{
					$errors[] = $user->lang('DAE_AVATAR_IMG_INVALID', $style_installed);

					$phpbb_log->add('critical', $user->data['user_id'], $user->ip, 'DAE_AVATAR_IMG_INVALID');
				}
			}

			/* No errors? Great, let's go. */
			if (!count($errors))
			{
				$config->set('threedi_default_avatar_extended', $request->variable('threedi_default_avatar_extended', (int) $config['threedi_default_avatar_extended']));

				trigger_error($user->lang('ACP_DAE_SETTING_SAVED') . adm_back_link($this->u_action));
			}
		}

		$template->assign_vars(array(
			'S_ERRORS'				=> ($errors) ? true : false,
			'ERRORS_MSG'			=> implode('<br /><br />', $errors),
			'U_ACTION'				=> $this->u_action,
			'DAE_DEFAULT_AVATAR'	=> (int) $config['threedi_default_avatar_extended'], // 0 = never, 1 = default, 2 = always
		));
	}
}
