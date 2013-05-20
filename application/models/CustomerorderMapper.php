<?php
class Model_CustomerorderMapper extends Model_BaseMapper
{

    protected $_dbTable;

    public function __construct()
    {
          $this->_dbTable = new Model_DbTable_Customerorder();
    }

    public function save(Model_Customerorder $customerorder)
    {
        $data = array(
		'order_id'   => $customerorder->getOrderid(),
		'customer_id'   => $customerorder->getCustomerid(),
		'order_date'   => $customerorder->getOrderdate(),
	);

        if (null === ($orderid = $customerorder->getOrderid())) {
            unset($data['orderid']);
            return $this->_dbTable->insert($data);
        } else {
            return $this->_dbTable->update($data, array('order_id = ?' => $orderid));
        }
    }

    /**
     * to fetch distinct date for admin search
     * @param Array $data
     * @return Array
     * @author Parag
     */
    public function fetchDistinctDate()
    {
        return $this->fetchFromMaster($this->_dbTable->fetchDistinctDate());
    }
    
    /**
     * to fetch distinct user from date
     * @param Array $data
     * @return Array
     * @author Parag
     */
    public function fetchUserByDate($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchUserByDate($data));
    }
}
?>