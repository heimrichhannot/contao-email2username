<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

/**
 * Callbacks
 */
$arrDca['config']['onsubmit_callback']['setUsernameFromEmail'] = ['tl_member_email2username', 'setUsernameFromEmail'];

/**
 * Fields
 */
$arrDca['fields']['username']['eval']['disabled']  = true;
$arrDca['fields']['username']['eval']['mandatory'] = false;

class tl_member_email2username extends \Backend
{
    public function setUsernameFromEmail(\DataContainer $objDc)
    {
        if (($objMember = \MemberModel::findByPk($objDc->id)) === null || !$objMember->email)
            return;

        $objMember->refresh();

        $objMember->username           = $objMember->email;
        $objDc->activeRecord->username = $objMember->email;

        $objMember->save();
    }
}