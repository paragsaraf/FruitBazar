<?php

Abstract class Model_Base{

    public function __set($name, $value)
    {
        $name = preg_replace_callback('/_(.)/', create_function('$matches','return ucfirst($matches[1]);'), $name);
        $method = 'set' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid User property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $name = preg_replace_callback('/_(.)/', create_function('$matches','return ucfirst($matches[1]);'), $name);
        $method = 'get' . ucfirst($name);

        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid User property');
        }
        return $this->$method();
    }

    public function __call($method, array $args)
    {
        throw new Exception("Unrecognized method '$method()'");
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);

        foreach ($options as $key => $value) {
            $key = preg_replace_callback('/_(.)/', create_function('$matches','return ucfirst($matches[1]);'), $key);
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}