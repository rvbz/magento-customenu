<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
ALTER TABLE {$this->getTable('customenu')}
ADD COLUMN `active` TINYINT(1) NOT NULL default '1' AFTER `sort_order`;
 
    ");
 
$installer->endSetup();

// after table changes in "mysql4-{install,upgrade}-*.php" files 
if (method_exists($this->_conn, 'resetDdlCache')) { 
// apply only to specific tables 
    $this->_conn->resetDdlCache('customenu'); 
    //$this->_conn->resetDdlCache('table2'); 
// or whole DDL cache 
    //$this->_conn->resetDdlCache(); 
} 