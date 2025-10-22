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

//protect session
$routes->group('', ['filter' => 'auth'], function($routes) {

//route to dashboard
$routes->get('/dashboard', 'Dashboard::main');
$routes->get('/book-room', 'Dashboard::bookRoom');

// Rooms
$routes->get('/rooms', 'Room::view');               
$routes->get('/rooms/(:num)', 'Room::details/$1'); 

// Booking actions
$routes->get('/booking/check/(:num)/(:any)', 'Booking::check/$1/$2');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], function($routes) //admin route kat sini
{
//route to user management
$routes->get('users', 'ManageUser::viewUsers');
$routes->get('users/toggle-admin/(:num)', 'ManageUser::toggleAdmin/$1');
$routes->get('users/delete/(:num)', 'ManageUser::deleteUser/$1');

//route to room management
$routes->get('rooms', 'ManageRoom::viewRoom');
$routes->get('rooms/create', 'ManageRoom::create'); 
$routes->post('rooms/store', 'ManageRoom::store');  
$routes->get('rooms/edit/(:num)', 'ManageRoom::edit/$1');  
$routes->post('rooms/update/(:num)', 'ManageRoom::update/$1'); 
$routes->get('rooms/delete/(:num)', 'ManageRoom::delete/$1'); 
});

});