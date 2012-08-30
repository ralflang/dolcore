<?php
/**
 * Copyright 2008-2012 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (BSD). If you did
 * did not receive this file, see http://cvs.horde.org/co.php/jonah/LICENSE.
 *
 * @author Ben Klang <ben@alkaloid.net>
 */

require_once __DIR__ . '/lib/Application.php';
$jonah = Horde_Registry::appInit('dolcore', array(
    'authentication' => 'none',
    'session_control' => 'readonly'
));

$request = $injector->getInstance('Horde_Controller_Request');

$runner = $injector->getInstance('Horde_Controller_Runner');
$config = $injector->getInstance('Horde_Controller_RequestConfiguration');
$response = $runner->execute($injector, $request, $config);
$responseWriter = $injector->getInstance('Horde_Controller_ResponseWriter');
$responseWriter->writeResponse($response);
