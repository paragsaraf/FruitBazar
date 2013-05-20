<?php
class Model_CustomerMapper extends Model_BaseMapper
{

    protected $_dbTable;

    public function __construct()
    {
          $this->_dbTable = new Model_DbTable_Customer();
    }

    public function save(Model_Customer $customer)
    {
        $data = array(
                'customer_id'   => $customer->getCustomerid(),
                'username'   => $customer->getUsername(),
        );

        if (null === ($customerId = $customer->getCustomerid())) {
            unset($data['customer_id']);
            return $this->_dbTable->insert($data);
        } else {
            return $this->_dbTable->update($data, array('customer_id = ?' => $customerId));
        }
    }

    /**
    * fetch User name of all customer
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchCustomerList()
    {
        return $this->fetchFromMaster($this->_dbTable->fetchCustomerList());
    }
    
    /**
    * fetch User Details by id
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchDataById($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchDataById($data));
    }
}