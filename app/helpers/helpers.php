<?php
/**
 * Global Helper Functions
 */

if (!function_exists('base_url')) {
    function base_url($path = '') {
        $path = ltrim($path, '/');
        return BASE_URL . ($path !== '' ? '/' . $path : '');
    }
}

if (!function_exists('asset')) {
    function asset($path) {
        return base_url('assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('route')) {
    function route($path) {
        return base_url(ltrim($path, '/'));
    }
}

if (!function_exists('sanitize')) {
    function sanitize($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
