<?php
session_start();

require_once __DIR__ . '/../models/User.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /auth/login.php');
        exit;
    }
}

function requireAdmin() {
    requireLogin();
    
    if ($_SESSION['user_role'] !== 'admin') {
        header('Location: /user/index.php?error=unauthorized');
        exit;
    }
}

function getCurrentUser() {
    if (isLoggedIn()) {
        $userModel = new User();
        return $userModel->getById($_SESSION['user_id']);
    }
    return null;
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user_role'] === 'admin';
}