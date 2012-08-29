<?php
/**
 * This class provides authentication for Dolcore.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author   Ralf Lang <ralf.lang@ralf-lang.de>
 * @category Horde
 * @license  http://www.horde.org/licenses/gpl GPL
 * @package  dolcore
 */
class Dolcore_Auth extends Horde_Auth_Base
{

    /**
     * The mapper factory
     * @var Horde_Rdo_Factory
     * @access protected
     */
    protected $_mappers;

    protected $_capabilities = array(
        'add'           => false,
        'authenticate'  => true,
        'groups'        => false,
        'list'          => true,
        'resetpassword' => false,
        'remove'        => false,
        'transparent'   => false,
        'update'        => false,
        'badlogincount' => false,
        'lock'          => false,
    );

    /**
     * This is the basic constructor for Dolcore authentication.
     *
     * @param array $params  Hash containing the connection parameters.
     */
    public function __construct($params = array())
    {
        $this->_db = $params['db'];
        $this->_mappers = new Horde_Rdo_Factory($this->_db);
    }

    /**
     * Lists all users in the system.
     *
     * @param  boolean $sort  Toggle sorting alphabetically, default off
     * @return mixed  The array of userIds.
     * @throws Horde_Auth_Exception
     */
    public function listUsers($sort)
    {
        $um = $this->_mappers->create('Dolcore_Rdo_UserMapper');
        $userlist = array();
        foreach ($um->find() as $user) {
            $userlist[$user->id] = $user->nickname;
        }
        // TODO: We can delegate this to Rdo
        return $this->_sort($userlist, $sort); 
    }

    /**
     * Checks if $userId exists in the system.
     *
     * @param string $userId  User ID for which to check
     *
     * @return boolean  Whether or not $userId already exists.
     */
    public function exists($userId)
    {
        try {
            $um = $this->_mappers->create('Dolcore_Rdo_UserMapper');
            return $um->exists(array('nickname' => $userId));
        } catch (Horde_Auth_Exception $e) {
            return false;
        }
    }


    /**
     * Authenticate -- informational only, inherited from Base
     * This deals with extras like horde-level account locking, bad login count etc
     * @param array $credentials  An array of login credentials. If empty,
     *                            attempts to login to the cached session.
     *   - password: (string) The user password.
     *   - userId: (string) The username.
     *
     * @return mixed  If authentication was successful, and no session
     *                exists, an array of data to add to the session.
     *                Otherwise returns false.
     * @throws Horde_Auth_Exception
     */
//      public function authenticate($credentials = array())
//      {
//         return $this->_authenticate($credentials['username'], $credentials);
//      }
    /**
     * Authentication handler
     *
     * On failure, Horde_Auth_Exception should pass a message string (if any)
     * in the message field, and the Horde_Auth::REASON_* constant in the code
     * field (defaults to Horde_Auth::REASON_MESSAGE).
     *
     * @param string $userID      The userID to check.
     * @param array $credentials  An array of login credentials.
     *
     * @throws Horde_Auth_Exception
     */
    protected function _authenticate($userID, $credentials)
    {
        $um = $this->_mappers->create('Dolcore_Rdo_UserMapper');
        if ($this->exists($userID) == false) {
            throw new Horde_Auth_Exception('', Horde_Auth::REASON_BADLOGIN);
        }
        $user = $um->findOne(array('nickname' => $userID));
        $pass = Horde_Auth::getCryptedPassword($credentials['password'], substr($credentials['password'], 0, 2), 'crypt', false);
        if ($pass != $user->passwort) {
            throw new Horde_Auth_Exception('', Horde_Auth::REASON_BADLOGIN);
        }

        return true;
    }


}
