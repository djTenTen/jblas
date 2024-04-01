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

/**
    ----------------------------------------------------------
    CHAPTER 1 AREA
    ----------------------------------------------------------
*/
// CHAPTER 1 VIEWS
$routes->get('/auditsystem/c1/view', 'ChapterController::viewchapter1');
$routes->get('/auditsystem/c1/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter1/$1/$2/$3');
// CHAPTER 1 AC1 ROUTES
$routes->post('/auditsystem/c1/saveac1/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac1/$1/$2/$3');
$routes->post('/auditsystem/c1/saveac1eqr/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac1eqr/$1/$2/$3');
$routes->post('/auditsystem/c1/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::acin/$1/$2/$3/$4');
//CHAPTER 1 AC2 ROUTES
$routes->post('/auditsystem/c1/saveac2/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac2/$1/$2/$3');
$routes->post('/auditsystem/c1/saveac2aep/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac2aep/$1/$2/$3');




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
//CHAPTER 1 AC9 ROUTES
$routes->post('/auditsystem/c1/section1/update/AC9/(:any)/(:any)', 'C1ac9Controller::updatesec1ac9/$1/$2');
$routes->post('/auditsystem/c1/section2/update/AC9/(:any)/(:any)', 'C1ac9Controller::updatesec2ac9/$1/$2');
$routes->post('/auditsystem/c1/section3/update/AC9/(:any)/(:any)', 'C1ac9Controller::updatesec3ac9/$1/$2');
//CHAPTER 1 AC10 ROUTES
$routes->post('/auditsystem/c1/section1/save/AC10/(:any)/(:any)/(:any)', 'C1ac10Controller::saves1ac10/$1/$2/$3');
$routes->post('/auditsystem/c1/section2/save/AC10/(:any)/(:any)/(:any)', 'C1ac10Controller::saves2ac10/$1/$2/$3');
$routes->post('/auditsystem/c1/cusection/save/AC10/(:any)/(:any)/(:any)', 'C1ac10Controller::updatecusection/$1/$2/$3');
$routes->post('/auditsystem/c1/summary/save/AC10/(:any)/(:any)/(:any)', 'C1ac10Controller::savesummary/$1/$2/$3');
//CHAPTER 1 AC11 ROUTES
$routes->post('/auditsystem/c1/manage/update/AC11/(:any)/(:any)', 'C1ac11Controller::updateac11/$1/$2');


// Client Management
$routes->get('/auditsystem/clients/view', 'ClientController::viewclient');
$routes->get('/auditsystem/clients/defaults/(:any)', 'ClientController::clientdefaults/$1');

//AJAX REQUEST
// Chapter 1
$routes->get('/auditsystem/c1/ac2/edit/(:any)', 'C1ac2Controller::editac2question/$1');
$routes->get('/auditsystem/c1/ac3/edit/(:any)', 'C1ac3Controller::editac3question/$1');
$routes->get('/auditsystem/c1/ac4/edit/(:any)', 'C1ac4Controller::editac4question/$1');
$routes->get('/auditsystem/c1/ac6/edit/(:any)', 'C1ac6Controller::editac6question/$1');
$routes->get('/auditsystem/c1/ac6/edit2/(:any)', 'C1ac6Controller::editacsection3/$1');



/**
    ----------------------------------------------------------
    CHAPTER 2 AREA
    ----------------------------------------------------------
*/
// CHAPTER 2 VIEWS
$routes->get('/auditsystem/c2/view', 'ChapterController::viewchapter2');
$routes->get('/auditsystem/c2/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter2/$1/$2/$3');
$routes->post('/auditsystem/c2/manage/save/(:any)/(:any)/(:any)', 'C2B2Controller::savequestions/$1/$2/$3');
$routes->post('/auditsystem/c2/manage/activeinactive/(:any)/(:any)/(:any)/(:any)', 'C2B2Controller::activeinactiveac2/$1/$2/$3/$4');
$routes->post('/auditsystem/c2/aicpppa/save/(:any)/(:any)/(:any)', 'C2E21Controller::saveaicpppa/$1/$2/$3');
$routes->post('/auditsystem/c2/rcicp/save/(:any)/(:any)/(:any)', 'C2E21Controller::savercicp/$1/$2/$3');



/**
    ----------------------------------------------------------
    CHAPTER 3 AREA
    ----------------------------------------------------------
*/
// CHAPTER 3 VIEWS
//aa1
$routes->get('/auditsystem/c3/view', 'ChapterController::viewchapter3');
$routes->get('/auditsystem/c3/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter3/$1/$2/$3');
$routes->post('/auditsystem/c3/saveplaf/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa1plaf/$1/$2/$3');
$routes->post('/auditsystem/c3/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::acin/$1/$2/$3/$4');
$routes->post('/auditsystem/c3/saves3/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa1s3/$1/$2/$3');
//aa2   
$routes->post('/auditsystem/c3/saveaa2/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa2/$1/$2/$3');
//aa3a
$routes->post('/auditsystem/c3/saveaa3a/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3a/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa3afaf/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3afaf/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa3air/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3air/$1/$2/$3');
//aa3b
$routes->post('/auditsystem/c3/saveaa3b/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3b/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa3bp4/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3bp4/$1/$2/$3');
//aa5b
$routes->post('/auditsystem/c3/saveaa5b/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa5b/$1/$2/$3');
//aa7
$routes->post('/auditsystem/c3/saveaa7isa/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7isa/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa7aep/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7aep/$1/$2/$3');
//aa10
$routes->post('/auditsystem/c3/saveaa10/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa10/$1/$2/$3');
//aa11
$routes->get('/auditsystem/c3/manageaa11/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::viewa11/$1/$2/$3/$4');
$routes->post('/auditsystem/c3/saveaa11un/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11un/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa11ad/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ad/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa11ue/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ue/$1/$2/$3');
$routes->post('/auditsystem/c3/saveaa11uead/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11uead/$1/$2/$3');

//ab1
$routes->post('/auditsystem/c3/saveab1/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab1/$1/$2/$3');
//ab3
$routes->post('/auditsystem/c3/saveab3/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab3/$1/$2/$3');
//ab4
$routes->get('/auditsystem/c3/manageab4/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::viewab4/$1/$2/$3/$4');
$routes->post('/auditsystem/c3/saveab4/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4/$1/$2/$3');
$routes->post('/auditsystem/c3/saveab4checklist/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4checklist/$1/$2/$3');
//ab4a
$routes->post('/auditsystem/c3/saveab4a/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4a/$1/$2/$3');

/**
    ----------------------------------------------------------
    CHAPTER 4 AREA
    ----------------------------------------------------------
*/
$routes->get('/auditsystem/c4/view', 'ChapterController::viewchapter4');











/**
    ----------------------------------------------------------
    CHAPTER 5 AREA
    ----------------------------------------------------------
*/
$routes->get('/auditsystem/c5/view', 'ChapterController::viewchapter5');


















