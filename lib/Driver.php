<?php
/**
 * Dolcore_Driver defines an API for implementing storage backends for
 * Dolcore.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author  Ralf Lang <ralf.lang@ralf-lang.de>
 * @package Dolcore
 */
class Dolcore_Driver
{
    /**
     * Hash containing connection parameters.
     *
     * @var array
     */
    protected $_params = array();

    /**
     * Array holding the current foo list. Each array entry is a hash
     * describing a foo. The array is indexed by the IDs.
     *
     * @var array
     */
    protected $_foos = array();

    /**
     * Constructor.
     *
     * @param array $params  A hash containing connection parameters.
     */
    public function __construct($params = array())
    {
        $this->_params = $params;
    }

    /**
     * Lists all foos.
     *
     * @return array  Returns a list of all foos.
     */
    public function listFoos()
    {
        return $this->_foos;
    }
}
