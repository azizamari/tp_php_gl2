<?php
require_once __DIR__ . '/auth.php';
requireLogin();

$currentUser = getCurrentUser();
$isAdminUser = isAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Gestion des etudiants' ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <style>
        body {
            padding-top: 4.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">Projet TP PHP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <?php if ($isAdminUser): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/students/index.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/sections/index.php">Sections</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/students.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/sections.php">Sections</a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/auth/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <main role="main" class="container">