<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
 * So you can use `$this` to reference the application class instance
 * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        $builder->connect('/users', ['plugin' => null, 'controller' => 'Users', 'action' => 'listAdmin']);
        $builder->connect('/reports', ['plugin' => null, 'controller' => 'Reports', 'action' => 'listUser']);


        // $builder->plugin('Tools/QueryExpander',  function ($routes) {
        //     $routes->connect('/', ['controller' => 'QueryExpander', 'action' => 'queries']);
        //     $routes->fallbacks(DashedRoute::class);
        // });

                // $builder->connect('/query-expander', ['plugin' => 'Tools/QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries']);
        // $builder->connect('/query-expander', ['plugin' => 'Tools/QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries', '_ext' => NULL, ]);
        $builder->connect('/tools/query-expander', ['plugin' => 'Tools/QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries', '_ext' => NULL, ]);




        // $builder->connect('/queryExpander', ['plugin' => 'Tools/QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries', '_ext' => NULL]);

        // $builder->plugin('App/Users', ['path' => '/users'], function ($routes) {
        //     $routes->fallbacks('DashedRoute');#
        // });
        //$builder->connect('/users/index', ['controller' => 'Users', 'action' => 'index']);


        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * It is NOT recommended to use fallback routes after your initial prototyping phase!
         * See https://book.cakephp.org/5/en/development/routing.html#fallbacks-method for more information
         */
        $builder->fallbacks();
    });

    

    $routes->scope('/apps', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'apps']);



        // $builder->connect('/users', ['plugin' => null, 'controller' => 'Users', 'action' => 'listAdmin']);
        // $builder->connect('/reports', ['plugin' => null, 'controller' => 'Reports', 'action' => 'listUser']);

        $builder->fallbacks();
    });

    $routes->scope('/users', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Users', 'action' => 'listUser']);
        $builder->connect('/view/*', ['controller' => 'Users', 'action' => 'view']);
        $builder->connect('/add', ['controller' => 'Users', 'action' => 'add']);
        $builder->connect('/edit/*', ['controller' => 'Users', 'action' => 'edit']);
        $builder->connect('/delete/*', defaults: ['controller' => 'Users', 'action' => 'delete']);
        $builder->connect('/settings/*', defaults: ['controller' => 'Users', 'action' => 'settings']);
        $builder->connect('/change-password/*', defaults: ['controller' => 'Users', 'action' => 'changePassword']);

        // $builder->connect('/users', ['plugin' => null, 'controller' => 'Users', 'action' => 'listAdmin']);
        // $builder->connect('/reports', ['plugin' => null, 'controller' => 'Reports', 'action' => 'listUser']);

        $builder->fallbacks();
    });

    $routes->scope('/reports', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Reports', 'action' => 'listUser']);
        $builder->connect('/list-admin', ['controller' => 'Reports', 'action' => 'listAdmin']);
        $builder->connect('/view/*', ['controller' => 'Reports', 'action' => 'view']);
        $builder->connect('/add', ['controller' => 'Reports', 'action' => 'add']);
        $builder->connect('/edit/*', ['controller' => 'Reports', 'action' => 'edit']);
        $builder->connect('/delete/*', ['controller' => 'Reports', 'action' => 'delete']);

        $builder->fallbacks();
    });


    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
