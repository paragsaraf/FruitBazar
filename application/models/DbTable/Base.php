<?php
abstract class Model_DbTable_Base extends Zend_Db_Table_Abstract
{
    protected $_adapter;

    public function  init()
    {
        #set master    adapter    from registry
        if(!isset($this->_adapter))
        {
            $this->_adapter = Zend_Registry::get('Master_Adapter');
        }
    }

    /**
     * Insert data in database table
     *
     * @var array $data
    */
    public function query($sql){
        $this->_setAdapter($this->_adapter);

        $lastInsertId = $this->_adapter->query($sql);
        return $lastInsertId;
    }

    /**
     * Insert data in database table
     *
     * @var array $data
    */
    public function insert(array $data){
        $this->_setAdapter($this->_adapter);

        $lastInsertId = parent::insert($data);
        return $lastInsertId;
    }
    
    /**
     * Update data in database table
     *
     * @param  array $where
     * @param  array $data
    */
    public function update(array $data, $where){

        if(null == $where){
            throw new Zend_Exception('No where clause specified');
        }

        if ($this->_adapter === null) {
            throw new Zend_Exception('No master adapter specified');
        }

        $this->_setAdapter($this->_adapter);
        $numAffectedRows = parent::update($data, $where);
        return $numAffectedRows;
    }

    public function delete($where){

        if(null == $where){
            throw new Zend_Exception('No where clause specified');
        }

        if ($this->_adapter === null) {
             throw new Zend_Exception('No master adapter specified');
        }

        $this->_setAdapter($this->_adapter);
        parent::delete($where);
    }

    public function replace(array $bind)
    {
        // extract and quote col names from the array keys
        $cols = array();
        $vals = array();
        foreach ($bind as $col => $val) {
            $cols[] = $this->_db->quoteIdentifier($col, true);
            if ($val instanceof Zend_Db_Expr) {
                $vals[] = $val->__toString();
                unset($bind[$col]);
            } else {
                $vals[] = '?';
            }
        }

        // build the statement
        $sql = "REPLACE INTO "
        . $this->_db->quoteIdentifier($this->_name, true)
        . ' (' . implode(', ', $cols) . ') '
        . 'VALUES (' . implode(', ', $vals) . ')';

        $this->_setAdapter($this->_adapter);

        // execute the statement and return the number of affected rows
        $stmt = $this->_db->query($sql, array_values($bind));
        $result = $stmt->rowCount();

        return $result;

    }

    /**
     * Inserts a table row with specified data.
     *
     * @param mixed $table The table to insert data into.
     * @param array $bind Column-value pairs.
     * @return int The number of affected rows.
     */
    public function insertIgnore(array $bind)
    {
        // extract and quote col names from the array keys
        $cols = array();
        $vals = array();
        foreach ($bind as $col => $val) {
            $cols[] = $this->_db->quoteIdentifier($col, true);
            if ($val instanceof Zend_Db_Expr) {
                $vals[] = $val->__toString();
                unset($bind[$col]);
            } else {
                $vals[] = '?';
            }
        }

        // build the statement
        $sql = "INSERT IGNORE INTO "
        . $this->_db->quoteIdentifier($this->_name, true)
        . ' (' . implode(', ', $cols) . ') '
        . 'VALUES (' . implode(', ', $vals) . ')';

        $this->_setAdapter($this->_adapter);

        // execute the statement and return the number of affected rows
        $stmt = $this->_db->query($sql, array_values($bind));
        $result = $stmt->rowCount();

        return $result;
    }


    public function fetchFromMaster($where=null, $order=null, $count=null, $offset=null){
        $this->_setAdapter($this->_adapter);
        $resultset = $this->fetchAll($where, $order, $count, $offset);
        return $resultset;
    }


    public function setMasterAdapter()
    {
        $this->_setAdapter($this->_adapter);
    }
}
