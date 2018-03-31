<?php
class Excellence_customenu_Model_customenu extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		parent::_construct();
		$this->_init('customenu/customenu');
	}
}