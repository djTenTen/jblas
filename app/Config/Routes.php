<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::homepage');
$routes->get('login', 'HomeController::homepage');
$routes->get('forgot', 'HomeController::forgotpass');
$routes->post('resetpass', 'HomeController::resetpass');
$routes->get('setpass/(:any)', 'HomeController::setpass/$1');
$routes->post('savepass/(:any)', 'HomeController::savepass/$1');
$routes->post('authenticate', 'AuthController::auth');
$routes->post('logout', 'AuthController::logout');
$routes->get('register', 'UserController::register');
$routes->get('aud/(:any)', 'UserController::aud/$1');
$routes->post('accept/aud/(:any)', 'UserController::acceptaud/$1');
$routes->post('signup', 'UserController::signup');
$routes->get('403', 'ErrorController::error403');
$routes->get('401', 'ErrorController::error401');
$routes->get('500', 'ErrorController::error500');
$routes->get('cron/task', 'SystemController::crontask');

$routes->group('auditsystem', ['filter' => 'auth'], function ($auth) {
    /**
        ----------------------------------------------------------
        DASHBOARD
        ----------------------------------------------------------
    */
    $auth->get('dashboard', 'DashController::auditsystem');
    $auth->get('dashboard/wp/(:any)', 'DashController::getwpp/$1');
    $auth->get('dashboard/numwpp/(:any)', 'DashController::getnumwpp/$1');
    $auth->get('logs', 'LogsController::logs');
    /**
        ----------------------------------------------------------
        DOCUMENTATION
        ----------------------------------------------------------
    */
    $auth->get('documentation', 'DashController::documentation');
    
    /**
        ----------------------------------------------------------
        ACCOUNT PROFILE MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->get('myaccount', 'UserController::myaccount');
    $auth->post('myaccount/update/(:any)', 'UserController::updatemyinfo/$1');
    /**
        ----------------------------------------------------------
        NOTIFICATION MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->get('notif', 'SystemController::notif');
    $auth->post('notif/rem/(:any)', 'SystemController::removenotif/$1');
    /**
        ----------------------------------------------------------
        SOQM MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->get('soqm', 'SystemController::viewsoqm');
    $auth->get('soqmpdf', 'SystemController::viewsoqmpdf');
    $auth->get('mysoqmpdf', 'SystemController::viewmysoqmpdf');
    $auth->post('soqm/use', 'SystemController::usesoqm');
    $auth->post('soqm/save', 'SystemController::savesoqm');
    $auth->post('soqm/upload', 'SystemController::uploadsoqm');
    
    /**
        ----------------------------------------------------------
        WORK PAPER MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->group('wp', ['filter' => 'workp'], function ($workp) {
        /**
            PREPARER
        */
        $workp->group('', ['filter' => 'preparer'], function ($prep) {
            $prep->get('prepare', 'WorkpaperController::prepare');
            $prep->post('sendtoreview/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoreview/$1/$2/$3/$4/$5');
            $prep->post('sendtoreviewer/(:any)', 'WorkpaperController::sendtoreviewer/$1');
        });
        /**
            REVIEWER
        */
        $workp->group('', ['filter' => 'reviewer'], function ($rev) {
            $rev->get('review', 'WorkpaperController::review');
            $rev->post('sendtoauditor/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoauditor/$1/$2/$3/$4/$5');
            $rev->post('sendtomanager/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtomanager/$1/$2/$3/$4/$5');
            $rev->post('sendtopreparer/(:any)', 'WorkpaperController::sendtopreparer/$1');
            $rev->post('sendtoapprover/(:any)', 'WorkpaperController::sendtoapprover/$1');
        });
        /**
            AUDIT MANAGER/FIRM
        */
        $workp->group('', ['filter' => 'audmanager'], function ($audmanager) {
            $audmanager->get('initiate', 'WorkpaperController::initiate');
            $audmanager->post('sendtoapprove/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoapprove/$1/$2/$3/$4/$5');
            $audmanager->post('save', 'WorkpaperController::saveworkpaper');
            $audmanager->post('sendbacktoreviewer/(:any)', 'WorkpaperController::sendbacktoreviewer/$1');
            $audmanager->post('approved/(:any)', 'WorkpaperController::approvewp/$1');
            $audmanager->get('approved', 'WorkpaperController::approved');
            $audmanager->get('generatepdf/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'ReportController::generatepdf/$1/$2/$3/$4/$5/$6/$7');
            $audmanager->post('delete/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::deletefiles/$1/$2/$3/$4/$5');
            $audmanager->post('delete/(:any)/(:any)', 'WorkpaperController::deleteworkpaper/$1/$2');
        });
        /**
            WORK UPLOAD
        */
        $workp->get('getfiles/(:any)/(:any)/(:any)', 'WorkpaperController::getfiles/$1/$2/$3');
        $workp->post('updateindex/(:any)', 'WorkpaperController::updateindex/$1');
        $workp->post('importtb/(:any)/(:any)/(:any)', 'WorkpaperController::importtb/$1/$2/$3');
        $workp->get('index/setvalues/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewindexfiles/$1/$2/$3/$4/$5/$6');
        $workp->post('index/tb/update/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::updatetb/$1/$2/$3/$4/$5/$6/$7');
        $workp->post('index/tb/upload/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::uploadtbfiles/$1/$2/$3/$4/$5/$6/$7');
        $workp->post('index/recon/update/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::recontbfiles/$1/$2/$3/$4/$5/$6/$7');
        $workp->get('downloadexcel/(:any)', 'WorkpaperController::downloadexcel/$1');
        $workp->post('index/cfs/upload/(:any)/(:any)/(:any)', 'WorkpaperController::uploadcfsfiles/$1/$2/$3');
        $workp->post('index/fstax/upload/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::uploadfstax/$1/$2/$3/$4/$5/$6/$7');
        /**
            PDF VIEW WORK PAPER
        */
        $workp->get('viewpdfc1/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc1/$1/$2/$3/$4');
        $workp->get('viewpdfc2/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc2/$1/$2/$3/$4');
        $workp->get('viewpdfc3/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc3/$1/$2/$3/$4');
        /**
            SET VALUES WORK PAPER
        */
        $workp->get('chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setworkpaper/$1/$2/$3/$4');
        $workp->get('chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setworkpaper/$1/$2/$3/$4');
        $workp->get('chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setworkpaper/$1/$2/$3/$4');
        /**
            SAVE VALUES WORK PAPER
        */
        $workp->post('savevalues/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::savevalues/$1/$2/$3/$4/$5/$6/$7');
        
    });
    /**
        ----------------------------------------------------------
        CLIENT MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->group('', ['filter' => 'client'], function ($client) {
        /**
            CLIENT
        */
        $client->group('client', ['filter' => 'client_cl'], function ($cl) {
            $cl->get('', 'ClientController::viewclient');
            $cl->post('save', 'ClientController::addclient');
            $cl->get('edit/(:any)', 'ClientController::editclient/$1');
            $cl->post('update/(:any)', 'ClientController::updateclient/$1');
            $cl->post('acin/(:any)', 'ClientController::acin/$1');
        });
        /**
            CLIENT SET DEFAULTS
        */ 
        $client->group('client', ['filter' => 'client_sd'], function ($sd) {
            /**
                PDF VIEW CLIENTS
            */ 
            $sd->get('chapter1/view/(:any)/(:any)', 'ChapterController::viewc1pdf/$1/$2');
            $sd->get('chapter2/view/(:any)/(:any)', 'ChapterController::viewc2pdf/$1/$2');
            $sd->get('chapter3/view/(:any)/(:any)', 'ChapterController::viewc3pdf/$1/$2');
            /**
                SET VALUES CLIENTS
            */
            $sd->get('chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setvalues/$1/$2/$3/$4');
            $sd->get('chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setvalues/$1/$2/$3/$4');
            $sd->get('chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setvalues/$1/$2/$3/$4');
            $sd->get('set', 'ClientController::viewclientset');
            $sd->get('files/(:any)/(:any)', 'ClientController::viewfiles/$1/$2');
            $sd->post('setfiles/(:any)/(:any)', 'ClientController::setfiles/$1/$2');
            $sd->post('removefiles/(:any)/(:any)', 'ClientController::removefiles/$1/$2');
            $sd->get('defaultfiles/(:any)/', 'ClientController::getdefaultfiles/$1');
            $sd->get('getfiles/(:any)/(:any)', 'ClientController::getfiles/$1/$2');
            /**
                SAVE VALUES CLIENTS
            */
            $sd->post('savevalues/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savevalues/$1/$2/$3/$4/$5/$6');

        });
    });
    

    /**
        ----------------------------------------------------------
        AUDITOR MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->group('', ['filter' => 'manager'], function ($audm) {
        $audm->group('', ['filter' => 'auditor'], function ($audm) {
            $audm->get('auditor', 'AuditorController::viewauditor');
            $audm->post('auditor/save', 'AuditorController::addauditor');
            $audm->get('auditor/edit/(:any)', 'AuditorController::editauditor/$1');
            $audm->post('auditor/update/(:any)', 'AuditorController::updateauditor/$1');
            $audm->post('auditor/acin/(:any)', 'AuditorController::acin/$1');
        });
    });

    
});
