<?php
class Model_DbTable_Custproducts extends Model_DbTable_Base
{

    protected $_name = 'cust_products';

    public function fetchDateByOrderId($data)
     {
          $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from($this->_name,null)
                        ->joinleft('products','products.p_id = cust_products.p_id',array('product_name','product_price'))
                        ->where('order_id = ?',$data['orderid']);
          //echo $select;exit;
          return $select;
     }
     
    public function fetchTotalOrderPriceByOrderId($data)
     {
          $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from($this->_name,null)
                        ->joinleft('customer_order','customer_order.order_id = cust_products.order_id',null)
                        ->joinleft('products','products.p_id = cust_products.p_id',array('sum(product_price) as total_Price'))
                        ->where('customer_order.order_date = ?',$data['orderdate']);
          //echo $select;exit;
          return $select;
     }
     
    public function fetchUserOrderPriceByOrderId($data)
     {
          $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from($this->_name,null)
                        ->joinleft('customer_order','customer_order.order_id = cust_products.order_id',null)
                        ->joinleft('customer','customer.customer_id = cust_products.customer_id',array('username'))
                        ->joinleft('products','products.p_id = cust_products.p_id',array('sum(product_price) as total_Price'))
                        ->where('customer_order.order_date = ?',$data['orderdate'])
                        ->group('cust_products.customer_id')
                        ->order('total_Price DESC')
                        ->limit(1);
          //echo $select;exit;
          return $select;
     }
    
}