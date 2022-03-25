<?php

namespace Model;

class Comment extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          if (!empty($postData)) {
               $this->postData = $postData;
               $this->createComment();
          }
     }

     private function createComment()
     {
          $commentId = uniqid("C");
          $sql = "INSERT INTO comment VALUES (?, ?, ?, ?);";
          $this->executeQuery($sql, [
               $commentId,
               $this->postData['userId'],
               $this->postData['replyId'],
               $this->postData['content'],
          ]);
     }

     protected function readComment($criteria)
     {
          $comment = '';
          if ($criteria && ($criteria[0] == 'Q' || $criteria[0] == 'A')) {
               $sql = "SELECT c.*, u.username FROM comment c
                         INNER JOIN user u ON c.user_id = u.user_id
                         WHERE reply_id = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $commentsInfo = $stmt->fetchAll();

               foreach ($commentsInfo as $commentInfo) {
                    $comment .= ' <div class="question__user question__user--comment">
                                             <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                                             <div class="question__user-info">
                                                  <h4>' . $commentInfo['username'] . '</h4>
                                                  <p class="question__comment">
                                                       ' . $commentInfo['content'] . '  
                                                  </p>
                                             </div>
                                        </div>';
               }

               return ['id' => $criteria, 'comment' => $comment];
          }
     }
}
