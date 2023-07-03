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
$routes->get('/', 'Home::index');
$routes->get('/ingresar', 'Home::ingresar');
$routes->post('/registrarse', 'Home::register');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/createNewProduct', 'Home::createNewProduct');
$routes->post('/updateProducts', 'Home::updateAllProducts');
$routes->get('/ingresar_productos', 'Home::ingreso_productos');
$routes->post('/ingresoCodigo', 'Home::ingresoCodigo');
$routes->get('/carrito', 'Home::carrito');
$routes->get('/eliminarDeCarrito/(:any)', 'Home::eliminarDeCarrito/$1');
$routes->get('/cobrar/(:any)', 'Home::cobrar/$1');
$routes->get('/caja', 'Home::caja');
$routes->post('/cerrarCaja', 'Home::cerrarCaja');
$routes->get('/facturacion', 'Home::facturacion');
$routes->get('/ticket/(:any)', 'Home::ticket/$1');
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
