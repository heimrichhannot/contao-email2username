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
    public function setUsernameFromEmail(&$objDc)
    {
        if (!$objDc->activeRecord->email)
        {
            return;
        }

        $objUser = \UserModel::findByPk($objDc->id);
        $objUser->refresh();

        $objUser->username             = $objDc->activeRecord->email;
        $objDc->activeRecord->username = $objDc->activeRecord->email;

        $objUser->save();
    }
}