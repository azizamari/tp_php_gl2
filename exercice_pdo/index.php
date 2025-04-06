<?php
require_once __DIR__ . '/database/setup_database.php';
require_once __DIR__ . '/config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();


// Fetch all etudiants
$stmt = $conn->prepare("SELECT * FROM student");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Liste des étudiants</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= $student['date_of_birth'] ?></td>
                <td>
                    <a href="detailEtudiant.php?id=<?= $student['id'] ?>">Détails</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>