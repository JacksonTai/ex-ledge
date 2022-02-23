<?php

namespace Model;

include '../helper/autoloader.php';

class Signup extends \config\DbConn
{
     private $postData = [];
     private $errMsg = [
          'email' => '',
          'fullName' => '',
          'password' => '',
          'passwordRepeat' => '',
     ];

     protected function __construct($postData)
     {
          $this->postData = $postData;

          // Check if there is any error field.
          $this->validateInput();

          if ($this->checkEmptyInput()) {
               $this->checkDuplicateEmail();
          }

          if (array_filter($this->errMsg)) {
               return $this->errMsg;
          } else {
               $userId = $this->createUser();
               session_start();
               $_SESSION['userId'] = $userId;
          }
     }

     private function createUser()
     {
          $userId = uniqid('U');
          $hashedPassword = password_hash($this->postData['password'], PASSWORD_DEFAULT);

          $sql = "INSERT INTO user (`user_id`, email, full_name, `password`)
                  VALUES (?, ?, ?, ?);";

          $this->executeQuery($sql, [
               $userId,
               $this->postData['email'],
               $this->postData['fullName'],
               $hashedPassword
          ]);

          return $userId;
     }

     private function validateInput()
     {
          // Validate email address.
          if (!filter_var($this->postData['email'], FILTER_VALIDATE_EMAIL)) {
               $this->errMsg['email'] = '&#9888; Invalid email address.';
          }

          // Validate full name.
          if (!preg_match("/^[a-z]{8,30}$/i", $this->postData['fullName'])) {
               $this->errMsg['fullName'] = '&#9888; Full name must: ';
          }

          // Validate password.
          if (!preg_match(
               "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/",
               $this->postData['password']
          )) {
               $this->errMsg['password'] = '&#9888; Password must: ';
          }

          // Validate repeated password.
          if ($this->postData['password'] != $this->postData['passwordRepeat']) {
               $this->errMsg['passwordRepeat'] = "&#9888; Those passwords didn't match.";
          }
     }

     private function checkEmptyInput()
     {
          $result = true;
          foreach ($this->postData as $field => $data) {

               // Check if any input is empty.
               if (empty(trim($data))) {
                    $this->errMsg[$field] = '* ' . ucfirst($field) . ' is a required field';
                    if ($field == 'passwordRepeat') {
                         $this->errMsg[$field] = '* Please repeat your password.';
                    }
                    if ($field == 'email') {
                         $result = false;
                    }
               }
          }
          return $result;
     }

     private function checkDuplicateEmail()
     {
          $sql = "SELECT email FROM user WHERE email = ?;";

          $stmt = $this->executeQuery($sql, [$this->postData['email']]);

          if ($stmt->rowCount() > 0) {
               $this->errMsg['email'] = '&#9888; This email is already in use.';
          }
     }
}
