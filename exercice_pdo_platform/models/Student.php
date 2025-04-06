<?php
require_once __DIR__ . '/../config/database.php';

class Student {
    private $conn;
    
    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("
            SELECT s.*, sect.designation as section_name 
            FROM student s
            LEFT JOIN section sect ON s.section_id = sect.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAll($limit = null, $offset = null) {
        $sql = "
            SELECT s.*, sect.designation as section_name 
            FROM student s
            LEFT JOIN section sect ON s.section_id = sect.id
            ORDER BY s.id
        ";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $offset, PDO::PARAM_INT);
            $stmt->bindParam(2, $limit, PDO::PARAM_INT);
        } else {
            $stmt = $this->conn->prepare($sql);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getByName($name) {
        $stmt = $this->conn->prepare("
            SELECT s.*, sect.designation as section_name 
            FROM student s
            LEFT JOIN section sect ON s.section_id = sect.id
            WHERE s.name LIKE ?
            ORDER BY s.id
        ");
        $stmt->execute(["%$name%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBySection($sectionId) {
        $stmt = $this->conn->prepare("
            SELECT s.*, sect.designation as section_name 
            FROM student s
            LEFT JOIN section sect ON s.section_id = sect.id
            WHERE s.section_id = ?
            ORDER BY s.id
        ");
        $stmt->execute([$sectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($name, $birthdate, $image, $sectionId) {
        $stmt = $this->conn->prepare("
            INSERT INTO student (name, birthdate, image, section_id) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $birthdate, $image, $sectionId]);
    }
    
    public function update($id, $name, $birthdate, $image, $sectionId) {
        $stmt = $this->conn->prepare("
            UPDATE student 
            SET name = ?, birthdate = ?, image = ?, section_id = ?
            WHERE id = ?
        ");
        return $stmt->execute([$name, $birthdate, $image, $sectionId, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM student WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM student");
        return $stmt->fetchColumn();
    }
    
    public function countBySection($sectionId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM student WHERE section_id = ?");
        $stmt->execute([$sectionId]);
        return $stmt->fetchColumn();
    }
}