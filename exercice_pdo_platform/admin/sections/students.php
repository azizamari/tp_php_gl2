<?php
require_once __DIR__ . '/../../includes/header.php';
requireAdmin();

require_once __DIR__ . '/../../models/Section.php';
require_once __DIR__ . '/../../models/Student.php';

$sectionId = $_GET['section_id'] ?? 0;

$sectionModel = new Section();
$studentModel = new Student();

$section = $sectionModel->getById($sectionId);

if (!$section) {
    header('Location: index.php');
    exit;
}

$students = $studentModel->getBySection($sectionId);
$pageTitle = 'Students in ' . $section['designation'];
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $pageTitle ?></h1>
    <a href="index.php" class="btn btn-secondary">Back to Sections</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <?php 
                        // Calculate age
                        $birthdate = new DateTime($student['birthdate']);
                        $today = new DateTime();
                        $age = $birthdate->diff($today)->y;
                        ?>
                        <tr>
                            <td><?= $student['id'] ?></td>
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= $student['birthdate'] ?></td>
                            <td><?= $age ?></td>
                            <td>
                                <?php if (!empty($student['image']) && file_exists(__DIR__ . '/../../assets/images/student_photos/' . $student['image'])): ?>
                                    <img src="/assets/images/student_photos/<?= $student['image'] ?>" alt="<?= htmlspecialchars($student['name']) ?>" width="50">
                                <?php else: ?>
                                    <img src="/assets/images/student_photos/default.jpg" alt="Default" width="50">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="../students/edit.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>