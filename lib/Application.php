<?php
/**
 * Dolcore application API.
 *
 * This file defines Horde's core API interface. Other core Horde libraries
 * can interact with Dolcore through this API.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @package Dolcore
 */

/* Determine the base directories. */
if (!defined('DOLCORE_BASE')) {
    define('DOLCORE_BASE', __DIR__ . '/..');
}

if (!defined('HORDE_BASE')) {
    /* If Horde does not live directly under the app directory, the HORDE_BASE
     * constant should be defined in config/horde.local.php. */
    if (file_exists(DOLCORE_BASE . '/config/horde.local.php')) {
        include DOLCORE_BASE . '/config/horde.local.php';
    } else {
        define('HORDE_BASE', DOLCORE_BASE . '/..');
    }
}

/* Load the Horde Framework core (needed to autoload
 * Horde_Registry_Application::). */
require_once HORDE_BASE . '/lib/core.php';

class Dolcore_Application extends Horde_Registry_Application
{
    /**
     */
    public $version = 'H5 (0.1-git)';

    /**
     * @var array $auth
     * List of authentication capabilities exposed
     */
    public $auth = array(
        'authenticate',
        'list'
    );


    protected function _init()
    {
        try {
             $this->driver = $GLOBALS['injector']->getInstance('Dolcore_Factory_Driver')->create($GLOBALS['injector']);
             $this->auth = $GLOBALS['injector']->getInstance('Dolcore_Factory_Auth')->create($GLOBALS['injector']);
             $this->category = $GLOBALS['injector']->getInstance('Dolcore_Factory_Category')->create($GLOBALS['injector']);
        } catch (Dolcore_Exception $e) {
            $GLOBALS['notification']->notify($e->getMessage());
        }
    }

    /**
     * Application Authentication proxy: userExists
     */
    public function authUserExists($userId)
    {
        return $this->auth->exists($userId);
    }

    /**
     * @param array $credentials  Array of criedentials (password requied)
     */
    public function authAuthenticate($userID, $credentials)
    {
        $this->auth->authenticate($userID, $credentials);
        if ($this->auth->getError()) {
            throw new Horde_Auth_Exception($this->auth->getError(true), $this->auth->getError());
        }
    }


    /**
     */
    public function menu($menu)
    {
        $menu->add(Horde::url('list.php'), _("List"), 'user.png');
    }
}
