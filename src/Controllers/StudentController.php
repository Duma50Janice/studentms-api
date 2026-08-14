<?php 

namespace App\Controllers;
use App\Models\Student;
use PDO;


class StudentController {
    private $studentModel;

    public function __construct(PDO $db){
        $this->studentModel = new Student($db);

    }
    public function index(){
        $students = $this->studentModel->getAll();
        echo json_encode(["success" => true, "data" => $students]);
        // return view("",compact(""));
        // echo json_encode($students);
    }
    public function getById($id){
        $student = $this->studentModel->getById($id);
        if(!$student){
            http_response_code(404);
            echo json_encode(["success" => false, "message" => "Student not found"]);
            return;
        }
        echo json_encode(["success" => true, "data" => $student]);
    }

        public function create($data){
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $course = $data['course'];

            if($this->studentModel->create($first_name, $last_name, $email, $course)){
                http_response_code(201);
                echo json_encode(["success" => true, "message" => "Student created successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Failed to create student"]);
            }
        }

        public function update($id, $data){
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $course = $data['course'];

            if($this->studentModel->update($id, $first_name, $last_name, $email, $course)){
                echo json_encode(["success" => true, "message" => "Student updated successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Failed to update student"]);
            }
        }
        public function delete($id){
            if($this->studentModel->delete($id)){
                echo json_encode(["success" => true, "message" => "Student deleted successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Failed to delete student"]);
            }
        }
        public function deleteAll(){
            if($this->studentModel->deleteAll()){
                echo json_encode(["success" => true, "message" => "All students deleted successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Failed to delete all students"]);
            }
        }
}