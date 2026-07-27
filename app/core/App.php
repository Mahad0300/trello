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

        // Strip /trello/public or /trello from beginning
        $requestUri = preg_replace('#^/trello/public/?#i', '/', $requestUri);
        $requestUri = preg_replace('#^/trello/?#i', '/', $requestUri);
        $requestUri = preg_replace('#^/index\.php/?#i', '/', $requestUri);

        return filter_var(trim($requestUri, '/'), FILTER_SANITIZE_URL);
    }
}
