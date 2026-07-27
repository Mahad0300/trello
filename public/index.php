<?php
/**
 * Single Entry Point
 * Trello SaaS UI Only Project
 */

// Load Configuration
require_once __DIR__ . '/../config/config.php';

// Load Core MVC Classes & Helpers
require_once ROOT_PATH . '/app/helpers/helpers.php';
require_once ROOT_PATH . '/app/core/Controller.php';
require_once ROOT_PATH . '/app/core/Router.php';
require_once ROOT_PATH . '/app/core/App.php';
require_once ROOT_PATH . '/app/middleware/AuthMiddleware.php';

// Load Web Routes
require_once ROOT_PATH . '/routes/web.php';

// Initialize Application
$app = new App();
