<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array (
            'namespace' => '',
            'basePath' => dirname(__FILE__),));
        //Zend_Debug::dump( $autoloader);exit;
        return $autoloader;
    }

    public function _initConfig(){

        Zend_Registry::set('config', Service_Community_Community::config());
    }

    protected function _initView()
    {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('XHTML1_TRANSITIONAL');

        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }

    /**
    * Create Master / Slave & secure database Adapter & store them in registry for future use
    *
    */
    protected function _initConnection()
    {

        //get application settings & set allowmodification true
        $options['allowModifications'] = true;
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');

        //set master connection
        $masterServer = $config->db->master->toArray();
        $masterAdapter = Zend_Db::factory($config->db->adapter, $masterServer['server1']);
        $masterAdapter->query("SET CHARACTER SET 'utf8'");
        Zend_Registry::set('Master_Adapter', $masterAdapter);
        Zend_Db_Table_Abstract :: setDefaultAdapter($masterAdapter);
    }

    /*
     *  This function is required be called For module based layout
     */

    public function _initLayouts(){

        Zend_Layout::startMvc();
        $this->getPluginResource('frontcontroller')
        ->getFrontController()
        ->registerPlugin(new Plugin_ModuleLayout)
        ->registerPlugin(new Plugin_CommunityConfig)
        ;

        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', APPLICATION_ENV);


    }


   protected function _initAction()
   {
       // Action Helpers
       Zend_Controller_Action_HelperBroker::addPath(
               APPLICATION_PATH .'/controllers/helpers');

   }

 
//    public function _initSession()
//    {
//        Zend_Session::start();
//        $this->getPluginResource('frontcontroller')
//        ->getFrontController()
//        ->registerPlugin(new Plugin_UserSession);
//        ///Zend_Registry::set('usession', Plugin_UserSession::routeStartup());
//    }

    /*protected function _initZFDebug() {
        //    if (APPLICATION_ENV != "development")    return;
            $autoloader = Zend_Loader_Autoloader :: getInstance();
            $autoloader->registerNamespace('ZFDebug');
            $options     = array (
                    'plugins' => array (
                        'Variables',
                        'Database' => array (
                            'adapter' => $db,
                            'adapter' => $master
                        ),
                        'File' => array (
                            'basePath' => dirname(__FILE__
                        )
                    ),
                    'Memory',
                    'Time',
                    'Html',
                    'Registry',
                    'Exception'
            ));
            // 'Cache' => array('backend' => $cache->getBackend()),
            $debug = new ZFDebug_Controller_Plugin_Debug($options);
            $this->bootstrap('frontController');
            $frontController = $this->getResource('frontController');

            $frontController->registerPlugin($debug);
            }*/
        }

