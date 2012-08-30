<?php
/**
 * This class provides discussion handling for Dolcore, integrating polls.
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
class Dolcore_Discussion
{

    /**
     * The mapper factory
     * @var Horde_Rdo_Factory
     * @access protected
     */
    protected $_mappers;

    /**
     * This is the basic constructor for Dolcore Discussion Api.
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
    public function getDiscussion($id)
    {
        $dm = $this->_mappers->create('Dolcore_Rdo_DiscussionMapper');
        return $dm->findOne(array('id' => $id));
    }

    /**
     * List discussions, filtered by various criteria
     * @params array $filters  The array of filters allowed keys
     *                      'state' => array('Y', 'D', 'R')
     *
     *                           Allowed states
     *                                   Y  => OK,
     *                                   D  => Declined
     *                                   R  => awaiting approval
     *                                   defaults to 'R' - passing an empty array means 'all'
     *                       'category' => The category id to filter for
     *                       'user'     => A user's numeric id to filter for
     */
    public function listDiscussions(array $filters = array())
    {
        $filters = array_merge(
                            array(
                                'state' => array('Y'),
                                'limit' => array(),
                                ),
                            $filters
                            );

        $dm = $this->_mappers->create('Dolcore_Rdo_DiscussionMapper');
        $query = new Horde_Rdo_Query($dm);
        if ($filters['category']) {
            $query->addTest('kategorie_id', '=', $filters['category']);
        }
        if ($filters['user']) {
            $query->addTest('benutzer_id', '=', $filters['user']);
        }
        if (count($filters['state'])) {
            $query->addTest('checked', 'IN', $filters['state']);
        }
        $query->sortBy('erstelldatum DESC');

        return $dm->find($query);
    }

}
