<?php
use Cake\Routing\Route\DashedRoute;

$routes->plugin(
    'QueryExpander',
    ['path' => '/'],
    function ($routes) {
        $routes->setRouteClass(DashedRoute::class);


        $routes->connect('/', ['plugin' => null, 'controller' => 'Tools', 'action' => 'selectReport']);
        $routes->connect('/queries', ['controller' => 'QueryExpander', 'action' => 'queries']);
        $routes->connect('/data', ['controller' => 'QueryExpander', 'action' => 'data']);
        $routes->connect('/result', ['controller' => 'QueryExpander', 'action' => 'result']);
        // $routes->get('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'view']);
        // $routes->put('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'update']);
    }
);