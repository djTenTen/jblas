<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::homepage');
$routes->get('/login', 'HomeController::homepage');
$routes->post('/authenticate', 'AuthController::auth');
$routes->get('/dashboard', 'DashController::dashboard');

//Audit System
$routes->get('/auditsystem', 'DashController::auditsystem');
// CHAPTER 1 VIEWS
$routes->get('/auditsystem/c1/view', 'ChapterController::viewchapter1');
$routes->get('/auditsystem/c1/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter1/$1/$2/$3');

// CHAPTER 1 AC1 ROUTES
$routes->post('/auditsystem/c1/manage/save/AC1/(:any)/(:any)', 'C1ac1Controller::addac1questions/$1/$2');
$routes->post('/auditsystem/c1/manage/update/AC1/(:any)/(:any)/(:any)', 'C1ac1Controller::updateac1questions/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/activeinactive/AC1/(:any)/(:any)/(:any)', 'C1ac1Controller::activeinactiveac1/$1/$2/$3');
$routes->post('/auditsystem/c1/nameap/update/AC1/(:any)/(:any)/(:any)', 'C1ac1Controller::updatenameap/$1/$2/$3');
$routes->post('/auditsystem/c1/eqr/update/AC1/(:any)/(:any)/(:any)', 'C1ac1Controller::updateeqr/$1/$2/$3');
//CHAPTER 1 AC2 ROUTES
$routes->post('/auditsystem/c1/manage/save/AC2/(:any)/(:any)', 'C1ac2Controller::addac2questions/$1/$2');
$routes->post('/auditsystem/c1/manage/activeinactive/AC2/(:any)/(:any)/(:any)', 'C1ac2Controller::activeinactiveac2/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/update/AC2/(:any)/(:any)/(:any)', 'C1ac2Controller::updateac2questions/$1/$2/$3');
$routes->post('/auditsystem/c1/aep/update/AC2/(:any)/(:any)/(:any)', 'C1ac2Controller::updateaep/$1/$2/$3');





// Client Management
$routes->get('/auditsystem/clients/view', 'ClientController::viewclient');
$routes->get('/auditsystem/clients/defaults/(:any)', 'ClientController::clientdefaults/$1');

















//AJAX REQUEST
// Chapter 1
$routes->get('/auditsystem/chapter1/ac1/edit/(:any)', 'C1ac1Controller::editac1question/$1');
$routes->get('/auditsystem/chapter1/ac2/edit/(:any)', 'C1ac2Controller::editac2question/$1');