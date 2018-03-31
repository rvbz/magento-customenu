<?php
 
class Excellence_Customenu_Block_Adminhtml_Customenu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customenuGrid');
        // This is the primary key of the database
        $this->setDefaultSort('customenu_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('customenu_id');
        $this->getMassactionBlock()->setFormFieldName('target_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('customenu')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('customenu')->__('Are you sure?')
        ));

        return $this;
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customenu/customenu')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('customenu_id', array(
            'header'    => Mage::helper('customenu')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'customenu_id',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('stores', array(
             'header'        => Mage::helper('customenu')->__('Stores'),
             'index'         => 'stores',
             'type'          => 'stores',
             'store_all'     => true,
             'store_view'    => true,
             'sortable'      => false,
             'filter_condition_callback'
                 => array($this, '_filterStoreCondition'),
            ));
        }
 
        $this->addColumn('title', array(
            'header'    => Mage::helper('customenu')->__('Title'),
            'align'     =>'left',
            'index'     => 'title',
        ));

        $this->addColumn('menu_url', array(
            'header'    => Mage::helper('customenu')->__('Url'),
            'align'     =>'left',
            'index'     => 'menu_url',
        ));

        $this->addColumn('sort_order', array(
            'header'    => Mage::helper('customenu')->__('Sort Order'),
            'align'     =>'left',
            'index'     => 'sort_order',
        ));

        $this->addColumn('active', array(
            'header'    => Mage::helper('customenu')->__('Active'),
            'index'     => 'active',
            'align'     => 'left',
            'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('customenu')->__('Active'),
                0 => Mage::helper('customenu')->__('Inactive'),
            ),
        ));
        
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}