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
               // []
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
                    AND `user_id` LIKE ? -- avoid seaching admin.
                    ORDER BY username";

          $stmt = $this->executeQuery($sql, [
               $this->userId,
               '%' . $searchTerm . '%',
               'U%'
          ]);

          return $stmt->fetchAll();
     }

     protected function getMessagedUser()
     {
          $sql = "SELECT u.*, m.msg_id FROM user u
                    INNER JOIN message m ON u.user_id = m.incoming_msg_id
                    WHERE u.user_id <> ? -- avoid choosing the user him/herself. 
                    AND (m.incoming_msg_id = ? OR m.outgoing_msg_id = ?)
                    GROUP BY u.user_id
                    ORDER BY m.msg_id DESC -- order by the latest message 
                    ;";

          $stmt = $this->executeQuery($sql, [$this->userId, $this->userId, $this->userId]);
          return $stmt->fetchAll();
     }
}
