<?php
class Model_DbTable_Customer extends Model_DbTable_Base
{

    protected $_name = 'customer';

    /**
    * fetch User name of all customer
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchCustomerList()
     {
          $select = $this->select()
                        ->from($this->_name,array('customer_id as customerid','username'));
          
          return $select;
     }
     
    /**
    * fetch User Details by id
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchDataById($data)
     {
          $select = $this->select()
                        ->from($this->_name)
                        ->where('customer_id = ?',$data['customerid']);
          
          return $select;
     }
}