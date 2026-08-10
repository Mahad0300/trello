<?php
/**
 * Application Configuration
 * (Static UI Build - No Database Connection)
 */

// Define Base URL dynamically from current SCRIPT_NAME directory
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$scriptDir = str_replace('\\', '/', dirname($scriptName));
$baseUrl = ($scriptDir === '/' || $scriptDir === '.') ? '' : rtrim($scriptDir, '/');

define('BASE_URL', $baseUrl);
define('APP_NAME', 'Richmondtech');
define('APP_VERSION', '1.0.0');

// Paths
define('ROOT_PATH', dirname(__DIR__));
define('VIEWS_PATH', ROOT_PATH . '/views');
