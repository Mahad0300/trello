<?php

class Controller {
    /**
     * Load view file from /views directory outside app/
     * 
     * @param string $view e.g. 'admin/dashboard' or 'user/board'
     * @param array $data Data array passed to view
     */
    public function view($view, $data = []) {
        // Extract data into variables for view context
        extract($data);
        
        $file = VIEWS_PATH . '/' . $view . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        } else {
            die("View file [views/{$view}.php] not found.");
        }
    }
}
