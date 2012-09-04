<?php
/**
 * The Dispatcher
 */

require_once __DIR__ . '/lib/Application.php';
$dolcore = Horde_Registry::appInit('dolcore', array(
    'authentication' => 'none',
    'session_control' => 'readonly'
));

$request = $injector->getInstance('Horde_Controller_Request');

$runner = $injector->getInstance('Horde_Controller_Runner');
$config = $injector->getInstance('Horde_Controller_RequestConfiguration');
$response = $runner->execute($injector, $request, $config);
$responseWriter = $injector->getInstance('Horde_Controller_ResponseWriter');
$responseWriter->writeResponse($response);
