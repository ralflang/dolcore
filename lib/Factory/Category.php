<?php
/**
 * Dolcore_Category factory.
 *
 * Create the business module for Dol2day authentication related stuff
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author   Ralf Lang <ralf.lang@ralf-lang.de>
 * @category Horde
 * @license  http://www.horde.org/licenses/gpl GPL
 * @package  Dolcore
 */
class Dolcore_Factory_Category extends Horde_Core_Factory_Injector
{
    /**
     * @var array
     */
    private $_instances = array();

    /**
     * Return an Dolcore_Category instance.
     *
     * @return Dolcore_Category
     */
    public function create(Horde_Injector $injector)
    {
        $driver = Horde_String::ucfirst($GLOBALS['conf']['storage']['driver']);
        $signature = serialize(array($driver, $GLOBALS['conf']['storage']['params']['driverconfig']));
        if (empty($this->_instances[$signature])) {
            switch ($driver) {
            case 'Sql':
                try {
                    if ($GLOBALS['conf']['storage']['params']['driverconfig'] == 'horde') {
                        $db = $injector->getInstance('Horde_Db_Adapter');
                    } else {
                        $db = $injector->getInstance('Horde_Core_Factory_Db')
                            ->create('dolcore', 'storage');
                    }
                } catch (Horde_Exception $e) {
                    throw new Dolcore_Exception($e);
                }
                $params = array('db' => $db);
                break;
            }
            $class = 'Dolcore_Category';
            $this->_instances[$signature] = new $class($params);
        }

        return $this->_instances[$signature];
    }
}
