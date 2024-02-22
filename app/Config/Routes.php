<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::homepage');
$routes->get('/login', 'Home::homepage');
$routes->get('/dashboard', 'DashController::dashboard');

