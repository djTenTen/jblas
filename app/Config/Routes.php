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
// Chapter1
$routes->get('/auditsystem/c1/view', 'ChapterController::viewchapter1');
$routes->get('/auditsystem/c1/manage/(:any)/(:any)/(:any)', 'C1ac1Controller::viewac1/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/save/(:any)/(:any)/(:any)', 'C1ac1Controller::addac1questions/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/update/(:any)/(:any)/(:any)/(:any)', 'C1ac1Controller::updateac1questions/$1/$2/$3/$4');
$routes->post('/auditsystem/c1/manage/activeinactive/(:any)/(:any)/(:any)/(:any)', 'C1ac1Controller::activeinactiveac1/$1/$2/$3/$4');
$routes->post('/auditsystem/c1/nameap/update/(:any)/(:any)/(:any)/(:any)', 'C1ac1Controller::updatenameap/$1/$2/$3/$4');
$routes->post('/auditsystem/c1/eqr/update/(:any)/(:any)/(:any)/(:any)', 'C1ac1Controller::updateeqr/$1/$2/$3/$4');



// Client Management
$routes->get('/auditsystem/clients/view', 'ClientController::viewclient');
$routes->get('/auditsystem/clients/defaults/(:any)', 'ClientController::clientdefaults/$1');

















//AJAX REQUEST
// Chapter 1
$routes->get('/auditsystem/chapter1/ac1/edit/(:any)', 'C1ac1Controller::editac1question/$1');