<?php

class App {
    public function __construct() {
        $uri = $this->parseUrl();
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        Router::dispatch($uri, $method);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
        }

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Remove query string
        if (false !== ($pos = strpos($requestUri, '?'))) {
            $requestUri = substr($requestUri, 0, $pos);
        }

        // Dynamically strip script directory and root project folder name
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        $rootDir = str_replace('\\', '/', dirname($scriptDir));

        if ($scriptDir !== '/' && $scriptDir !== '.') {
            $requestUri = preg_replace('#^' . preg_quote($scriptDir, '#') . '/?#i', '/', $requestUri);
        }
        if ($rootDir !== '/' && $rootDir !== '.') {
            $requestUri = preg_replace('#^' . preg_quote($rootDir, '#') . '/?#i', '/', $requestUri);
        }
        $requestUri = preg_replace('#^/index\.php/?#i', '/', $requestUri);

        return filter_var(trim($requestUri, '/'), FILTER_SANITIZE_URL);
    }
}
