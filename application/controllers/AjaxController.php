<?php
class AjaxController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setnoRender(true);
    }
}


?>
