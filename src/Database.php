<?php 

namespace App;

use PDO;
use PDOException;


class Database {

    /**
     * Method to get connection using pdo
     * @return PDO
     */
    public static function getConnnection() : PDO{
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];

        $dsn = "mysql:host={$host};dbname={$database};charset=utf8mb4";
        try {
            return new PDO($dsn, $user, $password);
        }catch(PDOException $e){
            //  error_log("Database Connection Failed", $e->getMessage());
             throw new PDOException("Could not connect to the database");
        }
    }
}