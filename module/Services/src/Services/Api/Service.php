<?php
namespace Services\Api;

use Zend\ServiceManager\ServiceManager as ServiceManager;
use Zend\View\Model\ViewModel;

class Service{

   /**
    * @var ServiceManager 
    */
   
   protected static $sm;
   
    public function __construct(ServiceManager $sm){
        self::$sm = $sm;
    }
    
    /**
     * 
     * @param int $limit
     * @return array
     */
    
    public static function getByLimit($limit){
        
        $FuerzaventamenTable = 
                  self::$sm->get('Soapserver\Model\FuerzaventamenTable');
        $items= $FuerzaventamenTable->findByPosition($limit); 
        
        return $items;
    }
    
}