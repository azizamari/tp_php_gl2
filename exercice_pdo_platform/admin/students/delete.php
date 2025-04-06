<?php
require_once __DIR__ . '/../../includes/auth.php';
requireAdmin();

require_once __DIR__ . '/../../models/Student.php';

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    $studentModel = new Student();
    $student = $studentModel->getById($id);
    
    if ($student) {
        // Delete the student's image if it's not the default
        if ($student['image'] !== 'default.jpg') {
            $imagePath = __DIR__ . '/../../assets/images/student_photos/' . $student['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $studentModel->delete($id);
    }
}

header('Location: index.php');
exit;