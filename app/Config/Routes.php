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
$routes->group('', ['filter' => 'auth'], function ($routes) {

    //route to dashboard
    $routes->get('/dashboard', 'Dashboard::main');
    $routes->get('/book-room', 'Dashboard::bookRoom');

    $routes->get('/dashboard/view/(:any)', 'Receipt::generate/$1');
    
    // Rooms
    $routes->get('/rooms', 'Room::view');
    $routes->get('/rooms/(:any)', 'Room::details/$1');

    // Bookings
    $routes->get('/booking/check/(:num)/(:any)', 'Booking::check/$1/$2');
    $routes->post('/booking/preview/(:any)', 'Booking::preview/$1');
    $routes->post('/booking/create/(:any)', 'Booking::create/$1');


    //profile
    $routes->get('/profile', 'Profile::view');       // Show profile
    $routes->post('/profile/edit', 'Profile::edit');
    $routes->get('/profile/edit', 'Profile::editForm');

    //receipt
    $routes->get('receipt/(:num)', 'Receipt::generate/$1');

    $routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], function ($routes) //admin route kat sini
    {
        //route for admin dashboard
        $routes->get('dashboard', 'AdminDashboard::view');
        $routes->get('dashboard/viewRoom', 'AdminDashboard::viewRoom');
        $routes->post('dashboard/announcement', 'AdminDashboard::announcement');
        $routes->get('dashboard/announcement', 'AdminDashboard::viewAnnouncement');

        //route to user management
        $routes->get('users', 'ManageUser::viewUsers');
        $routes->get('users/toggle-admin/(:any)', 'ManageUser::toggleAdmin/$1');
        $routes->get('users/delete/(:any)', 'ManageUser::deleteUser/$1');
        $routes->get('profile_view/(:any)', 'ManageUser::adminView/$1');


        //routes to booking management
        $routes->get('bookings', 'BookingDashboard::view');
        $routes->post('bookings/edit/(:any)', 'ManageBooking::updateStatus/$1');
        $routes->get('bookings/(:segment)', 'ManageBooking::view/$1'); // view pending/approved/rejected
        $routes->get('bookings/approved/summary/(:any)', 'ManageBooking::summary/$1');
        $routes->post('update/(:any)', 'ManageBooking::updateStatus/$1');
        $routes->get('rejected/delete/(:any)', 'ManageBooking::delete/$1');

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
