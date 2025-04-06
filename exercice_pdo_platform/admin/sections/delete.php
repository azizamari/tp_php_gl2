<?php
require_once __DIR__ . '/../../includes/auth.php';
requireAdmin();

require_once __DIR__ . '/../../models/Section.php';

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    $sectionModel = new Section();
    $sectionModel->delete($id);
}

header('Location: index.php');
exit;