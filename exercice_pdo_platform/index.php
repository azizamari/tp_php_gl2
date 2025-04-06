<?php
require_once __DIR__ . '/database/setup_database.php';
require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

session_start();

// If user is logged in, redirect to appropriate dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header('Location: /admin/index.php');
    } else {
        header('Location: /user/index.php');
    }
    exit;
}

// Otherwise redirect to login page
header('Location: /auth/login.php');
exit;