<?php
$pageTitle = 'Edit Section';
require_once __DIR__ . '/../../includes/header.php';
requireAdmin();

require_once __DIR__ . '/../../models/Section.php';

$sectionModel = new Section();

$id = $_GET['id'] ?? 0;
$section = $sectionModel->getById($id);

if (!$section) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $designation = $_POST['designation'] ?? '';
    $description = $_POST['description'] ?? '';
    
    if (empty($designation)) {
        $error = 'Please enter designation';
    } else {
        if ($sectionModel->update($id, $designation, $description)) {
            $success = 'Section updated successfully';
            $section = $sectionModel->getById($id); // Refresh section data
        } else {
            $error = 'Failed to update section';
        }
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?= $pageTitle ?></h1>
    <a href="index.php" class="btn btn-secondary">Back to List</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?= htmlspecialchars($section['designation']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($section['description']) ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Section</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>