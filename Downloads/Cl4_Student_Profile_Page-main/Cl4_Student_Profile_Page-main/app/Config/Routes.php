<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Public routes (no auth required) ─────────────────────────
$routes->get('/',         'AuthController::login');
$routes->get('/login',    'AuthController::login');
$routes->post('/login',   'AuthController::loginPost');
$routes->get('/logout',   'AuthController::logout');
$routes->get('/unauthorized', 'AuthController::unauthorized');

// ── Student routes — must be logged in AND have role=student ──
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('/student/dashboard',  'StudentController::dashboard');
    $routes->get('/profile',            'ProfileController::show');
    $routes->get('/profile/edit',       'ProfileController::edit');
    $routes->post('/profile/update',    'ProfileController::update');
});

// ── Teacher routes — teacher AND admin can access ─────────────
$routes->group('', ['filter' => ['auth', 'teacher']], function ($routes) {
    $routes->get('/dashboard',              'DashboardController::index');
    $routes->get('/students',               'StudentManagementController::index');
    $routes->get('/students/show/(:num)',   'StudentManagementController::show/$1');
});

// ── Admin routes — admin only ─────────────────────────────────
$routes->group('admin', ['filter' => ['auth', 'admin']], function ($routes) {
    $routes->get('roles',                      'Admin\RoleController::index');
    $routes->get('roles/create',               'Admin\RoleController::create');
    $routes->post('roles/store',               'Admin\RoleController::store');
    $routes->get('roles/edit/(:num)',          'Admin\RoleController::edit/$1');
    $routes->post('roles/update/(:num)',       'Admin\RoleController::update/$1');
    $routes->get('roles/delete/(:num)',        'Admin\RoleController::delete/$1');
    $routes->get('users',                      'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)',  'Admin\UserAdminController::assignRole/$1');
    $routes->get('register',                   'AuthController::register');
    $routes->post('register',                  'AuthController::registerPost');
});

// ── API v1 — token-authenticated JSON endpoints ───────────────
// POST /api/v1/auth/token  → issue token (public)
$routes->post('api/v1/auth/token', 'Api\AuthController::issueToken');

// Protected API routes (require Bearer token)
$routes->group('api/v1', ['filter' => 'api_auth'], function ($routes) {
    $routes->delete('auth/token',       'Api\AuthController::revokeToken');
    $routes->get('students',            'Api\StudentsController::index');
    $routes->get('students/(:num)',     'Api\StudentsController::show/$1');
});
