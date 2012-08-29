<?php
/**
 * Example list script.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author Ralf Lang <ralf.lang@ralf-lang.de>
 */

require_once __DIR__ . '/lib/Application.php';
$core = Horde_Registry::appInit('dolcore', array('authentication' => 'none'));

$page_output->header(array(
    'title' => _("List")
));

echo Horde::menu();
$notification->notify(array('listeners' => 'status'));

//print_r($core->auth->listUsers());
print_r($core->auth->exists('Ralf'));
print_r($core->authUserExists('Ralf'));
print $registry->getAuth();
$page_output->footer();
