<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
-- DROP TABLE IF EXISTS {$this->getTable('customenu')};
CREATE TABLE {$this->getTable('customenu')} (
  `customenu_id` int(11) unsigned NOT NULL auto_increment,
  `stores` varchar(255) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `menu_url` varchar(500) NOT NULL default '',
  PRIMARY KEY (`customenu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
    ");
 
$installer->endSetup();