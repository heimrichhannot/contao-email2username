<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Email2Username;


class Hooks extends \Controller
{

	/**
	 * This Hook provides case-insensitive contao-login by email usernames
	 *
	 * RFC 5321, section-2.3.11 says that email addresses should be treated as case-insensitive
	 *
	 * @param $strUser
	 * @param $strPassword
	 * @param $strTable
	 *
	 * @return bool
	 */
	public function importUserHook($strUser, $strPassword, $strTable)
	{
		if(!\Validator::isEmail($strUser))
		{
			return false;
		}
		
		switch($strTable)
		{
			case 'tl_member':
				if(($objUser = \FrontendUser::getInstance()->findBy('LOWER(username)', strtolower($strUser))) !== false)
				{
					// set post user name to the users username
					\Input::setPost('username', $objUser->username);

					return true;
				}
			break;
		}

		return false;
	}


}