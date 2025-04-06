<?php
require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}
