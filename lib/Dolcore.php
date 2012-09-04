<?php
/**
 * Dolcore Base Class.
 *
 * Copyright 2012 Dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author  Ralf Lang <ralf.lang@ralf-lang.de>
 * @package Dolcore
 */

class Dolcore {

    /**
     * Builds URL strings for various targets
     * @param string $controller  The internal name of the controller or page
     * @param array $details      The parameters to attach either as path or as get parameters
     * @param boolean $full       Generate a full url or relative to dolcore, defaults to false
     * @param boolean $legacy     Generate an url for the legacy target page or for a dolcore controller. Ignored if one is missing
     * @returns string  The generated URL
     */
    public function getUrlFor($controller, array $details = null, $full = false, $legacy = false)
    {
        switch ($controller) {
            case 'discussion':
                if ($legacy) {
                    $parameters = array('position' => 700,
                                        'frage_id' => $details['discussion_id']
                                    );
                    $url = new Horde_Url($GLOBALS['conf']['path']['dol2day_front'], true);
                    return $url->add($parameters)->toString();
                }
            break;
        }

    }
}