<?php
 
class Excellence_customenu_Adminhtml_customenuController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('customenu/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('customenu/adminhtml_customenu'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $customenuId     = $this->getRequest()->getParam('id');
        $customenuModel  = Mage::getModel('customenu/customenu')->load($customenuId);
 
        if ($customenuModel->getId() || $customenuId == 0) {
 
            Mage::register('customenu_data', $customenuModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('customenu/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('customenu/adminhtml_customenu_edit'))
                 ->_addLeft($this->getLayout()->createBlock('customenu/adminhtml_customenu_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customenu')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $customenuModel = Mage::getModel('customenu/customenu');

                if (isset($postData['stores'])){
                    if (in_array('0', $postData['stores'])) {
                        $postData['stores'] = '0';
                    } else {
                        $postData['stores'] = implode(",", $postData['stores']);
                    }
                }

                if ($postData['stores'] == "") {
                    $postData['stores'] = '0';
                }
               
                $customenuModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setMenuUrl($postData['menu_url'])
                    ->setStores($postData['stores'])
                    ->setActive($postData['active'])
                    ->setSort_order($postData['sort_order'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setcustomenuData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setcustomenuData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $customenuModel = Mage::getModel('customenu/customenu');
               
                $customenuModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $Ids = $this->getRequest()->getParam('target_id');

        if (!is_array($Ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customenu')->__('Select a menu item'));
        } else {
            try {
                $MenuModel = Mage::getModel('customenu/customenu');
                foreach ($Ids as $Id) {
                    $MenuModel->load($Id)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('customenu')->__(
                        'Total of %d record(s) were deleted.', count($Ids)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }


    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('customenu/adminhtml_customenu_grid')->toHtml()
        );
    }
}