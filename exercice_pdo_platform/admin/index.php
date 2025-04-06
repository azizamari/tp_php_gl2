<?php
$pageTitle = 'Admin Dashboard';
require_once __DIR__ . '/../includes/header.php';
requireAdmin();

require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Section.php';
require_once __DIR__ . '/../models/User.php';

$studentModel = new Student();
$sectionModel = new Section();
$userModel = new User();

$totalStudents = $studentModel->count();
$totalSections = $sectionModel->count();
$totalUsers = $userModel->count();
?>


<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Students</h5>
                <p class="card-text">Total: <?= $totalStudents ?></p>
                <a href="/admin/students/index.php" class="btn btn-primary">Manage Students</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sections</h5>
                <p class="card-text">Total: <?= $totalSections ?></p>
                <a href="/admin/sections/index.php" class="btn btn-primary">Manage Sections</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text">Total: <?= $totalUsers ?></p>
                <a href="#" class="btn btn-primary">Manage Users</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>