<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

/**
 * Fields
 */
$arrDca['config']['onsubmit_callback']['setUsernameFromEmail'] = array('tl_member_mail2username', 'setUsernameFromEmail');

class tl_member_mail2username extends \Backend
{

	public function setUsernameFromEmail(&$objDc)
	{
		$objMember = \MemberModel::findByPk($objDc->activeRecord->id);
		$objMember->refresh();

		$objDc->activeRecord->username = $objDc->activeRecord->email;
		$objMember->username = $objDc->activeRecord->email;

		$objMember->save();
	}

}