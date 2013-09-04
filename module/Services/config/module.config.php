<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'indexcontroller' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'indexcontroller' => 'Services\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'indexcontroller' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/jsonserver',
                    'defaults' => array(
                        'controller' => 'indexcontroller',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array( 
                    'rpc' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/rpc',
                            'defaults' => array(
                                'controller' => 'indexcontroller',
                                'action'     => 'rpc',
                            ),
                        ),
                    ), 
                    'cliente' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/cliente',
                            'defaults' => array(
                                'controller' => 'indexcontroller',
                                'action'     => 'clientjson',
                            ),
                        ),
                    ),                      
                ),
            ),
        ),
    ),
);