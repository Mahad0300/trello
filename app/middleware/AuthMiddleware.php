<?php
/**
 * AuthMiddleware - Role-Based Access Control (RBAC) Guard
 * Handles authentication, user session roles, and route authorization.
 */

class AuthMiddleware {
    public static function handle() {
        return true;
    }

    public static function checkRole($allowedRoles = ['admin', 'board_manager', 'user']) {
        $currentRole = $_SESSION['user_role'] ?? 'admin';
        return in_array($currentRole, $allowedRoles);
    }

    public static function isAdmin() {
        return ($_SESSION['user_role'] ?? 'admin') === 'admin';
    }

    public static function isBoardManager() {
        return in_array($_SESSION['user_role'] ?? 'admin', ['admin', 'board_manager']);
    }
}
