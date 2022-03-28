<?php

namespace Model;

class Bookmark extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          if (!empty($postData)) {
               $this->postData = $postData;

               // Check if user has bookmark question or answer before. 
               $bookmarks = $this->readBookmark($postData['userId']);

               foreach ($bookmarks as $bookmark) {
                    if ($postData['id'] == $bookmark['id']) {
                         $this->deleteBookmark($postData['id']);
                         return;
                    }
               }
               $this->createBookmark($postData['id']);
          }
     }

     private function createBookmark($bookmarkId)
     {
          if ($bookmarkId[0] == 'Q') {
               $sql = "INSERT INTO bookmark_question VALUES (?, ?);";
               $this->executeQuery($sql, [$this->postData['userId'], $bookmarkId]);
          }
          if ($bookmarkId[0] == 'A') {
               $sql = "INSERT INTO bookmark_answer VALUES (?, ?);";
               $this->executeQuery($sql, [$this->postData['userId'], $bookmarkId]);
          }
     }

     protected function readBookmark($criteria)
     {
          if ($criteria[0] == 'Q') {
               $sql = "SELECT * FROM bookmark_question
                         WHERE `user_id` = ? AND question_id = ?;";
          }
          if ($criteria[0] == 'A') {
               $sql = "SELECT * FROM bookmark_answer
                         WHERE `user_id` = ? AND question_id = ?;";
          }
          if ($criteria[0] == 'U') {
               $sql = "SELECT question_id id FROM bookmark_question WHERE `user_id` = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $bookmarkQn = $stmt->fetchAll();

               $sql = "SELECT answer_id id FROM bookmark_answer WHERE `user_id` = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $bookmarkAns = $stmt->fetchAll();

               return array_merge($bookmarkQn, $bookmarkAns);
          }
          $stmt = $this->executeQuery($sql, [$this->postData['userId'], $criteria]);
          return $stmt->fetchAll();
     }

     private function deleteBookmark($bookmarkId)
     {
          if ($bookmarkId[0] == 'Q') {
               $sql = "DELETE FROM bookmark_question
                         WHERE `user_id` = ? AND question_id = ?";
          }
          if ($bookmarkId[0] == 'A') {
               $sql = "DELETE FROM bookmark_answer
                         WHERE `user_id` = ? AND answer_id = ?";
          }
          $this->executeQuery($sql, [$this->postData['userId'], $bookmarkId]);
     }
}
