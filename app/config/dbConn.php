<?php

namespace config;

use PDO;
use PDOException;

class DbConn
{
     private $hostname = 'localhost';
     private $database = 'ex_ledge';
     private $username = 'root';
     private $password = '';

     protected function connect()
     {
          try {
               $pdo = new Pdo(
                    'mysql:host=' . $this->hostname . ';dbname=' . $this->database,
                    $this->username,
                    $this->password
               );
               return $pdo;
          } catch (PDOException $e) {
               die('<h2>Failed to connect database!</h2> Error: ' . $e->getMessage());
          }
     }

     // Error handler for statement execution.
     protected function execute($stmt, $values = null)
     {
          try {
               if ($values) {
                    $stmt->execute($values);
               } else {
                    $stmt->execute();
               }
          } catch (PDOException $e) {
               die("<h2>SQL statement execution failed.</h2> Error: " . $e->getMessage());
          }
     }
}
