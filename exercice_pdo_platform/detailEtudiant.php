<?php
require_once __DIR__ . '/config/database.php';

// ID is required
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur: ID d'étudiant non spécifié");
}

$studentId = $_GET['id'];

$db = Database::getInstance();
$conn = $db->getConnection();

// Fetch student by ID
$stmt = $conn->prepare("SELECT * FROM student WHERE id = :id");
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if student exists
if (!$student) {
    die("Étudiant non trouvé");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        h1 { color: #333; }
        .card { border: 1px solid #ddd; border-radius: 5px; padding: 20px; max-width: 500px; }
        .info-row { margin-bottom: 10px; }
        .label { font-weight: bold; display: inline-block; width: 150px; }
        a { color: #0066cc; text-decoration: none; display: inline-block; margin-top: 20px; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Détails de l'étudiant</h1>
    
    <div class="card">
        <div class="info-row">
            <span class="label">ID:</span>
            <span><?= $student['id'] ?></span>
        </div>
        
        <div class="info-row">
            <span class="label">Nom:</span>
            <span><?= htmlspecialchars($student['name']) ?></span>
        </div>
        
        <div class="info-row">
            <span class="label">Date de naissance:</span>
            <span><?= $student['date_of_birth'] ?></span>
        </div>
    </div>
    
    <a href="index.php">Retour à la liste</a>
</body>
</html>