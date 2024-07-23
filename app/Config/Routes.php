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
    $auth->get('', 'DashController::auditsystem');
    $auth->get('dashboard/wp/(:any)', 'DashController::getwpp/$1');
    $auth->get('dashboard/numwpp/(:any)', 'DashController::getnumwpp/$1');
    

    /**
        ----------------------------------------------------------
        ACCOUNT PROFILE MANAGEMENT
        ----------------------------------------------------------
    */
    $auth->get('myaccount', 'UserController::myaccount');
    $auth->post('myaccount/update/(:any)', 'UserController::updatemyinfo/$1');

    $auth->group('wp', ['filter' => 'workp'], function ($workp) {
        /**
            ----------------------------------------------------------
            WORK PAPER AREA
            ----------------------------------------------------------
        */
        $workp->group('', ['filter' => 'preparer'], function ($prep) {

            $prep->get('prepare', 'WorkpaperController::prepare');
            $prep->post('sendtoreview/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoreview/$1/$2/$3/$4/$5');
            $prep->post('sendtoreviewer/(:any)', 'WorkpaperController::sendtoreviewer/$1');
            
        });

        $workp->group('', ['filter' => 'reviewer'], function ($rev) {

            $rev->get('review', 'WorkpaperController::review');
            $rev->post('sendtoauditor/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoauditor/$1/$2/$3/$4/$5');
            $rev->post('sendtomanager/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtomanager/$1/$2/$3/$4/$5');
            $rev->post('sendtopreparer/(:any)', 'WorkpaperController::sendtopreparer/$1');
            $rev->post('sendtoapprover/(:any)', 'WorkpaperController::sendtoapprover/$1');

        });

        $workp->group('', ['filter' => 'audmanager'], function ($audmanager) {

            $audmanager->get('initiate', 'WorkpaperController::initiate');
            $audmanager->post('sendtoapprove/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::sendtoapprove/$1/$2/$3/$4/$5');
            $audmanager->post('save', 'WorkpaperController::saveworkpaper');
            $audmanager->post('sendbacktoreviewer/(:any)', 'WorkpaperController::sendbacktoreviewer/$1');
            $audmanager->post('approved/(:any)', 'WorkpaperController::approvewp/$1');
            $audmanager->get('approved', 'WorkpaperController::approved');
            $audmanager->get('generatepdf/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'ReportController::generatepdf/$1/$2/$3/$4/$5/$6/$7');
            

        });

        $workp->get('getfiles/(:any)/(:any)/(:any)', 'WorkpaperController::getfiles/$1/$2/$3');
        $workp->post('updateindex/(:any)', 'WorkpaperController::updateindex/$1');

        $workp->post('importtb/(:any)/(:any)/(:any)', 'WorkpaperController::importtb/$1/$2/$3');
        $workp->get('index/setvalues/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewindexfiles/$1/$2/$3/$4/$5/$6');
        $workp->post('index/tb/update/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::updatetb/$1/$2/$3/$4/$5/$6');
        $workp->post('index/tb/upload/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::uploadtbfiles/$1/$2/$3/$4/$5/$6');
        $workp->get('downloadexcel/(:any)', 'WorkpaperController::downloadexcel/$1');
        $workp->post('index/cfs/upload/(:any)/(:any)/(:any)', 'WorkpaperController::uploadcfsfiles/$1/$2/$3');
        /**
            PDF VIEW WORK PAPER
        */
        $workp->get('viewpdfc1/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc1/$1/$2/$3/$4');
        $workp->get('viewpdfc2/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc2/$1/$2/$3/$4');
        $workp->get('viewpdfc3/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::viewpdfc3/$1/$2/$3/$4');

        
        /**
            Setting values of chapter files
        */
        $workp->get('chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setworkpaper/$1/$2/$3/$4');
        $workp->get('chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setworkpaper/$1/$2/$3/$4');
        $workp->get('chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setworkpaper/$1/$2/$3/$4');
        /**
            Saving Values chapter 1
        */
        $workp->post('saveac1/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac1/$1/$2/$3/$4/$5');
        $workp->post('saveac1eqr/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac1eqr/$1/$2/$3/$4/$5');
        $workp->post('saveac2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac2/$1/$2/$3/$4/$5');
        $workp->post('saveac2aep/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac2aep/$1/$2/$3/$4/$5');
        $workp->post('saveac3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac3/$1/$2/$3/$4/$5');
        $workp->post('saveac4ppr/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac4ppr/$1/$2/$3/$4/$5');
        $workp->post('saveac4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac4/$1/$2/$3/$4/$5');
        $workp->post('saveac5/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac5/$1/$2/$3/$4/$5');
        $workp->post('saveac6ra/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6ra/$1/$2/$3/$4/$5');
        $workp->post('saveac6s12/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6s12/$1/$2/$3/$4/$5');
        $workp->post('saveac6s3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac6s3/$1/$2/$3/$4/$5');
        $workp->post('saveac7/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac7/$1/$2/$3/$4/$5');
        $workp->post('saveac8/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac8/$1/$2/$3/$4/$5');
        $workp->post('saveac9/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac9/$1/$2/$3/$4/$5');
        $workp->post('saveac10cu/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10cu/$1/$2/$3/$4/$5/$6');
        $workp->post('saveac10s1/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10s1/$1/$2/$3/$4/$5/$6');
        $workp->post('saveac10s2/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10s2/$1/$2/$3/$4/$5/$6');
        $workp->post('saveac10summ/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac10summ/$1/$2/$3/$4/$5/$6');
        $workp->post('saveac11/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveac11/$1/$2/$3/$4/$5');
        /**
            Saving Values chapter 2
        */
        $workp->post('savec2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::savequestions/$1/$2/$3/$4/$5');
        $workp->post('aicpppa/save/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaicpppa/$1/$2/$3/$4/$5');
        $workp->post('rcicp/save/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::savercicp/$1/$2/$3/$4/$5');
        /**
            Saving Values chapter 3
        */
        $workp->post('saveplaf/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveplaf/$1/$2/$3/$4/$5');
        $workp->post('saveaa1s3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa1s3/$1/$2/$3/$4/$5');
        $workp->post('saveaa2/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa2/$1/$2/$3/$4/$5');
        $workp->post('saveaa3a/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3a/$1/$2/$3/$4/$5');
        $workp->post('saveaa3afaf/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3afaf/$1/$2/$3/$4/$5');
        $workp->post('saveaa3air/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3air/$1/$2/$3/$4/$5');
        $workp->post('saveaa3b/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3b/$1/$2/$3/$4/$5');
        $workp->post('saveaa3bp4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa3bp4/$1/$2/$3/$4/$5');
        $workp->post('saveaa7aepapp/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7aepapp/$1/$2/$3/$4/$5');
        $workp->post('saveaa7isa/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7isa/$1/$2/$3/$4/$5');
        $workp->post('saveaa7aep/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa7aep/$1/$2/$3/$4/$5');
        $workp->post('saveaa10/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa10/$1/$2/$3/$4/$5');
        $workp->post('saveaa11ue/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11ue/$1/$2/$3/$4/$5');
        $workp->post('saveaa11un/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11un/$1/$2/$3/$4/$5');
        $workp->post('saveaa11con/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11con/$1/$2/$3/$4/$5');
        $workp->post('saveaa11ad/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11ad/$1/$2/$3/$4/$5');
        $workp->post('saveaa11uead/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa11uead/$1/$2/$3/$4/$5');
        $workp->post('saveab3/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab3/$1/$2/$3/$4/$5');
        $workp->post('saveab4a/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4a/$1/$2/$3/$4/$5');
        $workp->post('saveab4checklist/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4checklist/$1/$2/$3/$4/$5');
        $workp->post('saveab4/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab4/$1/$2/$3/$4/$5');
        $workp->post('saveab1/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveab1/$1/$2/$3/$4/$5');
        $workp->post('saveaa5b/(:any)/(:any)/(:any)/(:any)/(:any)', 'WorkpaperController::saveaa5b/$1/$2/$3/$4/$5');
        
    });
    
    $auth->group('', ['filter' => 'client'], function ($client) {

        $client->group('', ['filter' => 'client_cl'], function ($cl) {
            /**
                ----------------------------------------------------------
                CLIENT MANAGEMENT
                ----------------------------------------------------------
            */
            $cl->get('client', 'ClientController::viewclient');
            $cl->post('client/save', 'ClientController::addclient');
            $cl->get('client/edit/(:any)', 'ClientController::editclient/$1');
            $cl->post('client/update/(:any)', 'ClientController::updateclient/$1');
            $cl->post('client/acin/(:any)', 'ClientController::acin/$1');
        });
            
        $client->group('', ['filter' => 'client_sd'], function ($sd) {

            $sd->get('client/set', 'ClientController::viewclientset');
            $sd->get('client/files/(:any)/(:any)', 'ClientController::viewfiles/$1/$2');
            $sd->post('client/setfiles/(:any)/(:any)', 'ClientController::setfiles/$1/$2');
            $sd->post('client/removefiles/(:any)/(:any)', 'ClientController::removefiles/$1/$2');
            $sd->get('client/defaultfiles/(:any)/', 'ClientController::getdefaultfiles/$1');
            $sd->get('client/getfiles/(:any)/(:any)', 'ClientController::getfiles/$1/$2');
            /**
            Client set default value AREA
            */
            $sd->get('chapter1/view/(:any)/(:any)', 'ChapterController::viewc1pdf/$1/$2');
            $sd->get('chapter2/view/(:any)/(:any)', 'ChapterController::viewc2pdf/$1/$2');
            $sd->get('chapter3/view/(:any)/(:any)', 'ChapterController::viewc3pdf/$1/$2');
            /**
                Setting values of chapter files
            */
            $sd->get('chapter1/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c1setvalues/$1/$2/$3/$4');
            $sd->get('chapter2/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c2setvalues/$1/$2/$3/$4');
            $sd->get('chapter3/setvalues/(:any)/(:any)/(:any)/(:any)', 'ChapterController::c3setvalues/$1/$2/$3/$4');
            /**
                Saving Values chapter 1
            */
            $sd->post('saveac1/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1/$1/$2/$3/$4');
            $sd->post('saveac1eqr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac1eqr/$1/$2/$3/$4');
            $sd->post('saveac2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2/$1/$2/$3/$4');
            $sd->post('saveac2aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac2aep/$1/$2/$3/$4');
            $sd->post('saveac3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac3/$1/$2/$3/$4');
            $sd->post('saveac4ppr/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4ppr/$1/$2/$3/$4');
            $sd->post('saveac4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac4/$1/$2/$3/$4');
            $sd->post('saveac5/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac5/$1/$2/$3/$4');
            $sd->post('saveac6ra/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6ra/$1/$2/$3/$4');
            $sd->post('saveac6s12/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s12/$1/$2/$3/$4');
            $sd->post('saveac6s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac6s3/$1/$2/$3/$4');
            $sd->post('saveac7/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac7/$1/$2/$3/$4');
            $sd->post('saveac8/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac8/$1/$2/$3/$4');
            $sd->post('saveac9/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac9/$1/$2/$3/$4');
            $sd->post('saveac10cu/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10cu/$1/$2/$3/$4/$5');
            $sd->post('saveac10s1/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s1/$1/$2/$3/$4/$5');
            $sd->post('saveac10s2/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10s2/$1/$2/$3/$4/$5');
            $sd->post('saveac10summ/(:any)/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac10summ/$1/$2/$3/$4/$5');
            $sd->post('saveac11/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveac11/$1/$2/$3/$4');
            /**
                Saving Values chapter 2
            */
            $sd->post('savec2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savequestions/$1/$2/$3/$4');
            $sd->post('aicpppa/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaicpppa/$1/$2/$3/$4');
            $sd->post('rcicp/save/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::savercicp/$1/$2/$3/$4');
            /**
                Saving Values chapter 3
            */
            $sd->post('saveplaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveplaf/$1/$2/$3/$4');
            $sd->post('saveaa1s3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa1s3/$1/$2/$3/$4');
            $sd->post('saveaa2/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa2/$1/$2/$3/$4');
            $sd->post('saveaa3a/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3a/$1/$2/$3/$4');
            $sd->post('saveaa3afaf/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3afaf/$1/$2/$3/$4');
            $sd->post('saveaa3air/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3air/$1/$2/$3/$4');
            $sd->post('saveaa3b/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3b/$1/$2/$3/$4');
            $sd->post('saveaa3bp4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa3bp4/$1/$2/$3/$4');
            $sd->post('saveaa7aepapp/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aepapp/$1/$2/$3/$4');
            $sd->post('saveaa7isa/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7isa/$1/$2/$3/$4');
            $sd->post('saveaa7aep/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa7aep/$1/$2/$3/$4');
            $sd->post('saveaa10/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa10/$1/$2/$3/$4');
            $sd->post('saveaa11ue/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11ue/$1/$2/$3/$4');
            $sd->post('saveaa11un/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11un/$1/$2/$3/$4');
            $sd->post('saveaa11con/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11con/$1/$2/$3/$4');
            $sd->post('saveaa11ad/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11ad/$1/$2/$3/$4');
            $sd->post('saveaa11uead/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa11uead/$1/$2/$3/$4');
            $sd->post('saveab3/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab3/$1/$2/$3/$4');
            $sd->post('saveab4a/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4a/$1/$2/$3/$4');
            $sd->post('saveab4checklist/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4checklist/$1/$2/$3/$4');
            $sd->post('saveab4/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab4/$1/$2/$3/$4');
            $sd->post('saveab1/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveab1/$1/$2/$3/$4');
            $sd->post('saveaa5b/(:any)/(:any)/(:any)/(:any)', 'ChapterValuesController::saveaa5b/$1/$2/$3/$4');
        });
    });
    

    $auth->group('', ['filter' => 'manager'], function ($audm) {

        $audm->group('', ['filter' => 'auditor'], function ($audm) {
            /**
                ----------------------------------------------------------
                AUDITOR MANAGEMENT
                ----------------------------------------------------------
            */
            $audm->get('auditor', 'AuditorController::viewauditor');
            $audm->post('auditor/save', 'AuditorController::addauditor');
            $audm->get('auditor/edit/(:any)', 'AuditorController::editauditor/$1');
            $audm->post('auditor/update/(:any)', 'AuditorController::updateauditor/$1');
            $audm->post('auditor/acin/(:any)', 'AuditorController::acin/$1');
        });
    
    });

    
});
