<?php
class Model_DbTable_Customerorder extends Model_DbTable_Base
{

    protected $_name = 'customer_order';

    /**
     * to fetch distinct date for admin search
     * @param Array $data
     * @return Array
     * @author Parag
     */
    public function fetchDistinctDate()
     {
          $select = $this->select()
                        ->distinct()
                        ->from($this->_name,array('order_date as orderdate'));
          return $select;
     }
     
    /**
     * to fetch distinct user from date
     * @param Array $data
     * @return Array
     * @author Parag
     */
    public function fetchUserByDate($data)
     {
          $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from($this->_name,array('distinct(customer_order.customer_id) as customerid','order_id as orderid'))
                        ->joinleft('customer','customer.customer_id = customer_order.customer_id','username')
                        ->where('customer_order.order_date = ?',$data['orderdate']);
          //echo $select;exit;
          return $select;
     }
}
?>