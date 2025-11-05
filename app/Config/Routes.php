<?php

use App\Controllers\Admin\ManageRoom;
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
$routes->group('', ['filter' => 'auth'], function ($routes) {

    //route to dashboard
    $routes->get('/dashboard', 'Dashboard::main');
    $routes->get('/book-room', 'Dashboard::bookRoom');

    // Rooms
    $routes->get('/rooms', 'Room::view');
    $routes->get('/rooms/(:num)', 'Room::details/$1');

    // Booking actions
    $routes->get('/booking/check/(:num)/(:any)', 'Booking::check/$1/$2');
    $routes->post('/booking/create/(:num)', 'Booking::create/$1');

    $routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], function ($routes) //admin route kat sini
    {
        //route for admin dashboard
        $routes->get('dashboard', 'AdminDashboard::view');
        $routes->get('dashboard/viewRoom', 'AdminDashboard::viewRoom');
        $routes->post('dashboard/announcement', 'AdminDashboard::announcement');

        //route to user management
        $routes->get('users', 'ManageUser::viewUsers');
        $routes->get('users/toggle-admin/(:num)', 'ManageUser::toggleAdmin/$1');
        $routes->get('users/delete/(:num)', 'ManageUser::deleteUser/$1');

        //routes to booking management
        $routes->get('bookings', 'BookingDashboard::view');
        $routes->post('bookings/edit/(:any)', 'ManageBooking::updateStatus/$1');
        $routes->get('bookings/(:segment)', 'ManageBooking::view/$1'); // view pending/approved/rejected
        $routes->post('update/(:any)', 'ManageBooking::updateStatus/$1');
        $routes->get('delete/(:any)', 'ManageBooking::delete/$1');

        //route to room management
        $routes->get('rooms/view', 'ManageRoom::view');
        $routes->get('rooms/create', 'ManageRoom::createView');
        $routes->post('rooms/create', 'ManageRoom::create');
        $routes->get('rooms/edit/(:any)', 'ManageRoom::editView/$1');
        $routes->post('rooms/edit/(:any)', 'ManageRoom::edit/$1');

        $routes->get('rooms/delete/(:any)', 'ManageRoom::delete/$1');
        $routes->post('rooms/delete/(:any)', 'ManageRoom::delete/$1');
    });
});
