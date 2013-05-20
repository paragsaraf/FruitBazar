<?php

/*
*    This class is required for Community config
*/

class Plugin_CommunityConfig extends Zend_Controller_plugin_Abstract
{

    public function preDispatch(Zend_Controller_Request_Abstract $request){

        $layout = Zend_Layout::getMvcInstance();
        $view   = $layout->getView();
        $config = Zend_Registry::get('config');
        $view->config = $config;

    }//EOF preDispatch
}