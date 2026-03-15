<?php

use CodeIgniter\Router\RouteCollection;

/**@var RouteCollection $routes*/
$routes->get('/', 'Users::index');
$routes->get('/moodboardPage', 'Users::moodboard');
$routes->get('/roadmapPage', 'Users::roadmap');

$routes->get('/loginPage', 'Auth::showLogin');
$routes->get('/signupPage', 'Auth::showSignup');

$routes->post('/loginPage', 'Auth::login');
$routes->post('/signupPage', 'Auth::signup');
$routes->post('/logout', 'Auth::logout');

// Shop Page (Require Login)
$routes->get('/shop', 'Users::shop');

// Admin dashboard
$routes->get('/admin/adminDashboard', 'Admin::showDashboard');
$routes->get('/admin/stockPage', 'Admin::stockPage');
$routes->get('/admin/requestPage', 'Admin::requestPage');
$routes->get('/admin/accountsPage', 'Admin::accountsPage');

// ⭐Accounts Management
$routes->post('/admin/accounts/create', 'UserCRUDtest\UserCreate::createAccount');
$routes->post('/admin/accounts/update/(:num)', 'Admin::updateAccount/$1');
$routes->post('/admin/accounts/delete/(:num)', 'UserCRUDtest\UserDelete::delete/$1');
