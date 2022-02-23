<?php

namespace Model;

include '../helper/autoloader.php';

class Signin extends \config\DbConn
{
     private $postData = [];
     private $errMsg = [
          'email' => '',
          'password' => '',
          'invalidCredential' => '',
     ];

     protected function __construct($postData)
     {
          $this->postData = $postData;

          // Check for credential once there is no empty input.
          if ($this->checkInput()) {
               $userId = $this->checkCredential();
          }

          if (array_filter($this->errMsg)) {
               return $this->errMsg;
          } else {
               session_start();
               $_SESSION['userId'] = $userId;
          }
     }

     private function checkInput()
     {
          $result = true;
          foreach ($this->postData as $field => $data) {

               // Check if any input is empty.
               if (empty(trim($data))) {
                    $this->errMsg[$field] = '* ' . ucfirst($field) . ' is a required field';
                    $result = false;
               }
          }
          return $result;
     }

     private function checkCredential()
     {
          $sql = "SELECT * FROM user WHERE email = ?;";

          $stmt = $this->executeQuery($sql, [$this->postData['email']]);

          $userInfo = $stmt->fetch();

          if ($userInfo && password_verify($this->postData['password'], $userInfo['password'])) {
               return $userInfo['user_id'];
          } else {
               $this->errMsg['invalidCredential'] = '&#9888 Incorrect email or password.';
          }
     }
}
