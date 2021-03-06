<?php
class Model_Customerorder extends Model_Base
{

    protected $_orderid;

    protected $_customerid;

    protected $_orderdate;

    public function __construct(array $options = null)
    {
        if (is_array($options))
        {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
             throw new Exception('Invalid customer_order property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
             throw new Exception('Invalid customer_order property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
             $method = 'set' . ucfirst($key);
             if (in_array($method, $methods)) {
                  $this->$method($value);
             }
        }
        return $this;
    }


    public function setOrderid($orderid)
    {
        $this->_orderid = $orderid;
        return $this;
    }

    public function getOrderid()
    {
        return $this->_orderid;
    }

    public function setCustomerid($customerid)
    {
        $this->_customerid = $customerid;
        return $this;
    }

    public function getCustomerid()
    {
        return $this->_customerid;
    }

    public function setOrderdate($orderdate)
    {
        $this->_orderdate = $orderdate;
        return $this;
    }

    public function getOrderdate()
    {
        return $this->_orderdate;
    }
	
}
?>