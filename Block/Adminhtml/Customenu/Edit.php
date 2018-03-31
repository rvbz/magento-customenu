<?php
 
class Excellence_Customenu_Block_Adminhtml_Customenu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'customenu';
        $this->_controller = 'adminhtml_customenu';
 
        $this->_updateButton('save', 'label', Mage::helper('customenu')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('customenu')->__('Delete Item'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('customenu_data') && Mage::registry('customenu_data')->getId() ) {
            return Mage::helper('customenu')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('customenu_data')->getTitle()));
        } else {
            return Mage::helper('customenu')->__('Add Item');
        }
    }
}