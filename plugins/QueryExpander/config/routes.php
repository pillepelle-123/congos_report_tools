<?php
use Cake\Routing\Route\DashedRoute;

$routes->plugin(
    'QueryExpander',
    ['path' => '/'],
    function ($routes) {
        $routes->setRouteClass(DashedRoute::class);

        $routes->get('/', ['controller' => 'QueryExpander', 'action' => 'queries']);
        // $routes->get('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'view']);
        // $routes->put('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'update']);
    }
);