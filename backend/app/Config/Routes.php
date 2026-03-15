<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Users::index');
$routes->get('/moodboardPage', 'Users::moodboard');
$routes->get('/roadmapPage', 'Users::roadmap');

$routes->get('/loginPage', 'Auth::showLogin');
$routes->get('/signupPage', 'Auth::showSignup');

$routes->post('/loginPage', 'Auth::login');
$routes->post('/signupPage', 'Auth::signup');
$routes->post('/logout', 'Auth::logout');

// **Shop page route — only accessible for logged-in users**
$routes->get('/shop', 'Users::shop');

// Admin dashboard
$routes->get('/admin/adminDashboard', 'Admin::showDashboard');
$routes->get('/admin/stockPage', 'Admin::stockPage');
$routes->get('/admin/requestPage', 'Admin::requestPage');
$routes->get('/admin/accountsPage', 'Admin::accountsPage');
