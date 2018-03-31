<?php
class Excellence_customenu_Model_Mysql4_customenu extends Mage_Core_Model_Mysql4_Abstract
{
	public function _construct()
	{
		$this->_init('customenu/customenu', 'customenu_id');
	}
}