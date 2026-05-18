<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index');

// Frontend Routes
$routes->get('/questions', 'QuestionController::index');

// Admin Routes - Exams
$routes->group('admin/exams', ['filter' => ['csrf','auth']], function (RouteCollection $routes) {
    $routes->get('/', 'Admin\ExamController::index');
    $routes->get('create', 'Admin\ExamController::create');
    $routes->post('store', 'Admin\ExamController::store');
    $routes->get('edit/(:num)', 'Admin\ExamController::edit/$1');
    $routes->post('update/(:num)', 'Admin\ExamController::update/$1');
    $routes->get('delete/(:num)', 'Admin\ExamController::delete/$1');
    $routes->get('toggle-status/(:num)', 'Admin\ExamController::toggleStatus/$1');
});

// Admin Routes - Subjects
$routes->group('admin/subjects', ['filter' => ['csrf','auth'] ], function($routes) {
    $routes->get('/', 'Admin\SubjectController::index');
    $routes->get('create', 'Admin\SubjectController::create');
    $routes->post('store', 'Admin\SubjectController::store');
    $routes->get('edit/(:num)', 'Admin\SubjectController::edit/$1');
    $routes->post('update/(:num)', 'Admin\SubjectController::update/$1');
    $routes->get('delete/(:num)', 'Admin\SubjectController::delete/$1');
    $routes->get('get-by-exam', 'Admin\SubjectController::getByExam');
});

// Admin Routes - Topics
$routes->group('admin/topics', ['filter' => ['csrf','auth'] ], function($routes) {
    $routes->get('/', 'Admin\TopicController::index');
    $routes->get('create', 'Admin\TopicController::create');
    $routes->post('store', 'Admin\TopicController::store');
    $routes->get('edit/(:num)', 'Admin\TopicController::edit/$1');
    $routes->post('update/(:num)', 'Admin\TopicController::update/$1');
    $routes->get('delete/(:num)', 'Admin\TopicController::delete/$1');
    $routes->get('get-by-subject', 'Admin\TopicController::getBySubject');
});

// Admin Routes - Questions
$routes->group('admin/questions', ['filter' => ['csrf','auth'] ], function($routes) {
    $routes->get('/', 'Admin\QuestionController::index');
    $routes->get('create', 'Admin\QuestionController::create');
    $routes->post('store', 'Admin\QuestionController::store');
    $routes->get('edit/(:num)', 'Admin\QuestionController::edit/$1');
    $routes->post('update/(:num)', 'Admin\QuestionController::update/$1');
    $routes->get('delete/(:num)', 'Admin\QuestionController::delete/$1');
});


// Login

    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::loginPost');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::registerPost');
    $routes->get('logout', 'AuthController::logout');


// Notification
$routes->get('/notifications/get', 'NotificationController::get');
$routes->get('/notifications/seen/(:num)', 'NotificationController::seen/$1');
$routes->get('/notifications/read/(:num)', 'NotificationController::read/$1');
$routes->get('/notifications/create', 'NotificationController::create');

// Scraper Route from examveda
$routes->get('/scrape', 'Scraper::index');
$routes->get('/book', 'Scraper::book');
$routes->get('book/(:any)', 'Scraper::book/$1');