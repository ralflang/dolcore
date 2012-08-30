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
class Dolcore_Category
{

    /**
     * The mapper factory
     * @var Horde_Rdo_Factory
     * @access protected
     */
    protected $_mappers;

    /**
     * This is the basic constructor for Dolcore Category Api.
     *
     * @param array $params  Hash containing the connection parameters.
     */
    public function __construct($params = array())
    {
        $this->_db = $params['db'];
        $this->_mappers = new Horde_Rdo_Factory($this->_db);
    }

    /**
     * 
     */
    public function getCategory($id)
    {
        $cm = $this->_mappers->create('Dolcore_Rdo_CategoryMapper');
        return $cm->findOne(array('id' => $id));
    }

    public function listChildCategories($parent_id)
    {

    }

    public function listTopCategories()
    {
        $cm = $this->_mappers->create('Dolcore_Rdo_CategoryMapper');
        $query = new Horde_Rdo_Query($cm);
        $query->addTest('id', 'LIKE', '_');
        return $cm->find($query);
    }

    public function getParentCategory($category_id)
    {
        if (length($category_id) < 2) {
            throw Dolcore_Exception(sprintf(_('Tried to get the parent category of a top category %s'), $category_id));
        }
        $parent_id = substr($category_id,0,-1);
        $parent = $this->getCategory($parent_id);
        if (!$parent) {
            throw Dolcore_Exception(sprintf(_('No parent category for child category %s'), $category_id));
        }
        return $parent;
    }

    public function listAllCategories()
    {
        $cm = $this->_mappers->create('Dolcore_Rdo_CategoryMapper');
        return $cm->find();
    }
}
