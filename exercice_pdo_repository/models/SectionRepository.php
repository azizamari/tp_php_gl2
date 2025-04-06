<?php
require_once __DIR__ . '/Repository.php';


class SectionRepository extends Repository {
    
    public function __construct() {
        parent::__construct('section');
    }
    

    public function getStudentCount($sectionId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM student WHERE section_id = ?");
        $stmt->execute([$sectionId]);
        return $stmt->fetchColumn();
    }
    

    public function findByDesignation($designation) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE designation LIKE ?");
        $stmt->execute(["%{$designation}%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function createSection($designation, $description) {
        return $this->create([
            'designation' => $designation,
            'description' => $description
        ]);
    }
    

    public function updateSection($id, $designation, $description) {
        return $this->update($id, [
            'designation' => $designation,
            'description' => $description
        ]);
    }
}