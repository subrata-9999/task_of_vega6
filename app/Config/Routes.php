<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'AuthController::go_to_register');
$routes->post('/register', 'AuthController::register');
$routes->get('/login', 'AuthController::go_to_login');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/profile', 'DashboardController::profile');
$routes->post('/profile/update', 'AuthController::update');
$routes->get('/search', 'DashboardController::go_to_search');