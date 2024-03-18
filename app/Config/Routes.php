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
//CHAPTER 1 AC3 ROUTES
$routes->post('/auditsystem/c1/manage/save/AC3/(:any)/(:any)', 'C1ac3Controller::addac3questions/$1/$2');
$routes->post('/auditsystem/c1/manage/update/AC3/(:any)/(:any)/(:any)', 'C1ac3Controller::updateac3questions/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/activeinactive/AC3/(:any)/(:any)/(:any)', 'C1ac3Controller::activeinactiveac3/$1/$2/$3');
//CHAPTER 1 AC4 ROUTES
$routes->post('/auditsystem/c1/manage/save/AC4/(:any)/(:any)', 'C1ac4Controller::addac4questions/$1/$2');
$routes->post('/auditsystem/c1/manage/update/AC4/(:any)/(:any)/(:any)', 'C1ac4Controller::updateac4questions/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/activeinactive/AC4/(:any)/(:any)/(:any)', 'C1ac4Controller::activeinactiveac4/$1/$2/$3');
$routes->post('/auditsystem/c1/ppr/update/AC4/(:any)/(:any)/(:any)', 'C1ac4Controller::updateppr/$1/$2/$3');
//CHAPTER 1 AC5 ROUTES
$routes->post('/auditsystem/c1/res/update/AC5/(:any)/(:any)/(:any)', 'C1ac5Controller::updateres/$1/$2/$3');
//CHAPTER 1 AC6 ROUTES
$routes->post('/auditsystem/c1/manage/save/AC6/(:any)/(:any)', 'C1ac6Controller::addac6questions/$1/$2');
$routes->post('/auditsystem/c1/manage/update/AC6/(:any)/(:any)/(:any)', 'C1ac6Controller::updateac6questions/$1/$2/$3');
$routes->post('/auditsystem/c1/manage/activeinactive/AC6/(:any)/(:any)/(:any)', 'C1ac6Controller::activeinactiveac6/$1/$2/$3');
$routes->post('/auditsystem/c1/section/update/AC6/(:any)/(:any)/(:any)', 'C1ac6Controller::udpatesection/$1/$2/$3');
$routes->post('/auditsystem/c1/section3/save/AC6/(:any)/(:any)', 'C1ac6Controller::savesection3/$1/$2');
$routes->post('/auditsystem/c1/section3/update/AC6/(:any)/(:any)/(:any)', 'C1ac6Controller::udpatesection3/$1/$2/$3');
//CHAPTER 1 AC7 ROUTES
$routes->post('/auditsystem/c1/s1/update/AC7/(:any)/(:any)', 'C1ac7Controller::updates1/$1/$2');
$routes->post('/auditsystem/c1/s2/update/AC7/(:any)/(:any)', 'C1ac7Controller::updates2/$1/$2');
//CHAPTER 1 AC8 ROUTES
$routes->post('/auditsystem/c1/manage/update/AC8/(:any)/(:any)', 'C1ac8Controller::updateac8questions/$1/$2');


// Client Management
$routes->get('/auditsystem/clients/view', 'ClientController::viewclient');
$routes->get('/auditsystem/clients/defaults/(:any)', 'ClientController::clientdefaults/$1');

//AJAX REQUEST
// Chapter 1
$routes->get('/auditsystem/c1/ac1/edit/(:any)', 'C1ac1Controller::editac1question/$1');
$routes->get('/auditsystem/c1/ac2/edit/(:any)', 'C1ac2Controller::editac2question/$1');
$routes->get('/auditsystem/c1/ac3/edit/(:any)', 'C1ac3Controller::editac3question/$1');
$routes->get('/auditsystem/c1/ac4/edit/(:any)', 'C1ac4Controller::editac4question/$1');
$routes->get('/auditsystem/c1/ac6/edit/(:any)', 'C1ac6Controller::editac6question/$1');
$routes->get('/auditsystem/c1/ac6/edit2/(:any)', 'C1ac6Controller::editacsection3/$1');