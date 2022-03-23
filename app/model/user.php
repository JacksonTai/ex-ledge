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
          if (!ctype_alpha(str_replace(' ', '',$postData['fullName']))) {
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

          $this->executeQuery($sql, [$postData['nric'], $this->userId, preg_replace("!\s+!", " ", $postData['fullName'])]);
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

     protected function loadData($limit, $start)
     {
          try {
               $sql = "SELECT * FROM user WHERE `user_id` LIKE ? ORDER BY username ASC LIMIT $limit OFFSET $start ";
               $stmt = $this->executeQuery($sql, ['U%']);
               $userInfos = $stmt->fetchAll();

               // For each users inside of userInfos array, echo out the php coe below
               foreach ($userInfos as $userInfo){
                    
                    echo 
                         '<div class="user_box" id='.($userInfo['user_id']).' data-user-id='.($userInfo['user_id']).'>
                              <a class="user_info" href="profile.php?id='.($userInfo['user_id']).'">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="user_img">
                                   <div class="user_info-detail">    
                                        <p class="user_name">'.($userInfo['username']).'</p>
                                        <p class="RP">RP: '.($userInfo['point']).'</p>
                                   </div>
                              </a>
                         </div>';                    
                    
               }



          } catch (PDOException $e) {
               die('Error: ' . $e->getMessage());
          }          
     }

     protected function getUser($userId)
     {
          if ($userId) {
               // Query for selecting specific user based on the given user ID. 
               try {
                    $sql = "SELECT * FROM user WHERE `user_id` = ? AND `user_id` LIKE ?;";
                    $stmt = $this->executeQuery($sql, [$userId, 'U%']);
                    $userInfo = $stmt->fetch();

                    $sql = "SELECT * FROM user_detail WHERE `user_id` = ? AND `user_id` LIKE ?;";
                    $stmt = $this->executeQuery($sql, [$userId, 'U%']);
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
               // Display the users in user dashbaord up to 9 in one page
               $sql = "SELECT * FROM user WHERE `user_id` LIKE ? ORDER BY username ASC LIMIT 9";
               $stmt = $this->executeQuery($sql, ['U%']);
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
                    WHERE `user_id` <> ? -- avoid user from searching him/herself.
                    AND username LIKE ? 
                    AND `user_id` LIKE ? -- avoid searching admin.
                    ORDER BY username";

          $stmt = $this->executeQuery($sql, [
               $this->userId,
               '%' . $searchTerm . '%',
               'U%'
          ]);
          $users = $stmt->fetchAll();
          $userInfo = '';
          foreach ($users as $user) {
               $userInfo .= '<div class="chat-section__user" id="' . $user['user_id'] . '" data-user-id=' . $user['user_id'] . '>
                                   <img class="chat-section__user-img chat-profile-img" src="../../../public/img/profile1.jpg">
                                   <div class="chat-section__user-content">
                                        <p class="chat-section__username">' . $user['username'] . '</p>
                                        <p class="chat-section__user-msg"></p>
                                   </div>
                              </div>';
          }
          return $userInfo;
     }

     protected function getMessagedUser($receiverId)
     {
          // Select all user except the currently logged in user.
          $sql = "SELECT * FROM user WHERE 
                    `user_id` <> ? 
                    AND `user_id` LIKE ?
                    ORDER BY `user_id` DESC";
          $stmt = $this->executeQuery($sql, [$this->userId, 'U%']);
          $receivers = $stmt->fetchAll();

          $userInfo = '';

          foreach ($receivers as $receiver) {
               // for each of other user, check if there's any incoming or outgoing message with current user.
               $sql = "SELECT * FROM `message` 
                         WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?) 
                         AND (incoming_msg_id  = ? OR outgoing_msg_id = ?) 
                         ORDER BY msg_id DESC LIMIT 1";

               $stmt = $this->executeQuery($sql, [
                    $receiver['user_id'],
                    $receiver['user_id'],
                    $this->userId,
                    $this->userId
               ]);

               $msg = $stmt->fetch();

               // Only include user that has conversation.
               if (is_array($msg)) {
                    // Add additional text to signify sending side.
                    $content = $msg['content'];
                    if ($msg['outgoing_msg_id'] == $this->userId) {
                         $content = 'You: ' . $msg['content'];
                    }

                    // Style selected user in user container.
                    $receiverId == $receiver['user_id'] ? $class = 'user-selected' :  $class = '';

                    // Cutting down content length to prevent overflow. 
                    strlen($content) > 20 ? $content = substr($content, 0, 23) . ' ...' : null;

                    $userInfo .= '<div class="chat-section__user ' . $class . '" id="' . $receiver['user_id'] . '" data-user-id=' . $receiver['user_id'] . '>
                                        <img class="chat-section__user-img chat-profile-img" src="../../../public/img/profile1.jpg">
                                        <div class="chat-section__user-content">
                                             <p class="chat-section__username">' . $receiver['username'] . '</p>
                                             <p class="chat-section__user-msg">' . $content . '</p>
                                        </div>
                                   </div>';
               }
          }
          return $userInfo;
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

     //Update verification
     protected function updateUserVerif($userId)
     {
          // $userVerifData = $this->getUser($this->userId);

          $sql = "UPDATE user SET verification='1' WHERE `user_id` = ?;";
          $this->executeQuery($sql, [$userId]);

          $sql_delete = "DELETE FROM verification_queue WHERE `user_id` = ?;";
          $this->executeQuery($sql_delete, [$userId]);
          
     }

     /* ######### DELETE ######### */
     protected function deleteUser($userId)
     {
          $sql = "DELETE FROM user WHERE `user_id` = ?;";
          $this->executeQuery($sql, [$userId]);
     }

     //reject verification
     protected function deleteUserVerif($userId)
     {
          $sql = "DELETE FROM verification_queue WHERE `user_id` = ?;";
          $this->executeQuery($sql, [$userId]);
     }
}
