<?php
$pageTitle = 'View Sections';
require_once __DIR__ . '/../includes/header.php';
requireLogin();

require_once __DIR__ . '/../models/Section.php';

$sectionModel = new Section();
$sections = $sectionModel->getAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $pageTitle ?></h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Designation</th>
                        <th>Description</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sections as $section): ?>
                        <tr>
                            <td><?= $section['id'] ?></td>
                            <td><?= htmlspecialchars($section['designation']) ?></td>
                            <td><?= htmlspecialchars($section['description']) ?></td>
                            <td>
                                <?php $studentCount = $sectionModel->getStudentCount($section['id']); ?>
                                <?= $studentCount ?>
                            </td>
                            <td>
                                <a href="section_students.php?section_id=<?= $section['id'] ?>" class="btn btn-sm btn-info">View Students</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>