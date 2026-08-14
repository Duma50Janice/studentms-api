<?php 


namespace App\Models;

use App\Database;
use PDO;

class Student {
    private PDO $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }
    /**
     * method that fetches all students from the database
     * @return array
     */
    public function getAll(): array | false {
        $query = "SELECT * FROM students";  
        $stmt = $this->db->query($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $query = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($first_name, $last_name, $email, $course){
        // $query = "INSERT INTO students (first_name, last_name, email, course) VALUES (?, ?, ?, ?)";
        $query = "INSERT INTO students (first_name, last_name, email, course) VALUES (:first_name, :last_name, :email,:course)";
        $stmt = $this->db->prepare($query);
        // return $stmt->execute([$first_name, $last_name, $email, $course]);
        return $stmt->execute([
            ':first_name' => $first_name,
            ':last_name'=> $last_name,
            ':email' => $email,
            ':course' => $course
            ]);
    }
    public function update($id, $first_name, $last_name, $email, $course){
        $query = "UPDATE students SET first_name = ?, last_name = ?, email = ?, course = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$first_name, $last_name, $email, $course, $id]);
    }
    public function delete($id){
        $query = "DELETE FROM students WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
    
    public function deleteAll(){
        $query = "DELETE FROM students";
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }
}