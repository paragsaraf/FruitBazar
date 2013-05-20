<?php

/*
*    This class is required for Module based layout
*/

class Plugin_ModuleLayout extends Zend_Controller_plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request){

        $module = strtolower($request->getParam('module'));
        $layout = Zend_Layout::getMvcInstance();
        $view   = $layout->getView();

        if($layout->getMvcEnabled()){
            switch($module){
                case "default":
                    break;
                default:
                    $layout->setLayoutPath(APPLICATION_PATH.'/modules/'.$module. '/layouts/scripts' );
                    $view->addHelperPath(APPLICATION_PATH.'/views/helpers', 'Zend_View_Helper');
                    break;
            }//EOF switch
        }// EOF if($layout->getMvcEnabled()){
    }//EOF preDispatch
}