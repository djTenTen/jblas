<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::homepage');
$routes->get('/login', 'HomeController::homepage');
$routes->post('/authenticate', 'AuthController::auth');
$routes->post('/logout', 'AuthController::logout');
$routes->get('/register', 'UserController::register');
$routes->post('/signup', 'UserController::signup');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    //$routes->get('/dashboard', 'DashController::dashboard');
    //Audit System
    $routes->get('/auditsystem', 'DashController::auditsystem');

    // auditinf firm management
    $routes->get('/auditsystem/firms', 'FirmsController::viewfirms');
    $routes->post('/auditsystem/firms/verify/(:any)', 'FirmsController::verifyfirm/$1');
    
    // Position Management
    $routes->get('/auditsystem/position', 'PositionController::viewposition');
    $routes->post('/auditsystem/position/save', 'PositionController::addposition');
    $routes->get('/auditsystem/position/edit/(:any)', 'PositionController::editposition/$1');
    $routes->post('/auditsystem/position/update/(:any)', 'PositionController::updateposition/$1');
    $routes->post('/auditsystem/position/acin/(:any)', 'PositionController::acin/$1');
    // Client Management
    $routes->get('/auditsystem/client', 'ClientController::viewclient');
    $routes->post('/auditsystem/client/save', 'ClientController::addclient');
    $routes->get('/auditsystem/client/edit/(:any)', 'ClientController::editclient/$1');
    $routes->post('/auditsystem/client/update/(:any)', 'ClientController::updateclient/$1');
    $routes->post('/auditsystem/client/acin/(:any)', 'ClientController::acin/$1');
    $routes->get('/auditsystem/client/set', 'ClientController::viewclientset');
    $routes->get('/auditsystem/client/files/(:any)/(:any)', 'ClientController::viewfiles/$1/$2');
    $routes->post('/auditsystem/client/setfiles/(:any)', 'ClientController::setfiles/$1');
    $routes->get('/auditsystem/client/defaultfiles/(:any)/', 'ClientController::getdefaultfiles/$1');
    $routes->get('/auditsystem/client/getfiles/(:any)/(:any)', 'ClientController::getfiles/$1/$2');
    // Auditor Management
    $routes->get('/auditsystem/auditor', 'AuditorController::viewauditor');
    $routes->post('/auditsystem/auditor/save', 'AuditorController::addauditor');
    $routes->get('/auditsystem/auditor/edit/(:any)', 'AuditorController::editauditor/$1');
    $routes->post('/auditsystem/auditor/update/(:any)', 'AuditorController::updateauditor/$1');
    $routes->post('/auditsystem/auditor/acin/(:any)', 'AuditorController::acin/$1');
    // User Management
    $routes->get('/auditsystem/user', 'UserController::viewusers');
    $routes->post('/auditsystem/user/save', 'UserController::adduser');
    $routes->get('/auditsystem/user/edit/(:any)', 'UserController::edituser/$1');
    $routes->post('/auditsystem/user/update/(:any)', 'UserController::udpateuser/$1');
    $routes->post('/auditsystem/user/find', 'UserController::findfirm');
    $routes->post('/auditsystem/user/acin/(:any)', 'UserController::acin/$1');


    
    // viewing of chapter files
    $routes->get('/auditsystem/chapter1/view/(:any)/(:any)', 'ChapterController::viewc1pdf/$1/$2');
    $routes->get('/auditsystem/chapter2/view/(:any)/(:any)', 'ChapterController::viewc2pdf/$1/$2');
    $routes->get('/auditsystem/chapter3/view/(:any)/(:any)', 'ChapterController::viewc3pdf/$1/$2');
    // Setting values of chapter files
    $routes->get('/auditsystem/chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setvalues/$1/$2/$3/$4');
    $routes->get('/auditsystem/chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setvalues/$1/$2/$3/$4');
    $routes->get('/auditsystem/chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setvalues/$1/$2/$3/$4');
    // Saving Values chapter 1
    $routes->post('auditsystem/client/saveac1/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac1eqr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1eqr/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac2aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2aep/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac3/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac4ppr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4ppr/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac5/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac5/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac6ra/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6ra/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac6s12/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s12/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac6s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s3/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac7/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac7/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac8/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac8/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac9/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac9/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveac10cu/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10cu/$1/$2/$3/$4/$5');
    $routes->post('auditsystem/client/saveac10s1/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s1/$1/$2/$3/$4/$5');
    $routes->post('auditsystem/client/saveac10s2/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s2/$1/$2/$3/$4/$5');
    $routes->post('auditsystem/client/saveac10summ/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10summ/$1/$2/$3/$4/$5');
    $routes->post('auditsystem/client/saveac11/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac11/$1/$2/$3/$4');
    // Saving Values chapter 2
    $routes->post('auditsystem/client/savec2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savequestions/$1/$2/$3/$4');
    $routes->post('auditsystem/client/aicpppa/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaicpppa/$1/$2/$3/$4');
    $routes->post('auditsystem/client/rcicp/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savercicp/$1/$2/$3/$4');
    // Saving Values chapter 3
    $routes->post('auditsystem/client/saveplaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveplaf/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa1s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa1s3/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa2/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa3a/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3a/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa3afaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3afaf/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa3air/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3air/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa3b/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3b/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa3bp4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3bp4/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa7aepapp/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aepapp/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa7isa/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7isa/$1/$2/$3/$4');
    $routes->post('auditsystem/client/saveaa7aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aep/$1/$2/$3/$4');
    
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
    //CHAPTER 1 AC3 ROUTES
    $routes->post('/auditsystem/c1/saveac3/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac3/$1/$2/$3');
    //CHAPTER 1 AC4 ROUTES
    $routes->post('/auditsystem/c1/saveac4ppr/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac4ppr/$1/$2/$3');
    $routes->post('/auditsystem/c1/saveac4/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac4/$1/$2/$3');
    //CHAPTER 1 AC5 ROUTES
    $routes->post('/auditsystem/c1/saveac5/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac5/$1/$2/$3');
    //CHAPTER 1 AC6 ROUTES
    $routes->post('/auditsystem/c1/saveac6ra/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6ra/$1/$2/$3');
    $routes->post('/auditsystem/c1/saveac6s12/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6s12/$1/$2/$3');
    $routes->post('/auditsystem/c1/saveac6s3/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6s3/$1/$2/$3');
    //CHAPTER 1 AC7 ROUTES
    $routes->post('/auditsystem/c1/saveac7/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac7/$1/$2/$3');
    //CHAPTER 1 AC8 ROUTES
    $routes->post('/auditsystem/c1/saveac8/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac8/$1/$2/$3');
    //CHAPTER 1 AC9 ROUTES
    $routes->post('/auditsystem/c1/saveac9/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac9/$1/$2/$3');
    //CHAPTER 1 AC10 ROUTES
    $routes->post('/auditsystem/c1/saveac10cu/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10cu/$1/$2/$3/$4');
    $routes->post('/auditsystem/c1/saveac10s1/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10s1/$1/$2/$3/$4');
    $routes->post('/auditsystem/c1/saveac10s2/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10s2/$1/$2/$3/$4');
    $routes->post('/auditsystem/c1/saveac10summ/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10summ/$1/$2/$3/$4');
    //CHAPTER 1 AC11 ROUTES
    $routes->post('/auditsystem/c1/saveac11/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac11/$1/$2/$3');
    /**
        ----------------------------------------------------------
        CHAPTER 2 AREA
        ----------------------------------------------------------
    */
    // CHAPTER 2 VIEWS
    $routes->get('/auditsystem/c2/view', 'ChapterController::viewchapter2');
    $routes->get('/auditsystem/c2/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter2/$1/$2/$3');
    $routes->post('/auditsystem/c2/manage/save/(:any)/(:any)/(:any)', 'Chapter2Controller::savequestions/$1/$2/$3');
    $routes->post('/auditsystem/c2/manage/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter2Controller::acin/$1/$2/$3/$4');
    $routes->post('/auditsystem/c2/aicpppa/save/(:any)/(:any)/(:any)', 'Chapter2Controller::saveaicpppa/$1/$2/$3');
    $routes->post('/auditsystem/c2/rcicp/save/(:any)/(:any)/(:any)', 'Chapter2Controller::savercicp/$1/$2/$3');
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
    $routes->post('/auditsystem/c3/saveaa7aepapp/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7aepapp/$1/$2/$3');
    $routes->post('/auditsystem/c3/saveaa7isa/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7isa/$1/$2/$3');
    $routes->post('/auditsystem/c3/saveaa7aep/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7aep/$1/$2/$3');
    //aa10
    $routes->post('/auditsystem/c3/saveaa10/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa10/$1/$2/$3');
    //aa11
    $routes->get('/auditsystem/c3/manageaa11/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::viewa11/$1/$2/$3/$4');
    $routes->post('/auditsystem/c3/saveaa11un/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11un/$1/$2/$3');
    $routes->post('/auditsystem/c3/saveaa11ad/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ad/$1/$2/$3');
    $routes->post('/auditsystem/c3/saveaa11ue/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ue/$1/$2/$3');
    $routes->post('/auditsystem/c3/saveaa11con/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11con/$1/$2/$3');
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
    $routes->get('/auditsystem/c4/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter4/$1/$2/$3');
    /**
        ----------------------------------------------------------
        CHAPTER 5 AREA
        ----------------------------------------------------------
    */
    $routes->get('/auditsystem/c5/view', 'ChapterController::viewchapter5');





});












