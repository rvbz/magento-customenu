<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
ALTER TABLE {$this->getTable('customenu')}
ADD COLUMN `sort_order` SMALLINT(2) NOT NULL default '0' AFTER `stores`;
 
    ");
 
$installer->endSetup();