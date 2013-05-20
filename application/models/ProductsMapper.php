<?php
class Model_ProductsMapper extends Model_BaseMapper
{

    protected $_dbTable;

    public function __construct()
    {
          $this->_dbTable = new Model_DbTable_Products();
    }

    public function save(Model_Products $product)
    {
        $data = array(
                'p_id'   => $product->getPid(),
                'product_name'   => $product->getProductname(),
                'product_price'   => $product->getProductprice(),
                'product_image'   => $product->getProductimage(),
                'comments'   => $product->getComments(),
        );

        if (null === ($id = $product->getPid())) {
            unset($data['p_id']);
            return $this->_dbTable->insert($data);
        } else {
            return $this->_dbTable->update($data, array('p_id = ?' => $id));
        }
    }
    /**
    * fetch All Product details
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchProductData()
    {
        return $this->fetchFromMaster($this->_dbTable->fetchProductData());
    }
    
    /**
    * fetch data by id
    * @param Array $data
    * @return array
    * @author Parag
    */
    public function fetchProductDataById($data)
    {
        return $this->fetchFromMaster($this->_dbTable->fetchProductDataById($data));
    }
}