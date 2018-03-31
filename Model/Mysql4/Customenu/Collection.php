<?php 
class Excellence_Customenu_Model_Mysql4_Customenu_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('customenu/customenu');
    }
}