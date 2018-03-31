<?php
 
class Excellence_Customenu_Block_Adminhtml_Customenu_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('customenu_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('customenu')->__('News Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('customenu')->__('Item Information'),
            'title'     => Mage::helper('customenu')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('customenu/adminhtml_customenu_edit_tab_form')->toHtml(),
        ));
       
        return parent::_beforeToHtml();
    }
}