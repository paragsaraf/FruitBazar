<?php
class Model_Customer extends Model_Base
{

    protected $_customer_id;

    protected $_username;

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
              throw new Exception('Invalid customer property');
         }
         $this->$method($value);
    }

    public function __get($name)
    {
         $method = 'get' . $name;
         if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid customer property');
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

    public function setCustomerid($customerId)
    {
         $this->_customer_id = $customerId;
         return $this;
    }

    public function getCustomerid()
    {
         return $this->_customer_id;
    }

    public function setUsername($username)
    {
         $this->_username = $username;
         return $this;
    }

    public function getUsername()
    {
         return $this->_username;
    }
}