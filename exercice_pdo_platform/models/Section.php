<?php
require_once __DIR__ . '/../config/database.php';

class Section {
    private $conn;
    
    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM section WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM section ORDER BY designation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($designation, $description) {
        $stmt = $this->conn->prepare("INSERT INTO section (designation, description) VALUES (?, ?)");
        return $stmt->execute([$designation, $description]);
    }
    
    public function update($id, $designation, $description) {
        $stmt = $this->conn->prepare("UPDATE section SET designation = ?, description = ? WHERE id = ?");
        return $stmt->execute([$designation, $description, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM section WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM section");
        return $stmt->fetchColumn();
    }
    
    public function getStudentCount($sectionId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM student WHERE section_id = ?");
        $stmt->execute([$sectionId]);
        return $stmt->fetchColumn();
    }
}