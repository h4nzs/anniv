<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::landing');
$routes->get('/anniv', 'AnniversaryController::index');
$routes->get('slide/(:num)', 'AnniversaryController::slide/$1');
$routes->get('/anniv-key', 'AnnivGate::index');
$routes->post('/anniv-key/check', 'AnnivGate::check');
$routes->get('/movies', 'MovieController::index');
$routes->post('/movies/search', 'MovieController::search');
$routes->get('/admin', 'Admin::index', ['filter' => 'adminGuard']);
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');
$routes->get('users', 'Admin::userList', ['filter' => 'authGuard']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);
$routes->get('/create', 'Admin::create', ['filter' => 'adminGuard']);
$routes->post('/store', 'Admin::store', ['filter' => 'adminGuard']);
$routes->get('/posts', 'PostController::index');
$routes->get('posts/create', 'PostController::create', ['filter' => 'authGuard']);    // Tampilkan form
$routes->post('posts/create', 'PostController::create', ['filter' => 'authGuard']);     // Proses form
$routes->post('/posts/store', 'PostController::store', ['filter' => 'authGuard']);
$routes->post('posts/comment/(:num)', 'PostController::addComment/$1', ['filter' => 'authGuard']);
$routes->post('/comments/store', 'CommentController::store', ['filter' => 'authGuard']);
$routes->get('posts/edit/(:num)', 'PostController::edit/$1');
$routes->post('posts/update/(:num)', 'PostController::update/$1');
$routes->post('posts/delete/(:num)', 'PostController::delete/$1');
$routes->get('admin/posts', 'Admin::posts', ['filter' => 'adminGuard']);
$routes->get('/profile', 'ProfileController::index', ['filter' => 'authGuard']);
$routes->get('/profile/edit', 'ProfileController::edit', ['filter' => 'authGuard']);
$routes->post('/profile/update', 'ProfileController::update', ['filter' => 'authGuard']);
$routes->get('admin/posts/create', 'AdminPostController::create', ['filter' => 'adminGuard']);
$routes->post('admin/posts/create', 'AdminPostController::create', ['filter' => 'adminGuard']);
$routes->post('admin/posts/store', 'AdminPostController::store', ['filter' => 'adminGuard']);
$routes->get('admin/posts/edit/(:num)', 'AdminPostController::edit/$1', ['filter' => 'adminGuard']);
$routes->post('admin/posts/update/(:num)', 'AdminPostController::update/$1', ['filter' => 'adminGuard']);
$routes->post('admin/posts/delete/(:num)', 'AdminPostController::delete/$1');
$routes->post('admin/posts/comment/(:num)', 'AdminPostController::addComment/$1');
$routes->group('admin', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('edit/(:num)', 'Admin::edit/$1', ['filter' => 'adminGuard']);
    $routes->post('update/(:num)', 'Admin::update/$1', ['filter' => 'adminGuard']);
    $routes->get('delete/(:num)', 'Admin::deleteUser/$1', ['filter' => 'adminGuard']);
    $routes->get('reset-password/(:num)', 'Admin::resetPassword/$1', ['filter' => 'adminGuard']);

});


