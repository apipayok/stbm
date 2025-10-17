<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//auth - register/login route
$routes->get('/register', 'Auth::viewRegister');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::viewLogin');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

//route to dashboard
$routes->get('/dashboard', 'Dashboard::viewDashboard');
$routes->get('/book-room', 'Dashboard::bookRoom');

// Rooms
$routes->get('/rooms', 'Room::view');               // Show all room cards
$routes->get('/rooms/(:num)', 'Room::details/$1'); // Show room details with slots

// Booking actions
$routes->get('/booking/check/(:num)/(:any)', 'Booking::check/$1/$2'); // Book a slot

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) //admin route kat sini
{
//route to room management
$routes->get('rooms', 'ManageRoom::viewRoom');
$routes->get('rooms/create', 'ManageRoom::create'); 
$routes->post('rooms/store', 'ManageRoom::store');  
$routes->get('rooms/edit/(:num)', 'ManageRoom::edit/$1');  
$routes->post('rooms/update/(:num)', 'ManageRoom::update/$1'); 
$routes->get('rooms/delete/(:num)', 'ManageRoom::delete/$1'); 
});

