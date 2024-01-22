<?php

namespace App\Routes;

use Config\Services;

$routes = Services::routes();

// cigburger bo routes

// Main
$routes->get('/', 'Main::index');

// login || logout
$routes->get('/auth/login', 'Auth::index');
$routes->get('/auth/login-submit', 'Auth::loginSubmit');
$routes->get('/auth/logout', 'Auth::logout');
