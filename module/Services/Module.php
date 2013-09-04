<?php
namespace Services;

class Module
{
    /** 
     * @return type
     */
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return type
     */
    
   public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return type
     */
    
   public function getServiceConfig(){
        return array(
            'factories' => array(
                'Services\Model\FuerzaventamenTable' => function($sm) {
                    $dbAdapter = $sm->get('db');
                    $table     = new Model\FuerzaventamenTable($dbAdapter);
                    
                    return $table;
                }
            )    
        );
    }  
    
}
