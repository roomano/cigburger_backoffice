<?php

namespace App\Routes;

use Config\Services;

$routes = Services::routes();

// cigburger bo routes

// Main
$routes->get('/', 'Main::index');

// ========== AUTH
$routes->get('/auth/login', 'Auth::index');
$routes->post('/auth/login-submit', 'Auth::loginSubmit');
$routes->get('/auth/logout', 'Auth::logout');


// ========== PRODUCT
$routes->get('/products', 'Products::index');
$routes->get('/products/new', 'Products::newProduct');
$routes->post('/products/new-submit', 'Products::newSubmit');

// ========== edit product
$routes->get('/products/edit/(:alphanum)', 'Products::edit/$1');
$routes->post('/products/edit-submit', 'Products::editSubmit');

// ========== delete product
$routes->get('/products/delete/(:alphanum)', 'Products::delete/$1');
$routes->get('/products/delete-submit/(:alphanum)', 'Products::getDeleteConfrim/$1');
$routes->delete('/products/delete-submit/(:alphanum)', 'Products::deleteConfrim/$1');

// ========== STOCKS
$routes->get('/stock', 'Stock::index');
$routes->get('/stock/product/(:alphanum)', 'Stock::productStock/$1');
