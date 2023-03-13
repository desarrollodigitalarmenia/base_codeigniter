<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('/', 'Home::login');

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

// CRUD RESTful Routes

$routes->get('/login',                  'Home::login');
$routes->get('/register',               'Home::register');
$routes->get('region/([a-z]+)',         'Home::region/$1');
$routes->get('city/([a-z]+)/([a-z]+)',  'Home::city/$1/$2');
$routes->get('category/([a-z]+)',       'Home::category/$1');
//$routes->get('business/([a-z,_]+)',     'Home::getBusiness/$1');

$routes->post('findcity',               'Home::searchMain');
$routes->post('search',                 'Home::search');

$routes->get('aboutus',                 'Home::aboutus');
$routes->get('blog',                    'Home::blog');
$routes->get('contactus',               'Home::contactus');

$routes->get('account',                 'Account::dashboard');
$routes->post('account/login',          'Account::login');
$routes->get('account/logout',          'Account::logout');
$routes->get('account/editBusiness',    'Account::editBusiness');
$routes->get('account/editUser',        'Account::editUser');


$routes->get('admin/',                      'UserController::dashboard');
$routes->post('admin/login',                'UserController::login');
$routes->get('admin/logout',                'UserController::logout');
$routes->get('admin/users-list',            'UserController::index');
$routes->get('admin/user-form',             'UserController::create');
$routes->post('admin/submit-form',          'UserController::store');
$routes->get('admin/edit-view/(:num)',      'UserController::singleUser/$1');
$routes->post('admin/update',               'UserController::update');
$routes->get('admin/delete/(:num)',         'UserController::delete/$1');

$routes->get('/business/list',              'Business::list');

//Users
$routes->get('admin/user/list',             'UserController::index');
$routes->get('admin/user/create',           'UserController::create');
$routes->post('admin/user/add',             'UserController::store');
$routes->get('admin/user/edit/(:num)',      'UserController::singleUser/$1');
$routes->post('admin/user/update',          'UserController::update');
$routes->get('admin/user/delete/(:num)',    'UserController::delete/$1');

//Roles
$routes->get('admin/rol/list',              'RolController::index');
$routes->get('admin/rol/create',            'RolController::create');
$routes->post('admin/rol/add',              'RolController::store');
$routes->get('admin/rol/edit/(:num)',       'RolController::detail/$1');
$routes->post('admin/rol/update',           'RolController::update');
$routes->get('admin/rol/delete/(:num)',     'RolController::delete/$1');


