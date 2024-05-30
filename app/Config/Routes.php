<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::homepage');
$routes->get('login', 'HomeController::homepage');
$routes->post('authenticate', 'AuthController::auth');
$routes->post('logout', 'AuthController::logout');
$routes->get('register', 'UserController::register');
$routes->get('aud/(:any)', 'UserController::aud/$1');
$routes->post('accept/aud/(:any)', 'UserController::acceptaud/$1');
$routes->post('signup', 'UserController::signup');
$routes->get('403', 'ErrorController::error403');
$routes->get('401', 'ErrorController::error401');
 
$routes->group('', ['filter' => 'auth'], function ($auth) {

    /**
        ----------------------------------------------------------
        DASHBOARD
        ----------------------------------------------------------
    */
    $auth->get('auditsystem', 'DashController::auditsystem');

    /**
        ----------------------------------------------------------
        ACCOUNT PROFILE MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->get('auditsystem/myaccount', 'UserController::myaccount');
    $auth->post('auditsystem/myaccount/update/(:any)', 'UserController::updatemyinfo/$1');

    $auth->group('', ['filter' => 'workp'], function ($workp) {
        /**
            ----------------------------------------------------------
            WORK PAPER AREA
            ----------------------------------------------------------
        */
        $workp->group('', ['filter' => 'preparer'], function ($prep) {

            $prep->get('auditsystem/workpaper/prepare', 'WorkpaperController::prepare');
            $prep->post('auditsystem/wp/sendtoreview/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoreview/$1/$2/$3/$4/$5');
            $prep->post('auditsystem/wp/sendtoreviewer/(:any)', 'WorkpaperController::sendtoreviewer/$1');
            
        });

        $workp->group('', ['filter' => 'reviewer'], function ($rev) {

            $rev->get('auditsystem/workpaper/review', 'WorkpaperController::review');
            $rev->post('auditsystem/wp/sendtoauditor/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoauditor/$1/$2/$3/$4/$5');
            $rev->post('auditsystem/wp/sendtomanager/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtomanager/$1/$2/$3/$4/$5');
            $rev->post('auditsystem/wp/sendtopreparer/(:any)', 'WorkpaperController::sendtopreparer/$1');
            $rev->post('auditsystem/wp/sendtoapprover/(:any)', 'WorkpaperController::sendtoapprover/$1');

        });

        $workp->group('', ['filter' => 'audmanager'], function ($audmanager) {

            $audmanager->get('auditsystem/workpaper/initiate', 'WorkpaperController::initiate');
            $audmanager->post('auditsystem/workpaper/save', 'WorkpaperController::saveworkpaper');
            $audmanager->post('auditsystem/wp/sendbacktoreviewer/(:any)', 'WorkpaperController::sendbacktoreviewer/$1');

        });

        $workp->get('auditsystem/wp/getfiles/(:any)/(:any)/(:any)', 'WorkpaperController::getfiles/$1/$2/$3');
        $workp->post('auditsystem/wp/updateindex/(:any)', 'WorkpaperController::updateindex/$1');

        $workp->post('auditsystem/wp/importtb/(:any)/(:any)/(:any)', 'WorkpaperController::importtb/$1/$2/$3');
        $workp->get('auditsystem/wp/index/setvalues/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewindexfiles/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/index/tb/update/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::updatetb/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/index/tb/upload/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::uploadtbfiles/$1/$2/$3/$4/$5/$6');
        $workp->get('auditsystem/wp/downloadexcel/(:any)', 'WorkpaperController::downloadexcel/$1');
        $workp->post('auditsystem/wp/index/cfs/upload/(:any)/(:any)/(:any)', 'WorkpaperController::uploadcfsfiles/$1/$2/$3');
        /**
            PDF VIEW WORK PAPER
        */
        $workp->get('auditsystem/wp/viewpdfc1/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc1/$1/$2/$3/$4');
        $workp->get('auditsystem/wp/viewpdfc2/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc2/$1/$2/$3/$4');
        $workp->get('auditsystem/wp/viewpdfc3/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc3/$1/$2/$3/$4');

        
        /**
            Setting values of chapter files
        */
        $workp->get('auditsystem/wp/chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setworkpaper/$1/$2/$3/$4');
        $workp->get('auditsystem/wp/chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setworkpaper/$1/$2/$3/$4');
        $workp->get('auditsystem/wp/chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setworkpaper/$1/$2/$3/$4');
        /**
            Saving Values chapter 1
        */
        $workp->post('auditsystem/wp/saveac1/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac1/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac1eqr/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac1eqr/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac2/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac2aep/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac2aep/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac3/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac4ppr/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac4ppr/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac4/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac5/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac5/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac6ra/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6ra/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac6s12/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6s12/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac6s3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6s3/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac7/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac7/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac8/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac8/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac9/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac9/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveac10cu/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10cu/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/saveac10s1/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10s1/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/saveac10s2/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10s2/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/saveac10summ/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10summ/$1/$2/$3/$4/$5/$6');
        $workp->post('auditsystem/wp/saveac11/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac11/$1/$2/$3/$4/$5');
        /**
            Saving Values chapter 2
        */
        $workp->post('auditsystem/wp/savec2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::savequestions/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/aicpppa/save/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaicpppa/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/rcicp/save/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::savercicp/$1/$2/$3/$4/$5');
        /**
            Saving Values chapter 3
        */
        $workp->post('auditsystem/wp/saveplaf/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveplaf/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa1s3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa1s3/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa2/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa3a/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3a/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa3afaf/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3afaf/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa3air/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3air/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa3b/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3b/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa3bp4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3bp4/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa7aepapp/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7aepapp/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa7isa/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7isa/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa7aep/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7aep/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa10/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa10/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa11ue/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11ue/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa11un/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11un/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa11con/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11con/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa11ad/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11ad/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa11uead/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11uead/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveab3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab3/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveab4a/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4a/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveab4checklist/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4checklist/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveab4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveab1/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab1/$1/$2/$3/$4/$5');
        $workp->post('auditsystem/wp/saveaa5b/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa5b/$1/$2/$3/$4/$5');
        
    });

    $auth->group('', ['filter' => 'firm'], function ($firm) {
        /**
            ----------------------------------------------------------
            FIRMS MANAGEMENT
            ----------------------------------------------------------
        */
        $firm->get('auditsystem/firms', 'FirmsController::viewfirms');
        $firm->post('auditsystem/firms/verify/(:any)', 'FirmsController::verifyfirm/$1');
    });
    
    $auth->group('', ['filter' => 'client'], function ($client) {

        $client->group('', ['filter' => 'client_cl'], function ($cl) {
            /**
                ----------------------------------------------------------
                CLIENT MANAGEMENT
                ----------------------------------------------------------
            */
            $cl->get('auditsystem/client', 'ClientController::viewclient');
            $cl->post('auditsystem/client/save', 'ClientController::addclient');
            $cl->get('auditsystem/client/edit/(:any)', 'ClientController::editclient/$1');
            $cl->post('auditsystem/client/update/(:any)', 'ClientController::updateclient/$1');
            $cl->post('auditsystem/client/acin/(:any)', 'ClientController::acin/$1');
        });
            
        $client->group('', ['filter' => 'client_sd'], function ($sd) {

            $sd->get('auditsystem/client/set', 'ClientController::viewclientset');
            $sd->get('auditsystem/client/files/(:any)/(:any)', 'ClientController::viewfiles/$1/$2');
            $sd->post('auditsystem/client/setfiles/(:any)', 'ClientController::setfiles/$1');
            $sd->get('auditsystem/client/defaultfiles/(:any)/', 'ClientController::getdefaultfiles/$1');
            $sd->get('auditsystem/client/getfiles/(:any)/(:any)', 'ClientController::getfiles/$1/$2');
            /**
            Client set default value AREA
            */
            $sd->get('auditsystem/chapter1/view/(:any)/(:any)', 'ChapterController::viewc1pdf/$1/$2');
            $sd->get('auditsystem/chapter2/view/(:any)/(:any)', 'ChapterController::viewc2pdf/$1/$2');
            $sd->get('auditsystem/chapter3/view/(:any)/(:any)', 'ChapterController::viewc3pdf/$1/$2');
            /**
                Setting values of chapter files
            */
            $sd->get('auditsystem/chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setvalues/$1/$2/$3/$4');
            $sd->get('auditsystem/chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setvalues/$1/$2/$3/$4');
            $sd->get('auditsystem/chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setvalues/$1/$2/$3/$4');
            /**
                Saving Values chapter 1
            */
            $sd->post('auditsystem/client/saveac1/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac1eqr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1eqr/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac2aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2aep/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac3/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac4ppr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4ppr/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac5/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac5/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac6ra/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6ra/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac6s12/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s12/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac6s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s3/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac7/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac7/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac8/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac8/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac9/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac9/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveac10cu/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10cu/$1/$2/$3/$4/$5');
            $sd->post('auditsystem/client/saveac10s1/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s1/$1/$2/$3/$4/$5');
            $sd->post('auditsystem/client/saveac10s2/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s2/$1/$2/$3/$4/$5');
            $sd->post('auditsystem/client/saveac10summ/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10summ/$1/$2/$3/$4/$5');
            $sd->post('auditsystem/client/saveac11/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac11/$1/$2/$3/$4');
            /**
                Saving Values chapter 2
            */
            $sd->post('auditsystem/client/savec2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savequestions/$1/$2/$3/$4');
            $sd->post('auditsystem/client/aicpppa/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaicpppa/$1/$2/$3/$4');
            $sd->post('auditsystem/client/rcicp/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savercicp/$1/$2/$3/$4');
            /**
                Saving Values chapter 3
            */
            $sd->post('auditsystem/client/saveplaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveplaf/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa1s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa1s3/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa2/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa3a/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3a/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa3afaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3afaf/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa3air/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3air/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa3b/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3b/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa3bp4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3bp4/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa7aepapp/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aepapp/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa7isa/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7isa/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa7aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aep/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa10/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa10/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa11ue/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11ue/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa11un/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11un/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa11con/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11con/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa11ad/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11ad/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa11uead/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11uead/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveab3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab3/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveab4a/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4a/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveab4checklist/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4checklist/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveab4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveab1/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab1/$1/$2/$3/$4');
            $sd->post('auditsystem/client/saveaa5b/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa5b/$1/$2/$3/$4');
        });
    });
    

    $auth->group('', ['filter' => 'manager'], function ($audm) {

        $audm->group('', ['filter' => 'auditor'], function ($audm) {
            /**
                ----------------------------------------------------------
                AUDITOR MANAGEMENT
                ----------------------------------------------------------
            */
            $audm->get('auditsystem/auditor', 'AuditorController::viewauditor');
            $audm->post('auditsystem/auditor/save', 'AuditorController::addauditor');
            $audm->get('auditsystem/auditor/edit/(:any)', 'AuditorController::editauditor/$1');
            $audm->post('auditsystem/auditor/update/(:any)', 'AuditorController::updateauditor/$1');
            $audm->post('auditsystem/auditor/acin/(:any)', 'AuditorController::acin/$1');
        });
    
    });
   
    $auth->group('', ['filter' => 'setting'], function ($setting) {

        $setting->group('', ['filter' => 'settinguser'], function ($user) {
            /**
                ----------------------------------------------------------
                USER MANAGEMENT
                ----------------------------------------------------------
            */
            $user->get('auditsystem/user', 'UserController::viewusers');
            $user->post('auditsystem/user/save', 'UserController::adduser');
            $user->get('auditsystem/user/edit/(:any)', 'UserController::edituser/$1');
            $user->post('auditsystem/user/update/(:any)', 'UserController::udpateuser/$1');
            $user->post('auditsystem/user/find', 'UserController::findfirm');
            $user->post('auditsystem/user/acin/(:any)', 'UserController::acin/$1');

        });

        $setting->group('', ['filter' => 'settingpos'], function ($pos) {
            /**
                ----------------------------------------------------------
                POSITION MANAGEMENT
                ----------------------------------------------------------
            */
            $pos->get('auditsystem/position', 'PositionController::viewposition');
            $pos->post('auditsystem/position/save', 'PositionController::addposition');
            $pos->get('auditsystem/position/edit/(:any)', 'PositionController::editposition/$1');
            $pos->post('auditsystem/position/update/(:any)', 'PositionController::updateposition/$1');
            $pos->post('auditsystem/position/acin/(:any)', 'PositionController::acin/$1');
        });

        $setting->group('', ['filter' => 'settinghat'], function ($hat) {
            /**
                ----------------------------------------------------------
                Admin Defaults AREA
                ----------------------------------------------------------
            */
            // CHAPTER 1 VIEWS
            $hat->get('auditsystem/c1/view', 'ChapterController::viewchapter1');
            $hat->get('auditsystem/c1/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter1/$1/$2/$3');
            // CHAPTER 1 AC1 hat
            $hat->post('auditsystem/c1/saveac1/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac1/$1/$2/$3');
            $hat->post('auditsystem/c1/saveac1eqr/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac1eqr/$1/$2/$3');
            $hat->post('auditsystem/c1/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::acin/$1/$2/$3/$4');
            //CHAPTER 1 AC2 hat
            $hat->post('auditsystem/c1/saveac2/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac2/$1/$2/$3');
            $hat->post('auditsystem/c1/saveac2aep/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac2aep/$1/$2/$3');
            //CHAPTER 1 AC3 hat
            $hat->post('auditsystem/c1/saveac3/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac3/$1/$2/$3');
            //CHAPTER 1 AC4 hat
            $hat->post('auditsystem/c1/saveac4ppr/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac4ppr/$1/$2/$3');
            $hat->post('auditsystem/c1/saveac4/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac4/$1/$2/$3');
            //CHAPTER 1 AC5 hat
            $hat->post('auditsystem/c1/saveac5/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac5/$1/$2/$3');
            //CHAPTER 1 AC6 hat
            $hat->post('auditsystem/c1/saveac6ra/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6ra/$1/$2/$3');
            $hat->post('auditsystem/c1/saveac6s12/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6s12/$1/$2/$3');
            $hat->post('auditsystem/c1/saveac6s3/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac6s3/$1/$2/$3');
            //CHAPTER 1 AC7 hat
            $hat->post('auditsystem/c1/saveac7/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac7/$1/$2/$3');
            //CHAPTER 1 AC8 hat
            $hat->post('auditsystem/c1/saveac8/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac8/$1/$2/$3');
            //CHAPTER 1 AC9 hat
            $hat->post('auditsystem/c1/saveac9/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac9/$1/$2/$3');
            //CHAPTER 1 AC10 hat
            $hat->post('auditsystem/c1/saveac10cu/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10cu/$1/$2/$3/$4');
            $hat->post('auditsystem/c1/saveac10s1/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10s1/$1/$2/$3/$4');
            $hat->post('auditsystem/c1/saveac10s2/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10s2/$1/$2/$3/$4');
            $hat->post('auditsystem/c1/saveac10summ/(:any)/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac10summ/$1/$2/$3/$4');
            //CHAPTER 1 AC11 hat
            $hat->post('auditsystem/c1/saveac11/(:any)/(:any)/(:any)', 'Chapter1Controller::saveac11/$1/$2/$3');
            // CHAPTER 2 VIEWS
            $hat->get('auditsystem/c2/view', 'ChapterController::viewchapter2');
            $hat->get('auditsystem/c2/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter2/$1/$2/$3');
            $hat->post('auditsystem/c2/manage/save/(:any)/(:any)/(:any)', 'Chapter2Controller::savequestions/$1/$2/$3');
            $hat->post('auditsystem/c2/manage/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter2Controller::acin/$1/$2/$3/$4');
            $hat->post('auditsystem/c2/aicpppa/save/(:any)/(:any)/(:any)', 'Chapter2Controller::saveaicpppa/$1/$2/$3');
            $hat->post('auditsystem/c2/rcicp/save/(:any)/(:any)/(:any)', 'Chapter2Controller::savercicp/$1/$2/$3');
            /**
                ----------------------------------------------------------
                CHAPTER 3 AREA
                ----------------------------------------------------------
            */
            // CHAPTER 3 VIEWS
            //aa1
            $hat->get('auditsystem/c3/view', 'ChapterController::viewchapter3');
            $hat->get('auditsystem/c3/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter3/$1/$2/$3');
            $hat->post('auditsystem/c3/saveplaf/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa1plaf/$1/$2/$3');
            $hat->post('auditsystem/c3/activeinactive/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::acin/$1/$2/$3/$4');
            $hat->post('auditsystem/c3/saves3/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa1s3/$1/$2/$3');
            //aa2   
            $hat->post('auditsystem/c3/saveaa2/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa2/$1/$2/$3');
            //aa3a
            $hat->post('auditsystem/c3/saveaa3a/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3a/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa3afaf/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3afaf/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa3air/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3air/$1/$2/$3');
            //aa3b
            $hat->post('auditsystem/c3/saveaa3b/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3b/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa3bp4/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa3bp4/$1/$2/$3');
            //aa5b
            $hat->post('auditsystem/c3/saveaa5b/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa5b/$1/$2/$3');
            //aa7
            $hat->post('auditsystem/c3/saveaa7aepapp/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7aepapp/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa7isa/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7isa/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa7aep/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa7aep/$1/$2/$3');
            //aa10
            $hat->post('auditsystem/c3/saveaa10/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa10/$1/$2/$3');
            //aa11
            $hat->get('auditsystem/c3/manageaa11/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::viewa11/$1/$2/$3/$4');
            $hat->post('auditsystem/c3/saveaa11un/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11un/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa11ad/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ad/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa11ue/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11ue/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa11con/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11con/$1/$2/$3');
            $hat->post('auditsystem/c3/saveaa11uead/(:any)/(:any)/(:any)', 'Chapter3Controller::saveaa11uead/$1/$2/$3');
            //ab1
            $hat->post('auditsystem/c3/saveab1/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab1/$1/$2/$3');
            //ab3
            $hat->post('auditsystem/c3/saveab3/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab3/$1/$2/$3');
            //ab4
            $hat->get('auditsystem/c3/manageab4/(:any)/(:any)/(:any)/(:any)', 'Chapter3Controller::viewab4/$1/$2/$3/$4');
            $hat->post('auditsystem/c3/saveab4/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4/$1/$2/$3');
            $hat->post('auditsystem/c3/saveab4checklist/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4checklist/$1/$2/$3');
            //ab4a
            $hat->post('auditsystem/c3/saveab4a/(:any)/(:any)/(:any)', 'Chapter3Controller::saveab4a/$1/$2/$3');
            /**
                ----------------------------------------------------------
                CHAPTER 4 AREA
                ----------------------------------------------------------
            */
            $hat->get('auditsystem/c4/view', 'ChapterController::viewchapter4');
            $hat->get('auditsystem/c4/manage/(:any)/(:any)/(:any)', 'ChapterController::managechapter4/$1/$2/$3');
            /**
                ----------------------------------------------------------
                CHAPTER 5 AREA
                ----------------------------------------------------------
            */
            $hat->get('auditsystem/c5/view', 'ChapterController::viewchapter5');
        });

    });


    
});
