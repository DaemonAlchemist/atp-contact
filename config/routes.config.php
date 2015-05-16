<?php

return array(
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/contact[/:action]',
                    'defaults' => array(
                        'controller'    => 'ATPContact\Controller\IndexController',
						'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ATPContact\Controller\IndexController' => 'ATPContact\Controller\IndexController'
        ),
    ),
);