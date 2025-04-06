<?php
require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

$tableExists = false;
try {
    $stmt = $conn->prepare("SHOW TABLES LIKE 'student'");
    $stmt->execute();
    $tableExists = $stmt->rowCount() > 0;
} catch (PDOException $e) {
    die("Error checking table: " . $e->getMessage());
}

if (!$tableExists) {
    try {
        $createTable = "
        CREATE TABLE student (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            date_of_birth DATE NOT NULL
        )";
        $conn->exec($createTable);
        
        $sampleData = "
        INSERT INTO student (name, date_of_birth) VALUES
        ('John Doe', '2000-05-15'),
        ('Jane Smith', '2001-03-22'),
        ('Michael Johnson', '1999-11-08'),
        ('Emma Williams', '2002-07-30')
        ";
        $conn->exec($sampleData);
        
        echo "Database setup completed successfully! The student table has been created and populated with sample data.";
    } catch (PDOException $e) {
        die("Error setting up database: " . $e->getMessage());
    }
} else {
    echo "The student table already exists. No setup required.";
}