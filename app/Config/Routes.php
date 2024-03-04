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
$routes->get('/auditsystem/chapter1/add', 'ChapterController::addchapter1');
$routes->get('/auditsystem/chapter1/manage/(:any)', 'ChapterController::managechapter1/$1');

$routes->post('/chapter1/save', 'ChapterController::savechapter1');
$routes->get('/chapter1/items/view', 'ChapterController::viewchapter1items');

$routes->post('/chapter1/manage/save/(:any)', 'ChapterController::savemanagechapter/$1');

// Chapter2
$routes->get('/chapter2/view', 'ChapterController::viewchapter2');
$routes->get('/chapter2/add', 'ChapterController::addchapter2');
$routes->post('/chapter2/save', 'ChapterController::savechapter2');


// Chapter3
$routes->get('/chapter3/view', 'ChapterController::viewchapter3');
$routes->get('/chapter3/add', 'ChapterController::addchapter3');
$routes->post('/chapter3/save', 'ChapterController::savechapter3');
