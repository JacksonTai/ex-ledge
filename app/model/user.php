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
               $sql = "SELECT * FROM user WHERE `user_id` LIKE ?;";
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

     protected function deleteUser($userId)
     {
          
     }
}
