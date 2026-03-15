<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Users::index');
$routes->get('/moodboardPage', 'Users::moodboard');
$routes->get('/roadmapPage', 'Users::roadmap');

$routes->get('/loginPage', 'Auth::showLogin');
$routes->get('/signupPage', 'Auth::showSignup');

$routes->post('/loginPage', 'Auth::login');
$routes->post('/signupPage', 'Auth::signup');
$routes->post('/logout', 'Auth::logout');

// Shop Page
$routes->get('/shop', 'Stock::shop');
$routes->get('/checkout', 'Users::checkout');
$routes->post('/submitRequest', 'Request::submit');

// CART
$routes->get('/cart', 'Users::cart');
$routes->post('/cart/add', 'Cart::add');
$routes->post('/cart/updateQuantity/(:num)', 'Cart::updateQuantity/$1');
$routes->get('/cart/remove/(:num)', 'Cart::remove/$1');

// CHECKOUT
$routes->post('/checkout/placeOrder', 'Users::placeOrder');

// -----------------------
// ADMIN ROUTES
// -----------------------
$routes->get('/admin/adminDashboard', 'Admin::showDashboard');
$routes->get('/admin/stockPage', 'Admin::stockPage');
$routes->get('/admin/requestPage', 'Admin::requestPage');
$routes->get('/admin/accountsPage', 'Admin::accountsPage');

// ⭐ Request status update
$routes->post('/admin/requests/updateStatus/(:num)', 'Admin::updateRequestStatus/$1');

// ⭐Accounts Management
$routes->post('/admin/accounts/create', 'UserCRUDtest\UserCreate::createAccount');
$routes->post('/admin/accounts/update/(:num)', 'Admin::updateAccount/$1');
$routes->post('/admin/accounts/delete/(:num)', 'UserCRUDtest\UserDelete::delete/$1');

// Stocks Management
$routes->post('/admin/stocks/create', 'StockCRUDtest\StockCreate::create');
$routes->post('/admin/stocks/update/(:num)', 'StockCRUDtest\StockUpdate::update/$1');
$routes->post('/admin/stocks/delete/(:num)', 'StockCRUDtest\StockDelete::delete/$1');
