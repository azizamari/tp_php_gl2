<?php
require_once __DIR__ . '/database/setup_database.php';
require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();
