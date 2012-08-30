<?php
/**
 * Dolcore storage implementation for the Horde_Db database abstraction layer.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author   Ralf Lang <ralf.lang@ralf-lang.de>
 * @category Horde
 * @package  Dolcore
 */
class Dolcore_Driver_Sql extends Dolcore_Driver
{
    /**
     * Handle for the current database connection.
     *
     * @var Horde_Db_Adapter
     */
    protected $_db;

    /**
     * The mapper factory
     * @var Horde_Rdo_Factory
     * @access protected
     */
    protected $_mappers;


    protected $_categoriesApi;
    protected $_discussionApi;

    /**
     * Constructs a new SQL storage object.
     *
     * @param array $params  Class parameters:
     *                       - db:    (Horde_Db_Adapater) A database handle.
     *                       - table: (string, optional) The name of the
     *                                database table.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $params = array())
    {
        if (!isset($params['db'])) {
            throw new InvalidArgumentException('Missing db parameter.');
        }
        $this->_db = $params['db'];
        unset($params['db']);

        parent::__construct($params);
    }




    /**
     * Retrieves the categories Api.
     *
     * @throws Dolcore_Exception
     */
    public function getCategoriesApi()
    {
        if (!$this->_categoriesApi) {
            $this->_categoriesApi = new Dolcore_Category(array('db' => $this->_db));
        }
        return $this->_categoriesApi;
    }

    /**
     * Retrieves the discussion Api.
     *
     * @throws Dolcore_Exception
     */
    public function getDiscussionApi()
    {
        if (!$this->_discussionApi) {
            $this->_discussionApi = new Dolcore_Discussion(array('db' => $this->_db));
        }
        return $this->_discussionApi;
    }

}
