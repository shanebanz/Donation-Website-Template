<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login','Auth::index');
$routes->post('/login','Auth::login');

$routes->get('/dashboard','Dashboard::index');

$routes->get('/campaigns','Campaign::index');
$routes->get('/campaign/(:num)','Campaign::view/$1');

$routes->get('/donate/(:num)','Donation::index/$1');
$routes->post('/donate/save','Donation::save');

$routes->get('/admin','Admin::index');
$routes->get('/admin/donations','Admin::donations');

$routes->get('/admin/campaigns','Admin::campaigns');
$routes->get('/admin/campaign/create','Admin::createCampaign');
$routes->post('/admin/campaign/store','Admin::storeCampaign');

$routes->get('/admin/approve/(:num)','Admin::approve/$1');
$routes->get('/admin/reject/(:num)','Admin::reject/$1');

$routes->get('/logout','Auth::logout');

$routes->get('/admin/campaign/edit/(:num)','Admin::editCampaign/$1');
$routes->post('/admin/campaign/update/(:num)','Admin::updateCampaign/$1');
$routes->get('/admin/campaign/delete/(:num)','Admin::deleteCampaign/$1');