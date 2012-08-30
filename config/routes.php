<?php
/**
 * Setup default routes
 */
$mapper->connect('/feed/category/:category',
    array(
        'controller' => 'Feed',
        'action' => 'category'
    ));

