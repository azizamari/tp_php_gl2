<?php
$pageTitle = 'Add New Student';
require_once __DIR__ . '/../../includes/header.php';
requireAdmin();

require_once __DIR__ . '/../../models/Student.php';
require_once __DIR__ . '/../../models/Section.php';

$studentModel = new Student();
$sectionModel = new Section();

$sections = $sectionModel->getAll();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $sectionId = $_POST['section_id'] ?? null;
    
    if (empty($sectionId)) {
        $sectionId = null;
    }
    
    if (empty($name) || empty($birthdate)) {
        $error = 'Please fill all required fields';
    } else {
        // Handle image upload
        $imageName = 'default.jpg';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../assets/images/student_photos/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileInfo = pathinfo($_FILES['image']['name']);
            $extension = strtolower($fileInfo['extension']);
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (!in_array($extension, $allowedExtensions)) {
                $error = 'Invalid image format. Allowed formats: ' . implode(', ', $allowedExtensions);
            } else {
                $imageName = uniqid('student_') . '.' . $extension;
                $destination = $uploadDir . $imageName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    // Image uploaded successfully
                } else {
                    $error = 'Failed to upload image';
                    $imageName = 'default.jpg';
                }
            }
        }
        
        if (empty($error)) {
            if ($studentModel->create($name, $birthdate, $imageName, $sectionId)) {
                $success = 'Student added successfully';
            } else {
                $error = 'Failed to add student';
            }
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            
            <div class="form-group">
                <label for="section_id">Section</label>
                <select class="form-control" id="section_id" name="section_id">
                    <option value="">-- Select Section --</option>
                    <?php foreach ($sections as $section): ?>
                        <option value="<?= $section['id'] ?>"><?= htmlspecialchars($section['designation']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <small class="form-text text-muted">Allowed formats: jpg, jpeg, png, gif</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Student</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>