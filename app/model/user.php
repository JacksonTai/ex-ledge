<?php

namespace Model;

use PDOException;

class User extends \config\DbConn
{
     private $userId;

     protected function __construct($userId)
     {
          $this->userId = $userId;
     }

     /* ######### CREATE ######### */
     protected function verifyUser($postData)
     {
          // Trim all item in postData array.
          $postData = array_map('trim', $postData);

          $errMsg = ['fullName' => '', 'nric' => ''];

          // Validate full name.
          if (!ctype_alpha($postData['fullName'])) {
               $errMsg['fullName'] = '&#9888; Invalid Full name.';
          }

          // Validate NRIC number.
          if (!preg_match("/^\d{6}-\d{2}-\d{4}$/", $postData['nric'])) {
               $errMsg['nric'] = '&#9888; Invalid NRIC number.';
          }

          // Check if any input is empty.
          if (empty(trim($postData['fullName']))) {
               $errMsg['fullName'] = '* Full name is a required field.';
          }

          if (empty(trim($postData['nric']))) {
               $errMsg['nric'] = '* NRIC number is a required field.';
          }

          // Check for duplicate NRIC number.
          foreach ($this->getVerification() as $verification) {
               if ($postData['nric'] == $verification['nric_no']) {
                    $errMsg['nric'] = '* This NRIC number has been submitted or taken.';
               }
          }

          if (array_filter($errMsg)) {
               return $errMsg;
          }

          $sql = "INSERT INTO verification_queue VALUES (?, ?, ?)";
          $this->executeQuery($sql, [$postData['nric'], $this->userId, $postData['fullName']]);
     }

     /* ######### READ ######### */
     protected function getVerification($userId = null)
     {
          // Query for selecting specific user verification info.
          if ($userId) {
               $sql = "SELECT * FROM verification_queue WHERE `user_id` = ?";
               $stmt = $this->executeQuery($sql, [$userId]);
               return $stmt->fetch();
          }

          // Default query for selecting all verification info.
          $sql = "SELECT * FROM verification_queue";
          $stmt = $this->executeQuery($sql);
          return $stmt->fetchAll();
     }

     protected function getUser($userId)
     {
          if ($userId) {
               // Query for selecting specific user based on the given user ID. 
               try {
                    $sql = "SELECT * FROM user WHERE `user_id` = ? AND `user_id` LIKE 'U%';";
                    $stmt = $this->executeQuery($sql, [$userId]);
                    $userInfo = $stmt->fetch();

                    $sql = "SELECT * FROM user_detail WHERE `user_id` = ? AND `user_id` LIKE 'U%';";
                    $stmt = $this->executeQuery($sql, [$userId]);
                    $userDetail = $stmt->fetch();

                    /* Return a merged array of user detail and user record 
                       if user detail exists. */
                    if (is_array($userDetail)) {
                         return array_merge($userInfo, $userDetail);
                    }
                    return $userInfo;
               } catch (PDOException $e) {
                    die('Error: ' . $e->getMessage());
               }
          }

          // Default query for selecting all user's info and detail. 
          try {
               $result = [];
               $sql = "SELECT * FROM user WHERE `user_id` LIKE 'U%';";
               $stmt = $this->executeQuery($sql);
               $userInfos = $stmt->fetchAll();

               foreach ($userInfos as $userInfo) {
                    try {
                         $sql = "SELECT * FROM user_detail WHERE `user_id` = ?;";
                         $stmt = $this->executeQuery($sql, [$userInfo['user_id']]);
                         $userDetail = $stmt->fetch();

                         if (is_array($userDetail)) {
                              $userInfo = array_merge($userInfo, $userDetail);
                         }
                         array_push($result, $userInfo);
                    } catch (PDOException $e) {
                         die('Error: ' . $e->getMessage());
                    }
               }
               return $result;
          } catch (PDOException $e) {
               die('Error: ' . $e->getMessage());
          }
     }

     protected function getUserRank($top, $length)
     {
          $sql = "SELECT * FROM user
                  WHERE `user_id` LIKE ?
                  ORDER BY `point` DESC;";
          $stmt = $this->executeQuery($sql, ['U%']);
          $results = $stmt->fetchAll();

          // Store the result that has shortened username. 
          $calcResult = [];

          // Shorten username that is longer than 8.
          foreach ($results as $result) {
               $calcUsername = $result['username'];

               strlen($calcUsername) > 8 ? $calcUsername = substr($calcUsername, 0, 8) . '...' : null;

               $result['username'] = $calcUsername;
               array_push($calcResult, $result);
          }

          if ($top && $length) {
               return array_slice($calcResult, $top - 1, $length - $top + 1);
          }

          return $top ? array_slice($calcResult, 0, $top) : $calcResult;
     }

     protected function searchUser($searchTerm)
     {
          $sql = "SELECT * FROM user
                    WHERE NOT `user_id` = ? 
                    AND `user_id` NOT LIKE ?
                    ";
          // AND username LIKE ?
          $stmt = $this->executeQuery($sql, [$this->userId, '%' . $searchTerm   . '%']);

          // $stmt->rowCount() > 1 ? $userList = $stmt->fetchAll() : $userList = $stmt->fetch();
          $userList = $stmt->fetch();
          return $userList;
     }

     /* ######### UPDATE ######### */
     protected function updateUser($postData)
     {
          $userData = $this->getUser($this->userId);

          if (isset($postData['bio'])) {
               if (count($userData) == 7) {
                    if ($postData['bio'] != '') {
                         $sql = "INSERT INTO user_detail (`user_id`, bio) VALUES (?, ?)";
                         $this->executeQuery($sql, [$this->userId, $postData['bio'],]);
                    }
               }
               if (count($userData) != 7) {
                    if ($postData['bio'] == '') {
                         /* Delete user_detail record if user pass empty bio while the gender, age 
                            and nric number has never been set yet. */
                         if (!$userData['gender'] && !$userData['age'] && !$userData['nric_no']) {
                              $sql = "DELETE FROM user_detail WHERE `user_id` = ?";
                              $this->executeQuery($sql, [$this->userId,]);
                         } else {
                              $sql = "UPDATE user_detail SET bio = ?  WHERE `user_id` = ?;";
                              $this->executeQuery($sql, [null, $this->userId]);
                         }
                         return;
                    }

                    // Execute update of bio only if it's different from the current one.
                    if ($userData['bio'] != $postData['bio']) {
                         $sql = "UPDATE user_detail SET bio = ?  WHERE `user_id` = ?;";
                         $this->executeQuery($sql, [$postData['bio'], $this->userId]);
                    }
               }
               return;
          }

          $errMsg = ['username' => '', 'age' => '', 'gender' => ''];

          // Validate username.
          if (!preg_match("/^[a-z]{8,30}$/i", $postData['username'])) {
               $errMsg['username'] = '&#9888; Invalid username.';
          }

          // Check if any input is empty.
          foreach ($postData as $field => $data) {
               if (empty(trim($data))) {
                    $errMsg[$field] = '* ' . ucfirst($field) . ' is a required field.';
               }
          }
          if (!isset($postData['gender'])) {
               $errMsg['gender'] = '* Please select your gender.';
          }

          if (array_filter($errMsg)) {
               return $errMsg;
          }

          // Execute update of username only if it's different from the current one.
          if ($userData['username'] != $postData['username']) {
               $sql = "UPDATE user SET username = ?
                         WHERE `user_id` = ?;";
               $this->executeQuery($sql, [$postData['username'], $this->userId]);
          }

          // Check if user has set age or gender or bio before.
          if (isset($userData['age']) || isset($userData['gender']) || isset($userData['bio'])) {
               // Execute update of age and gender only if it's being changed.
               if ($userData['age'] != $postData['age']) {
                    $sql = "UPDATE user_detail SET age = ?
                              WHERE `user_id` = ?;";
                    $this->executeQuery($sql, [$postData['age'], $this->userId]);
               }
               if ($userData['gender'] != $postData['gender']) {
                    $sql = "UPDATE user_detail SET gender = ?
                              WHERE `user_id` = ?;";
                    $this->executeQuery($sql, [$postData['gender'], $this->userId]);
               }
               return;
          }
          $sql = "INSERT INTO user_detail (`user_id`, gender, age)
                    VALUES (?, ?, ?)";
          $this->executeQuery($sql, [
               $this->userId,
               $postData['gender'],
               $postData['age']
          ]);
     }

     /* ######### DELETE ######### */
     protected function deleteUser($userId)
     {
          $sql = "DELETE FROM user WHERE `user_id` = ?;";
          $this->executeQuery($sql, [$userId]);
     }
}
