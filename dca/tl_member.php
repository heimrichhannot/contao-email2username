<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

/**
 * Callbacks
 */
$arrDca['config']['onsubmit_callback']['setUsernameFromEmail'] = array('tl_member_email2username', 'setUsernameFromEmail');

/**
 * Fields
 */
$arrDca['fields']['username']['eval']['disabled'] = true;
$arrDca['fields']['username']['eval']['mandatory'] = false;

class tl_member_email2username extends \Backend
{

	public function setUsernameFromEmail(&$objDc)
	{
		if ($objDc instanceof \Contao\FrontendUser)
		{
			$objDc->username = $objDc->email;
			$objDc->save();
		} elseif ($objDc->activeRecord)
		{
			$objMember = \MemberModel::findByPk($objDc->activeRecord->id);
			$objMember->refresh();
			$objMember->username = $objDc->activeRecord->email;

			if(TL_MODE == 'BE')
			{
				$objDc->activeRecord->username = $objDc->activeRecord->email;
			}

			$objMember->save();
		}
	}

}
