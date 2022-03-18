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
               $this->createAnswer();
               header("location:../student/question.php?id=" . $postData['questionId']);
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
     }
}
