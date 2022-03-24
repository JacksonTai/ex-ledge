<?php

namespace Model;

class Answer extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          if (!empty($postData)) {
               $this->postData = $postData;
               $answerId = $this->createAnswer();
               header("location:../student/question.php?id=" . $postData['questionId'] . '#' . $answerId);
          }
     }

     private function createAnswer()
     {
          $answerId = uniqid('A');
          $sql = "INSERT INTO answer (answer_id, question_id, `user_id`, content)
                  VALUES (?, ?, ?, ?);";

          $this->executeQuery($sql, [
               $answerId,
               $this->postData['questionId'],
               $this->postData['userId'],
               $this->postData['ansContent']
          ]);

          return $answerId;
     }

     protected function readAnswer($criteria = null, $status = null)
     {
          if ($criteria) {
               if ($criteria[0] == 'Q') {
                    // Get accepted or rejected answer.
                    if ($status) {
                         $sql = "SELECT * FROM answer WHERE question_id = ?
                                   AND `status` = ?;";
                         $stmt = $this->executeQuery($sql, [$criteria, $status]);
                         return $stmt->fetch();
                    }

                    // Get all answer of that specific question.
                    $sql = "SELECT * FROM answer WHERE question_id = ?;";
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetchAll();
               }

               // Get specific answer based on the given answer ID.
               if ($criteria[0] == 'A') {
                    $sql = "SELECT * FROM answer WHERE answer_id = ?;";
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetch();
               }

               // Select all answer posted by specific user.
               if ($criteria[0] == 'U') {
                    $sql = "SELECT * FROM answer WHERE user_id = ?;";
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetchAll();
               }
          }
     }

     protected function getAnswerCount($criteria)
     {
          if ($criteria) {
               if ($criteria[0] == 'Q') {
                    $sql = "SELECT COUNT(answer_id) FROM answer a
                              WHERE question_id = ?;";
               }
               if ($criteria[0] == 'U') {
                    $sql = "SELECT COUNT(answer_id) FROM answer a
                              WHERE `user_id` = ?;";
               }

               $stmt = $this->executeQuery($sql, [$criteria]);
               $result = $stmt->fetch();
               return $result['COUNT(answer_id)'];
          }
     }
}
