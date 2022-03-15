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

     protected function deleteUser($userId)
     {
          
     }

     protected function topThree()
     {
          // Printing users from rank 1 to 3.
          $sql = "SELECT * FROM user
                  WHERE `user_id` LIKE ?
                  ORDER BY point DESC
                  LIMIT 3";

          $stmt = $this->executeQuery($sql, ['U%']);
          $topThreeUsers = $stmt->fetchAll();
          return $topThreeUsers;
     }

     protected function topTen()
     {    
          // Printing users from rank 4 to 10.
          $sql = "SELECT * FROM user
                  WHERE `user_id` LIKE ?
                  ORDER BY point DESC
                  LIMIT 3, 7";

          $stmt = $this->executeQuery($sql, ['U%']);
          $topTenUsers = $stmt->fetchAll();
          return $topTenUsers;
     }

}
