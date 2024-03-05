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
$routes->post('/auditsystem/chapter1/manage/ac1/save/(:any)', 'ChapterController::addac1/$1');

$routes->get('/auditsystem/chapter1/manage/ac2/(:any)', 'ChapterController::manageac2/$1');
$routes->post('/auditsystem/chapter1/manage/ac2/save/(:any)', 'ChapterController::addac2/$1');

$routes->get('/auditsystem/chapter1/manage/ac3/(:any)', 'ChapterController::manageac3/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savegenmat/(:any)', 'ChapterController::addac3genmat/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savedoccors/(:any)', 'ChapterController::addac3doccors/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savestatutory/(:any)', 'ChapterController::addac3statutory/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savedaccsys/(:any)', 'ChapterController::addac3accsys/$1');