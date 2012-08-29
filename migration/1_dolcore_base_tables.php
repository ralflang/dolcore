<?php
/**
 * Create Dolcore base tables.
 *
 * Copyright 2012 dol2day GbR
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author  Ralf Lang <ralf.lang@ralf-lang.de>
 * @category Horde
 * @package  Dolcore
 */
class DolcoreBaseTables extends Horde_Db_Migration_Base
{
    /**
     * Upgrade
     */
    public function up()
    {
        $t = $this->createTable('dolcore_items', array('autoincrementKey' => 'item_id'));
        $t->column('item_owner', 'string', array('limit' => 255, 'null' => false));
        $t->column('item_data', 'string', array('limit' => 64, 'null' => false));
        $t->end();

        $this->addIndex('dolcore_items', array('item_owner'));
    }

    /**
     * Downgrade
     */
    public function down()
    {
        $this->dropTable('dolcore_items');
    }
}
