<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::postLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->group('admin',['filter' => 'admin'], function($routes)
{
	$routes->get('dashboard', 'AdminController::index');
	$routes->get('chartdata', 'AdminController::chartData');
	$routes->get('pengguna', 'AdminController::pengguna');
	$routes->post('pengguna/cari', 'AdminController::searchPengguna');
	$routes->get('pengguna/tambah', 'AdminController::addPengguna');
	$routes->post('pengguna/tambah/post', 'AdminController::postPengguna');
	$routes->get('pengguna/delete/(:num)', 'AdminController::deletePengguna/$1');
	$routes->post('pengguna/delete', 'AdminController::deletePenggunaBatch');
	$routes->add('pengguna/edit-selected', 'AdminController::editPenggunaBatch');
	$routes->get('pengguna/edit/(:num)', 'AdminController::editPengguna/$1');
	$routes->post('pengguna/update', 'AdminController::updatePengguna');
	$routes->post('pengguna/updatebatch', 'AdminController::updatePenggunaBatch');
	$routes->get('import', 'AdminController::import');
	$routes->post('import/post', 'AdminController::postImport');
	$routes->get('kandidat', 'AdminController::kandidat');
	$routes->get('kandidat/tambah', 'AdminController::addkandidat');
	$routes->post('kandidat/tambah/post', 'AdminController::storekandidat');
	$routes->get('kandidat/edit/(:num)', 'AdminController::editKandidat/$1');
	$routes->add('kandidat/update', 'AdminController::updatekandidat');
	$routes->get('kandidat/delete/(:num)', 'AdminController::deleteKandidat/$1');
	$routes->get('voting', 'AdminController::voting');
	$routes->get('voting/tambah', 'AdminController::addVoting');
	$routes->post('voting/tambah/post', 'AdminController::storeVoting');
	$routes->add('voting/update', 'AdminController::updateVoting');
	$routes->get('voting/edit/(:num)', 'AdminController::editVoting/$1');
	$routes->get('voting/delete/(:num)', 'AdminController::deleteVoting/$1');
});
$routes->group('user',['filter' => 'auth'], function($routes)
{
	$routes->get('dashboard', 'UserController::index');
	$routes->get('profile', 'UserController::getProfile');
	$routes->post('changepassword','UserController::changePass');
	$routes->get('voting/(:num)', 'UserController::viewKandidat/$1');
	$routes->get('voting/(:num)/(:num)', 'UserController::vote/$2');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
