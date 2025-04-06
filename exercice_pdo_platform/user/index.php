<?php
$pageTitle = 'User Dashboard';
require_once __DIR__ . '/../includes/header.php';
requireLogin();

require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Section.php';

$studentModel = new Student();
$sectionModel = new Section();

$totalStudents = $studentModel->count();
$totalSections = $sectionModel->count();
?>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Students</h5>
                <p class="card-text">Total: <?= $totalStudents ?></p>
                <a href="/user/students.php" class="btn btn-primary">View Students</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Sections</h5>
                <p class="card-text">Total: <?= $totalSections ?></p>
                <a href="/user/sections.php" class="btn btn-primary">View Sections</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>