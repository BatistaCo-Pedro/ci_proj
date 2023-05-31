<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', []);

$routes->resource('todos', ['filter' => 'jwt']);
$routes->resource('categories', ['filter' => 'jwt']);

$routes->cli("email/send", "Email::send");

// JWT login
$routes->post('auth/jwt', '\App\Controllers\Auth\LoginController::jwtLogin');

// Equivalent to the following:
/*
$routes->get('cars/new', 'Cars::new');
$routes->post('cars', 'Cars::create');
$routes->get('cars', 'Cars::index');
$routes->get('cars/(:segment)', 'Cars::show/$1');
$routes->get('cars/(:segment)/edit', 'Cars::edit/$1');
$routes->put('cars/(:segment)', 'Cars::update/$1');
$routes->patch('cars/(:segment)', 'Cars::update/$1');
$routes->delete('cars/(:segment)', 'Cars::delete/$1');

service('auth')->routes($routes);
See https://codeigniter.com/user_guide/incoming/restful.html
*/


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
