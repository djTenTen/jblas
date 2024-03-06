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



$routes->get('/auditsystem/chapter1/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter1/$1/$2/$3');
$routes->post('/auditsystem/chapter1/manage/ac3/savegenmat/(:any)', 'ChapterController::addac3genmat/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savedoccors/(:any)', 'ChapterController::addac3doccors/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savestatutory/(:any)', 'ChapterController::addac3statutory/$1');
$routes->post('/auditsystem/chapter1/manage/ac3/savedaccsys/(:any)', 'ChapterController::addac3accsys/$1');