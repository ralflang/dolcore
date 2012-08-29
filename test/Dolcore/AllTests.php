<?php
/**
 * Dolcore test suite.
 *
 * @author     Ralf Lang <ralf.lang@ralf-lang.de>
 * @license    http://www.horde.org/licenses/gpl GPL
 * @category   Horde
 * @package    Dolcore
 * @subpackage UnitTests
 */

/**
 * Define the main method
 */
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Dolcore_AllTests::main');
}

/**
 * Prepare the test setup.
 */
require_once 'Horde/Test/AllTests.php';

/**
 * @package    Dolcore
 * @subpackage UnitTests
 */
class Dolcore_AllTests extends Horde_Test_AllTests
{
}

Dolcore_AllTests::init('Dolcore', __FILE__);

if (PHPUnit_MAIN_METHOD == 'Dolcore_AllTests::main') {
    Dolcore_AllTests::main();
}
