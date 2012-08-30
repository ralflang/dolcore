<?php
/**
 * A category entity class based on Rdo magic
 * This caters to the messed up dol2day legacy data model
 * TODO: Enhance the data model by numeric ids and parent/child relation fields
 */
class Dolcore_Rdo_Category extends Horde_Rdo_Base
{
    public function getCaption()
    {
        return htmlspecialchars($this->text, null, 'UTF-8', false);
    }

}