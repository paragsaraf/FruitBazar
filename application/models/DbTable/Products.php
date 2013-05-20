<?php
class Model_DbTable_Products extends Model_DbTable_Base
{

    protected $_name = 'products';


     /**
    * fetch All Product details
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchProductData()
    {
            $select = $this->select()
                        ->from($this->_name);
            return $select;
    }
    /**
       * @param Array $data
       * @return array
      *  @author Vaman
      */
    public function fetchProductDataById($data)
    {
        $select = $this->select()
                        ->from($this->_name)
                        ->where('p_id = ?',$data);
        //echo $select;exit;
        return $select;
    }

}