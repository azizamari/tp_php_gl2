<?php
$pageTitle = 'Manage Students';
require_once __DIR__ . '/../../includes/header.php';
requireAdmin();

require_once __DIR__ . '/../../models/Student.php';

$studentModel = new Student();

// Filter by name if requested
$filterName = $_GET['filter_name'] ?? '';
if (!empty($filterName)) {
    $students = $studentModel->getByName($filterName);
} else {
    $students = $studentModel->getAll();
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $pageTitle ?></h1>
    <a href="create.php" class="btn btn-success">Add New Student</a>
</div>

<div class="card mb-4">
    <div class="card-header">
        <form method="get" class="form-inline">
            <div class="form-group mr-2">
                <input type="text" class="form-control" name="filter_name" placeholder="Filter by name" value="<?= htmlspecialchars($filterName) ?>">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Filter</button>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Section</th>
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
                            <td><?= htmlspecialchars($student['section_name'] ?? 'None') ?></td>
                            <td>
                                <?php if (!empty($student['image']) && file_exists(__DIR__ . '/../../assets/images/student_photos/' . $student['image'])): ?>
                                    <img src="/assets/images/student_photos/<?= $student['image'] ?>" alt="<?= htmlspecialchars($student['name']) ?>" width="50">
                                <?php else: ?>
                                    <img src="/assets/images/student_photos/default.jpg" alt="Default" width="50">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>