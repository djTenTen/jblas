<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Auth;
use App\Filters\Client;
use App\Filters\Client_cl;
use App\Filters\Client_sd;
use App\Filters\Manager;
use App\Filters\Auditor;
use App\Filters\WorkPaper;
use App\Filters\WorkPaper_preparer;
use App\Filters\WorkPaper_reviewer;
use App\Filters\WorkPaper_audmanager;
use App\Filters\Firm;
use App\Filters\Setting;
use App\Filters\Setting_user;
use App\Filters\Setting_pos;
use App\Filters\Setting_hat;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => Auth::class,
        'client'        => Client::class,
        'client_cl'     => Client_cl::class,
        'client_sd'     => Client_sd::class,
        'manager'       => Manager::class,
        'auditor'       => Auditor::class,
        'workp'         => WorkPaper::class,
        'preparer'      => WorkPaper_preparer::class,
        'reviewer'      => WorkPaper_reviewer::class,
        'audmanager'    => WorkPaper_audmanager::class,
        'firm'          => Firm::class,
        'setting'       => Setting::class,
        'settinguser'   => Setting_user::class,
        'settingpos'   => Setting_pos::class,
        'settinghat'   => Setting_hat::class,
        
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
           
            // 'csrf',
            // 'invalidchars',
            
            
            
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
            'auth',
            'client',
            'client_cl',
            'client_sd',
            'manager',
            'auditor',
            'workp',
            'preparer',
            'reviewer',
            'audmanager',
            'firm',
            'setting',
            'settinguser',
            'settingpos',
            'settinghat',
            
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
