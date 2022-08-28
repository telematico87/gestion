<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
\Fluent\Auth\Facades\Auth::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard::index', ['filter' => 'auth:web']);

$routes->add('dashboard', 'Dashboard::index', ['filter' => 'auth:web']);
$routes->add('perfil', 'Profile::index', ['filter' => 'auth:web']);
$routes->add('categoria', 'Category::index', ['filter' => 'auth:web']);
$routes->add('cliente', 'Client::index', ['filter' => 'auth:web']);
$routes->add('usuario', 'User::index', ['filter' => 'auth:web']);
$routes->add('proveedor', 'Supplier::index', ['filter' => 'auth:web']);

$routes->add('nuevo-producto', 'Product\Add::index', ['filter' => 'auth:web']);
$routes->add('producto', 'Product\Main::index', ['filter' => 'auth:web']);
$routes->add('actualizar-producto/(:any)', 'Product\Edit::index/$1', ['filter' => 'auth:web']);
$routes->add('eliminar-producto/(:any)', 'Product\Main::delete/$1', ['filter' => 'auth:web']);

$routes->add('nueva-compra', 'Purchase\Add::index', ['filter' => 'auth:web']);
$routes->add('compra', 'Purchase\Main::index', ['filter' => 'auth:web']);
$routes->add('detalle-compra/(:any)', 'Purchase\Detail::index/$1', ['filter' => 'auth:web']);

$routes->add('nueva-venta', 'Sale\Add::index', ['filter' => 'auth:web']);
$routes->add('venta', 'Sale\Main::index', ['filter' => 'auth:web']);
$routes->add('detalle-venta/(:any)', 'Sale\Detail::index/$1', ['filter' => 'auth:web']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
