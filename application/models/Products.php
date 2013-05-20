<?php
class Model_Products extends Model_Base
{

    protected $_pid;

    protected $_productname;

    protected $_productprice;

    protected $_productimage;

    protected $_comments;

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
              throw new Exception('Invalid products property');
         }
         $this->$method($value);
    }

    public function __get($name)
    {
         $method = 'get' . $name;
         if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid products property');
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

    public function setPid($pid)
    {
         $this->_pid = $pid;
         return $this;
    }

    public function getPid()
    {
         return $this->_pid;
    }

    public function setProductname($productname)
    {
         $this->_productname = $productname;
         return $this;
    }

    public function getProductname()
    {
         return $this->_productname;
    }

    public function setProductprice($productprice)
    {
         $this->_productprice = $productprice;
         return $this;
    }

    public function getProductprice()
    {
         return $this->_productprice;
    }

    public function setProductimage($productimage)
    {
         $this->_productimage = $productimage;
         return $this;
    }

    public function getProductimage()
    {
         return $this->_productimage;
    }

    public function setComments($comments)
    {
         $this->_comments = $comments;
         return $this;
    }

    public function getComments()
    {
         return $this->_comments;
    }

}