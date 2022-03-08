<?php

namespace Model;

use PDOException;

include '../../helper/autoloader.php';

class User extends \config\DbConn
{
     private $userId;

     protected function __construct($userId)
     {
          $this->userId = $userId;
     }

     protected function getUser()
     {
          // Query for selecting specific user based on given user ID. 
          if ($this->userId) {
               try {
                    $sql = "SELECT * FROM user WHERE `user_id` = ?;";
                    $stmt = $this->executeQuery($sql, [$this->userId]);
                    $userInfo = $stmt->fetch();

                    $sql = "SELECT * FROM user_detail WHERE `user_id` = ?;";
                    $stmt = $this->executeQuery($sql, [$this->userId]);
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
          $sql = "SELECT * FROM user u
                    INNER JOIN user_detail ud ON u.user_id = ud.user_id;";

          try {
               $stmt = $this->executeQuery($sql);
               // Error handling for more than one user being fetched from the entire record.
               if ($stmt->rowCount() > 1) {
                    return $stmt->fetchAll();
               }
               return $stmt->fetch();
          } catch (PDOException $e) {
               die('Error: ' . $e->getMessage());
          }
     }
}
