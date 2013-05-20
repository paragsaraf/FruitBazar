<?php

abstract class Model_BaseMapper{
    
   /**
     * fetches all rows optionally filtered by where,order,count and offset
     *
     * @param string $where
     * @param string $order
     * @param int $count
     * @param int $offset
     *
     */
    public function fetchFromMaster($where=null, $order=null, $count=null, $offset=null)
    {
        $resultSet = $this->_dbTable->fetchFromMaster($where, $order, $count, $offset);
        return $resultSet;
    }
}

?>