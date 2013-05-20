<?php
class Model_CustproductsMapper extends Model_BaseMapper
{

    protected $_dbTable;

    public function __construct()
    {
          $this->_dbTable = new Model_DbTable_Custproducts();
    }

    public function save(Model_Custproducts $custproducts)
    {
        $data = array(
                'id'   => $custproducts->getId(),
                'order_id'   => $custproducts->getOrderid(),
                'customer_id'   => $custproducts->getCustomerid(),
                'p_id'   => $custproducts->getPid(),
        );

        if (null === ($id = $custproducts->getId())) {
            unset($data['id']);
            return $this->_dbTable->insert($data);
        } else {
            return $this->_dbTable->update($data, array('id = ?' => $id));
        }
    }

    public function fetchDateByOrderId($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchDateByOrderId($data));
    }
    
    public function fetchTotalOrderPriceByOrderId($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchTotalOrderPriceByOrderId($data));
    }
    
    public function fetchUserOrderPriceByOrderId($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchUserOrderPriceByOrderId($data));
    }
}