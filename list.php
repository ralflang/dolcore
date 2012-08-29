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
Horde_Registry::appInit('dolcore');

$page_output->header(array(
    'title' => _("List")
));

echo Horde::menu();
$notification->notify(array('listeners' => 'status'));

$page_output->footer();
