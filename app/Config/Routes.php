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
$routes->get('/auditsystem/chapter1/manage/ac1/(:any)', 'ChapterController::manageac1/$1');

