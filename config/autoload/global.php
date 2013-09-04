<?php
return array(
    
    'service_manager' => array(
        
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',   
        ),
        
        'aliases' => array(
            'db' => 'Zend\Db\Adapter\Adapter',
            'cache' => 'Zend\Cache\StorageFactory',
        ),
        
    ),
    
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=prueba;hostname=localhost',
        'username' => 'root',
        'password' => '',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    
);
