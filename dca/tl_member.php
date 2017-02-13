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
    public function setUsernameFromEmail(&$objDc)
    {
        if (!$objDc->activeRecord->email)
        {
            return;
        }

        $objMember = \MemberModel::findByPk($objDc->id);
        $objMember->refresh();

        $objMember->username           = $objDc->activeRecord->email;
        $objDc->activeRecord->username = $objDc->activeRecord->email;

        $objMember->save();
    }
}