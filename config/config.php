<?php
/**
 * Application Configuration
 * (Static UI Build - No Database Connection)
 */

// Define Base URL dynamically or default to relative path
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($scriptDir, '/');

define('BASE_URL', $baseUrl !== '' ? $baseUrl : '/trello/public');
define('APP_NAME', 'Trello SaaS');
define('APP_VERSION', '1.0.0');

// Paths
define('ROOT_PATH', dirname(__DIR__));
define('VIEWS_PATH', ROOT_PATH . '/views');
