<?php
class AdminOrdersViewController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        
    }
    
    public function userListAction()
    {
        $this->_helper->layout()->disableLayout();
        $data['orderdate'] = $this->_getParam('orderdate');
        if($this->getRequest()->isPost())
        {
            $customerOrderMppObj = new Model_CustomerorderMapper();
            $customerOrderArr = $customerOrderMppObj->fetchUserByDate($data)->toArray();
            if(count($customerOrderArr) > 0)
            {
                $this->view->userList = $customerOrderArr;
                $custProductsMppObj = new Model_CustproductsMapper();
                $custProductsArr = $custProductsMppObj->fetchTotalOrderPriceByOrderId($data)->toArray();
                $this->view->totalOrder = $custProductsArr[0]['total_Price'];
                $custProductsArr = $custProductsMppObj->fetchUserOrderPriceByOrderId($data)->toArray();
                $this->view->highestOrder = $custProductsArr[0];
            }
        }
        $this->view->orderDate = $data['orderdate'];
    }
    
    public function orderDetailAction()
    {
        $this->_helper->layout()->disableLayout();
        $data['orderid'] = $this->_getParam('orderid');
        if($this->getRequest()->isPost())
        {
            $custProductsMppObj = new Model_CustproductsMapper();
            $custProductsArr = $custProductsMppObj->fetchDateByOrderId($data)->toArray();
            if(count($custProductsArr) > 0)
            {
                $this->view->orderList = $custProductsArr;
            }
        }
    }
}
