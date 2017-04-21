<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_user'];

/**
 * Callbacks
 */
$arrDca['config']['onsubmit_callback']['setUsernameFromEmail'] = ['tl_user_email2username', 'setUsernameFromEmail'];

/**
 * Fields
 */
$arrDca['fields']['username']['eval']['disabled']  = true;
$arrDca['fields']['username']['eval']['mandatory'] = false;

class tl_user_email2username extends \Backend
{
    public function setUsernameFromEmail(\DataContainer $objDc)
    {
        if (($objMember = \UserModel::findByPk($objDc->id)) === null || !$objMember->email)
            return;

        $objMember->refresh();

        $objMember->username           = $objMember->email;
        $objDc->activeRecord->username = $objMember->email;

        $objMember->save();
    }
}