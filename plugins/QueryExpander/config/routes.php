<?php
use Cake\Routing\Route\DashedRoute;

$routes->plugin(
    'QueryExpander',
    ['path' => '/'],
    function ($routes) {
        $routes->setRouteClass(DashedRoute::class);

        $routes->get('/queries', ['controller' => 'QueryExpander', 'action' => 'queries']);
        $routes->get('/data', ['controller' => 'QueryExpander', 'action' => 'data']);
        $routes->get('/results', ['controller' => 'QueryExpander', 'action' => 'results']);
        // $routes->get('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'view']);
        // $routes->put('/contacts/{id}', ['controller' => 'Contacts', 'action' => 'update']);
    }
);