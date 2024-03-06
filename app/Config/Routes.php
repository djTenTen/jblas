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
$routes->get('/auditsystem/chapter1/view', 'ChapterController::viewchapter1');
$routes->get('/auditsystem/chapter1/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter1/$1/$2/$3');
$routes->post('/auditsystem/chapter1/manage/save/(:any)/(:any)/(:any)', 'ChapterController::addchaper1/$1/$2/$3');


// Client Management
$routes->get('/auditsystem/clients/view', 'ClientController::viewclient');
$routes->get('/auditsystem/clients/defaults/(:any)', 'ClientController::clientdefaults/$1');