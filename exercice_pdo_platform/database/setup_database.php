<?php
require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

try {
    $conn->exec("
    CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    ");

    $conn->exec("
    CREATE TABLE IF NOT EXISTS section (
        id INT AUTO_INCREMENT PRIMARY KEY,
        designation VARCHAR(100) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    ");

    $conn->exec("
    CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        birthdate DATE NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        section_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (section_id) REFERENCES section(id) ON DELETE SET NULL
    )
    ");

    // Insert default admin user if none exists
    $stmt = $conn->prepare("SELECT id FROM user WHERE role = 'admin' LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Create default admin: username=admin, password=admin123
        $username = 'admin';
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $email = 'admin@example.com';
        $role = 'admin';
        
        $stmt = $conn->prepare("INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $email, $role]);
        
        echo "Default admin user created.<br>";
    }

    // Insert default regular user if none exists
    $stmt = $conn->prepare("SELECT id FROM user WHERE role = 'user' LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Create default user: username=user, password=user123
        $username = 'user';
        $password = password_hash('user123', PASSWORD_DEFAULT);
        $email = 'user@example.com';
        $role = 'user';
        
        $stmt = $conn->prepare("INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $email, $role]);
        
        echo "Default regular user created.<br>";
    }

    // Insert some sample sections if none exist
    $stmt = $conn->prepare("SELECT id FROM section LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        $sections = [
            ['Computer Science', 'Studies in software development, algorithms, and computer systems'],
            ['Business Administration', 'Studies in management, marketing, and economics'],
            ['Engineering', 'Studies in mechanical, electrical, and civil engineering']
        ];
        
        $stmt = $conn->prepare("INSERT INTO section (designation, description) VALUES (?, ?)");
        
        foreach ($sections as $section) {
            $stmt->execute($section);
        }
        
        echo "Sample sections created.<br>";
    }

    $stmt = $conn->prepare("SELECT id FROM student LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Get section IDs
        $stmt = $conn->prepare("SELECT id FROM section");
        $stmt->execute();
        $sectionIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($sectionIds) > 0) {
            $students = [
                ['John Doe', '2000-05-15', 'default.jpg', $sectionIds[0]],
                ['Jane Smith', '2001-03-22', 'default.jpg', $sectionIds[0]],
                ['Michael Johnson', '1999-11-08', 'default.jpg', $sectionIds[1]],
                ['Emma Williams', '2002-07-30', 'default.jpg', $sectionIds[1]],
                ['Robert Brown', '2000-01-10', 'default.jpg', $sectionIds[2]],
                ['Olivia Davis', '2001-09-18', 'default.jpg', $sectionIds[2]]
            ];
            
            $stmt = $conn->prepare("INSERT INTO student (name, birthdate, image, section_id) VALUES (?, ?, ?, ?)");
            
            foreach ($students as $student) {
                $stmt->execute($student);
            }
            
            echo "Sample students created.<br>";
        }
    }

    echo "Database setup completed successfully!";
} catch (PDOException $e) {
    die("Error setting up database: " . $e->getMessage());
}