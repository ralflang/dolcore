<?php
/**
 * The Dolcore_Rdo_CategoryMapper class contains all functions related to handling
 * category object mapping in Dolcore.
 *
 * Copyright 2012-2012 dol2day GbR
 *
 * @author   Ralf Lang <lang@b1-systems.de>
 * @category Horde
 * @package  Dolcore
 */

/**
 * The Dolcore_Rdo_CategoryMapper class contains all functions related to handling
 * category object mapping in Dolcore.
 *
 * Copyright 2012-2012 dol2day GbR
 *
 * @author   Ralf Lang <lang@b1-systems.de>
 * @category Horde
 * @package  Dolcore
 */

class Dolcore_Rdo_CategoryMapper extends Horde_Rdo_Mapper
{
    /**
     * Inflector doesn't support Horde-style tables yet
     * @var string
     * @access protected
     */
    protected $_table = 'kategorien';

    /**
     * Relationships loaded on-demand
     * @var array
     * @access protected
     */
    protected $_lazyRelationships = array();

}

