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
		global $config, $request, $template, $user, $phpbb_container;

		$dae = $phpbb_container->get('threedi.dae.dae');

		$user->add_lang_ext('threedi/dae', 'acp_dae');
		$this->tpl_name = 'dae_body';
		$this->page_title = $user->lang('ACP_DAE_TITLE');
		add_form_key('threedi/dae');

		/**
		 * If Img avatar filename mistmach error..
		 * state is false and return, else go on..
		 */
		$dae->check_point_avatar_img();

		/* Do this now and forget */
		$errors = array();

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('threedi/dae'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			/* You changed filenames. no party! */
			if (!$config['threedi_default_avatar_exists'])
			{
				$errors[] = $user->lang('DAE_AVATAR_IMG_INVALID');
			}

			/* No errors? Great, let's go. */
			if ( !count($errors) )
			{
				$config->set('threedi_default_avatar_extended', $request->variable('threedi_default_avatar_extended', (int) $config['threedi_default_avatar_extended']));

				trigger_error($user->lang('ACP_DAE_SETTING_SAVED') . adm_back_link($this->u_action));
			}
		}

		$template->assign_vars(array(
			'S_ERRORS'				=> ($errors) ? true : false,
			'ERRORS_MSG'			=> ($errors) ? implode('<br /><br />', $errors) : '',
			'U_ACTION'				=> $this->u_action,
			'DAE_DEFAULT_AVATAR'	=> (int) $config['threedi_default_avatar_extended'], // 0 = never, 1 = default, 2 = always
		));
	}
}
