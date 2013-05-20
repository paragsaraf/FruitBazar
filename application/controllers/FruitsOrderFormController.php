<?php
class FruitsOrderFormController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        
    }   

    public function addToCartAction()
    {
        $this->_helper->layout()->disableLayout();
        session_start();
        $data['productid'] = $this->_getParam('productid');

        if($this->getRequest()->isPost())
        {
            if($data['productid'])
            {
                $_SESSION['productid'][] = $data['productid'];
            }
            $productsMppObj = new Model_ProductsMapper();
            $listArr = array();
            foreach ($_SESSION['productid'] as $value) 
            {
                $productsArr = $productsMppObj->fetchProductDataById($value)->toArray();
                if(count($productsArr) > 0)
                {
                    $listArr[] = $productsArr[0];
                }
            }
            $this->view->productArr = $listArr;
        }
    }
    

    public function removeFromCartAction()
    {
        $this->_helper->layout()->disableLayout();
        session_start();
        $data['productid'] = $this->_getParam('productid');

        if($this->getRequest()->isPost())
        {
            if($data['productid'])
            {
                $key = array_search($data['productid'], $_SESSION['productid']);
                unset($_SESSION['productid'][$key]);
            }
            $productsMppObj = new Model_ProductsMapper();
            $listArr = array();
            foreach ($_SESSION['productid'] as $value) 
            {
                $productsArr = $productsMppObj->fetchProductDataById($value)->toArray();
                if(count($productsArr) > 0)
                {
                    $listArr[] = $productsArr[0];
                }
            }
            $this->view->productArr = $listArr;
        }
    }
    
    public function saveUserOrderAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setnoRender(true);
        session_start();
        if(count($_SESSION['productid']) > 0)
        {
            $data['customerid'] = $this->_getParam('customerid');
            $customerMppObj = new Model_CustomerMapper();
            $customerArr = $customerMppObj->fetchDataById($data)->toArray();
            if(count($customerArr) > 0)
            {
                $data['orderdate'] = date('Y-m-d');
                $custProductMppObj = new Model_CustproductsMapper();
                $customerOrderMppObj = new Model_CustomerorderMapper();
                $customerOrderObj = new Model_Customerorder($data);
                $data['orderid'] = $customerOrderMppObj->save($customerOrderObj);
                
                foreach ($_SESSION['productid'] as $value)
                {
                    if($value)
                    {
                        $data['pid'] = $value;
                        $custProductObj = new Model_Custproducts($data);
                        $custProductMppObj->save($custProductObj);
                    }
                }
                session_destroy();
                echo 'success';
            }
        }
    }
}
