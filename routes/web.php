<?php
/**
 * Web Route Definitions
 * Maps route paths to thin controllers.
 */

// Authentication Routes
Router::get('login', 'AuthController@login');
Router::get('register', 'AuthController@register');

// Admin Routes
Router::get('admin/dashboard', 'AdminController@dashboard');
Router::get('admin/users', 'AdminController@users');
Router::get('admin/workspaces', 'AdminController@workspaces');
Router::get('admin/all-boards', 'AdminController@boards');
Router::get('admin/boards', 'AdminController@boards');
Router::get('admin/board-detail', 'AdminController@boardDetail');
Router::get('admin/board', 'AdminController@boardDetail');
Router::get('admin/notifications', 'AdminController@notifications');
Router::get('admin/activity-log', 'AdminController@activityLog');
Router::get('admin/profile', 'AdminController@profile');

// User Routes
Router::get('user/dashboard', 'UserController@dashboard');
Router::get('user/all-boards', 'UserController@allBoards');
Router::get('user/boards', 'UserController@allBoards');
Router::get('user/board-detail', 'UserController@boardDetail');
Router::get('user/board', 'UserController@boardDetail');
Router::get('user/profile', 'UserController@profile');
Router::get('user/notifications', 'UserController@notifications');
