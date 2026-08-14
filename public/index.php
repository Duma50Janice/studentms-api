<?php 


// capture the request sent
// method
// url/endpoint
// urlparam
// body


header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers:Content-Type');

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    http_response_code(200);
    exit();
}

require __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Database;
use App\Controllers\StudentController;



$dotenv = Dotenv::createMutable(__DIR__.'/..');
$dotenv->load();

try {
    $db = Database::getConnnection();
    http_response_code(200);
    header("Content-Type:application/json");
    // var_dump($e);
    echo json_encode(['success' => $db]);
}catch(\Throwable  $e) {
    http_response_code(500);
    header("Content-Type:application/json");
    // var_dump($e);
    echo json_encode(['error' => $e->getMessage()]);
}





