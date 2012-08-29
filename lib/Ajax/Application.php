<?php
/**
 * Dolcore AJAX application API.
 *
 * This file defines the AJAX actions provided by this module. The primary
 * AJAX endpoint is represented by horde/services/ajax.php but that handler
 * will call the module specific actions via the class defined here.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @package Dolcore
 */
class Dolcore_Ajax_Application extends Horde_Core_Ajax_Application
{
    /**
     * Application specific initialization tasks should be done in here.
     */
    protected function _init()
    {
    }

}
