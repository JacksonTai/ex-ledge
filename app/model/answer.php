<?php

namespace Model;

class Answer extends \config\DbConn
{
     private $postData = [];
     private $errMsg = [
          'title' => '',
          'content' => '',
          'tag' => '',
     ];

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

     protected function readAnswer($criteria)
     {
          if ($criteria && $criteria[0] == 'Q') {
               $sql = "SELECT * FROM answer a
                         WHERE question_id = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               return $stmt->fetchAll();
          }
     }

     protected function getAnswerCount($criteria)
     {
          if ($criteria && $criteria[0] == 'Q') {
               $sql = "SELECT COUNT(answer_id) FROM answer a
                         WHERE question_id = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $result = $stmt->fetch();
               return $result['COUNT(answer_id)'];
          }
     }
}
