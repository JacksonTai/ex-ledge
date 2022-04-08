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

     protected function readComment($criteria, $userId)
     {
          $comment = '';
          if ($criteria && ($criteria[0] == 'Q' || $criteria[0] == 'A')) {
               $sql = "SELECT c.*, u.username FROM comment c
                         INNER JOIN user u ON c.user_id = u.user_id
                         WHERE reply_id = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $commentsInfo = $stmt->fetchAll();

               foreach ($commentsInfo as $commentInfo) {
                    $commentAction = '';
                    if ($userId == $commentInfo['user_id']) {
                         $commentAction = '<div class="question__comment-action">
                                             <span class="question__edit-comment">Edit</span> 
                                             <span class="question__delete-comment" onclick="confirmDeletion(\''  . ($commentInfo['comment_id']) . '\')" data-comment-id="'. $commentInfo['comment_id'] .'">Delete</span> 
                                           </div>';
                    };
                    $comment .= ' <div class="question__user question__user--comment">
                                        <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                                        <div class="question__user-info question__user-info--comment">
                                             <h4 class="question__usename">' . $commentInfo['username'] . '</h4>
                                             <p class="question__comment">
                                                  ' . $commentInfo['content'] . ' 
                                             </p>
                                             ' . $commentAction . '
                                        </div>
                                   </div>';
               }
               return ['id' => $criteria, 'comment' => $comment];
          }
     }

     protected function updateComment($content, $commentId)
     {
          $sql = "UPDATE comment SET content =? WHERE comment_id = ?;";
          $this->executeQuery($sql, [$content, $commentId]);
     }

     protected function deleteComment($commentId)
     {
          $sql = "DELETE FROM comment WHERE comment_id = ?;";
          $this->executeQuery($sql, [$commentId]);
     }
}
