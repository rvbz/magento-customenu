<?php
 
class Excellence_customenu_Block_Adminhtml_customenu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_customenu';
        $this->_blockGroup = 'customenu';
        $this->_headerText = Mage::helper('customenu')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('customenu')->__('Add Item');
        parent::__construct();
    }
}