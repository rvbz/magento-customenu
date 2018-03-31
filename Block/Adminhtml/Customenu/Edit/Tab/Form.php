<?php
 
class Excellence_Customenu_Block_Adminhtml_Customenu_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('customenu_form', array('legend'=>Mage::helper('customenu')->__('Item information')));
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('customenu')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
			$fieldset->addField('stores', 'multiselect', array(
				'name'      => 'stores[]',
				'label'     => Mage::helper('customenu')->__('Select Store'),
				'title'     => Mage::helper('customenu')->__('Select Store'),
				'required'  => true,
				'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
			));
		}
		else {
			$fieldset->addField('stores', 'hidden', array(
				'name'      => 'stores[]',
				'value'     => Mage::app()->getStore(true)->getId()
			));
		}
 
       	$fieldset->addField('menu_url', 'text', array(
            'label'     => Mage::helper('customenu')->__('Menu Url'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'menu_url',
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label'     => Mage::helper('customenu')->__('Sort order'),
            'name'      => 'sort_order',
        ));

        $fieldset->addField('active', 'select', array(
            'label'     => Mage::helper('customenu')->__('Status'),
            'name'      => 'active',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('customenu')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('customenu')->__('Inactive'),
                ),
            ),
        ));

       
        if ( Mage::getSingleton('adminhtml/session')->getcustomenuData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getcustomenuData());
            Mage::getSingleton('adminhtml/session')->setcustomenuData(null);
        } elseif ( Mage::registry('customenu_data') ) {
            $form->setValues(Mage::registry('customenu_data')->getData());
        }
        return parent::_prepareForm();
    }
}
