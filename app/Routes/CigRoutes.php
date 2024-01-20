<?php

namespace App\Routes;

use Config\Services;

$routes = Services::routes();

// cigburger bo routes
$routes->get('/', 'Auth::index');
