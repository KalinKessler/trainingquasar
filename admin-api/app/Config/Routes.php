<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin/update/(:segment)', 'Admin\Home::detailUpdate/$1');

$routes->post('/admin/insert', 'Admin\Home::insert');
$routes->get('/admin/getdata', 'Admin\Home::index');
$routes->delete('/admin/delete/(:segment)', 'Admin\Home::delete/$1');
$routes->put('/admin/update/(:segment)', 'Admin\Home::update/$1');