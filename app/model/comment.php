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
                    $editComment = '';
                    if ($userId == $commentInfo['user_id']) {
                         $editComment = '<div class="question__comment-edit-area" data-comment-id="' . $commentInfo['comment_id'] . '">
                                             <textarea class="question__comment-edit-box" data-comment-id="' . $commentInfo['comment_id'] . '">' . $commentInfo['content'] . '</textarea>
                                             <div class="comment__btn-container">
                                                  <button class="comment__cancel-btn" onclick="toggleEditArea(\''  . ($commentInfo['comment_id']) . '\')">Cancel</button>
                                                  <button class="comment__save-btn" onclick="saveComment(\''  . ($commentInfo['comment_id']) . '\')">Save</button>
                                             </div>
                                         </div>';
                         $commentAction = '<div class="question__comment-action" data-comment-id="' . $commentInfo['comment_id'] . '">
                                             <span class="question__edit-comment" onclick="toggleEditArea(\''  . ($commentInfo['comment_id']) . '\')">Edit</span> 
                                             <span class="question__delete-comment" onclick="confirmDeletion(\''  . ($commentInfo['comment_id']) . '\')">Delete</span> 
                                           </div>';
                    };
                    $comment .= ' <div class="question__user question__user--comment" data-comment-id="' . $commentInfo['comment_id'] . '">
                                        <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                                        <div class="question__user-info question__user-info--comment">
                                             <h4 class="question__usename">' . $commentInfo['username'] . '</h4>
                                             ' . $editComment . '
                                             <p class="question__comment" data-comment-id="' . $commentInfo['comment_id'] . '">
                                                  ' . $commentInfo['content'] . ' 
                                             </p>
                                             ' . $commentAction . '
                                        </div>
                                   </div>';
               }
               return ['id' => $criteria, 'comment' => $comment];
          }
     }

     protected function updateComment($commentId, $content)
     {
          $sql = "UPDATE comment SET content = ? WHERE comment_id = ?;";
          $this->executeQuery($sql, [$content, $commentId]);
     }

     protected function deleteComment($commentId)
     {
          $sql = "DELETE FROM comment WHERE comment_id = ?;";
          $this->executeQuery($sql, [$commentId]);
     }
}
