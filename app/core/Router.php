<?php

class Router {
    private static $routes = [];

    public static function get($uri, $action) {
        self::$routes['GET'][trim($uri, '/')] = $action;
    }

    public static function post($uri, $action) {
        self::$routes['POST'][trim($uri, '/')] = $action;
    }

    public static function dispatch($uri, $method = 'GET') {
        $uri = trim($uri, '/');
        
        // Default route redirect to login if empty
        if ($uri === '') {
            $uri = 'login';
        }

        if (isset(self::$routes[$method][$uri])) {
            $action = self::$routes[$method][$uri];
            
            if (is_callable($action)) {
                call_user_func($action);
                return;
            }

            if (is_string($action)) {
                $parts = explode('@', $action);
                $controllerName = $parts[0];
                $methodName = $parts[1] ?? 'index';

                $controllerFile = ROOT_PATH . '/app/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerName();
                    if (method_exists($controller, $methodName)) {
                        $controller->$methodName();
                        return;
                    }
                }
            }
        }

        // 404 Not Found fallback page
        http_response_code(404);
        echo "<div style='font-family: sans-serif; text-align: center; padding: 50px;'>";
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The requested route <code>/" . htmlspecialchars($uri) . "</code> does not exist.</p>";
        echo "<a href='" . base_url('user/dashboard') . "'>Return to Dashboard</a>";
        echo "</div>";
    }
}
