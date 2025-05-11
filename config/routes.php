<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `Routeroutes` instance `$routes` as method argument.
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

    // $routes->plugin('Tools/QueryExpander', function (Routeroutes $routes) {
    //     // Routes connected here are prefixed with '/debug-kit' and
    //     // have the plugin route element set to 'DebugKit'.
    //     $routes->connect('/{controller}');
    // });

    $routes->scope('/', function (RouteBuilder $routes): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $routes->connect('/pages/*', 'Pages::display');

        $routes->connect('/users', ['plugin' => null, 'controller' => 'Users', 'action' => 'listAdmin']);
        $routes->connect('/reports', ['plugin' => null, 'controller' => 'Reports', 'action' => 'listUser']);

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $routes->connect('/{controller}', ['action' => 'index']);
         * $routes->connect('/{controller}/{action}/*', []);
         * ```
         *
         * It is NOT recommended to use fallback routes after your initial prototyping phase!
         * See https://book.cakephp.org/5/en/development/routing.html#fallbacks-method for more information
         */
        $routes->fallbacks();
    });


    $routes->scope('/tools', function (RouteBuilder $routes): void {
        $routes->connect('/',['controller' => 'Tools', 'action' => 'index']);
        $routes->connect('/select-report',['controller' => 'Tools', 'action' => 'selectReport']);
        $routes->connect('/process-selection',['controller' => 'Tools', 'action' => 'processSelection']);
        $routes->connect('/store',['controller' => 'Tools', 'action' => 'storeTool']);


        $routes->connect('/view/*', ['controller' => 'Tools', 'action' => 'view']);
        $routes->connect('/add', ['controller' => 'Tools', 'action' => 'add']);
        $routes->connect('/edit/*', ['controller' => 'Tools', 'action' => 'edit']);
        $routes->connect('/delete/*', defaults: ['controller' => 'Tools', 'action' => 'delete']);

        // Tool: QueryExpander
        $routes->scope('/query-expander', function ($routes) {
            $routes->loadPlugin('QueryExpander');
            // $routes->get('/queries', ['controller' => 'QueryExpander', 'action' => 'queries']);
            // $routes->get('/data', ['controller' => 'QueryExpander', 'action' => 'data']);
            // $routes->get('/results', ['controller' => 'QueryExpander', 'action' => 'results']);
            // $routes->get('/result-download', ['controller' => 'QueryExpander', 'action' => 'resultDownload']);
            
        });
        //$routes->connect('/', ['controller' => 'Users', 'action' => 'listUser']);

        // $routes->connect('/users', ['plugin' => null, 'controller' => 'Users', 'action' => 'listAdmin']);
        // $routes->connect('/reports', ['plugin' => null, 'controller' => 'Reports', 'action' => 'listUser']);

        $routes->fallbacks();
    });

    $routes->scope('/users', function (RouteBuilder $routes): void {
        $routes->connect('/', ['controller' => 'Users', 'action' => 'listUser']);
        $routes->connect('/view/*', ['controller' => 'Users', 'action' => 'view']);
        $routes->connect('/add', ['controller' => 'Users', 'action' => 'add']);
        $routes->connect('/edit/*', ['controller' => 'Users', 'action' => 'edit']);
        $routes->connect('/delete/*', defaults: ['controller' => 'Users', 'action' => 'delete']);
        $routes->connect('/settings/*', defaults: ['controller' => 'Users', 'action' => 'settings']);
        $routes->connect('/change-password/*', defaults: ['controller' => 'Users', 'action' => 'changePassword']);

        $routes->fallbacks();
    });

    $routes->scope('/reports', function (RouteBuilder $routes): void {
        $routes->connect('/', ['controller' => 'Reports', 'action' => 'listUser']);
        $routes->connect('/list-admin', ['controller' => 'Reports', 'action' => 'listAdmin']);
        $routes->connect('/view/*', ['controller' => 'Reports', 'action' => 'view']);
        $routes->connect('/add', ['controller' => 'Reports', 'action' => 'add']);
        $routes->connect('/edit/*', ['controller' => 'Reports', 'action' => 'edit']);
        $routes->connect('/delete/*', ['controller' => 'Reports', 'action' => 'delete']);

        $routes->fallbacks();
    });

    

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (Routeroutes $routes): void {
     *     // No $routes->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $routes->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
