<?php

namespace Model;

class Vote extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          $this->postData = $postData;
          if ($postData['id'][0] == 'Q') {
               $prevVotes = $this->getPrevVote($postData['userId'], 'question');
          }
          if ($postData['id'][0] == 'A') {
               $prevVotes = $this->getPrevVote($postData['userId'], 'answer');
          }

          // Check if user has voted the same question or answer before.
          foreach ($prevVotes as $prevVote) {

               if ($postData['id'][0] == 'Q' && $prevVote['question_id'] == $postData['id']) {

                    // Update previous vote type.
                    if ($prevVote['vote'] != $postData['voteType']) {
                         $this->updatePrevVote();
                         return;
                    }

                    // Delete previous vote.
                    $this->deletePrevVote();
                    return;
               }

               if ($postData['id'][0] == 'A' && $prevVote['answer_id'] == $postData['id']) {

                    // Update previous vote type.
                    if ($prevVote['vote'] != $postData['voteType']) {
                         $this->updatePrevVote();
                         return;
                    }

                    // Delete previous vote.
                    $this->deletePrevVote();
                    return;
               }
          }

          $this->createVote();
     }

     protected function createVote()
     {
          if ($this->postData['id'][0] == 'Q') {
               $sql = "INSERT INTO vote_question VALUES (?, ?, ?);";
          }
          if ($this->postData['id'][0] == 'A') {
               $sql = "INSERT INTO vote_answer VALUES (?, ?, ?);";
          }
          $this->executeQuery($sql, [
               $this->postData['id'],
               $this->postData['userId'],
               $this->postData['voteType']
          ]);
     }

     protected function getPoint($id)
     {
          if ($id[0] == 'Q') {
               $sql = "SELECT `point` FROM question WHERE question_id = ?";
          }
          if ($id[0] == 'A') {
               $sql = "SELECT `point` FROM answer WHERE answer_id = ?";
          }
          $stmt = $this->executeQuery($sql, [$id]);
          return $stmt->fetch();
     }

     /**
      * This function helps to get previous voting of user.
      * @param string $userId 
      * @param string $voteFor [question | answer]
      */
     protected function getPrevVote($userId, $voteFor, $id = null)
     {
          if ($voteFor == 'question') {
               // Get pevious vote for all question of user.
               $sql = "SELECT * FROM vote_question WHERE `user_id` = ?;";

               // Get previous vote for specific question of user.
               if ($id) {
                    $sql = "SELECT * FROM vote_question WHERE `user_id` = ?
                              AND question_id = ?;";
                    $stmt = $this->executeQuery($sql, [$userId, $id]);
                    return $stmt->fetch();
               }
          }
          if ($voteFor == 'answer') {
               // Get pevious vote for all answer of user.
               $sql = "SELECT * FROM vote_answer WHERE `user_id` = ?;";

               // Get previous vote for specific answer of user.
               if ($id) {
                    $sql = "SELECT * FROM vote_answer WHERE `user_id` = ?
                              AND answer_id = ?;";
                    $stmt = $this->executeQuery($sql, [$userId, $id]);
                    return $stmt->fetch();
               }
          }
          $stmt = $this->executeQuery($sql, [$userId]);
          return $stmt->fetchAll();
     }

     protected function updatePrevVote()
     {
          if ($this->postData['id'][0] == 'Q') {
               $sql =  "UPDATE vote_question SET vote = ?
                         WHERE `user_id` = ? AND question_id = ?;";
          }
          if ($this->postData['id'][0] == 'A') {
               $sql = "UPDATE vote_answer SET vote = ?
                         WHERE `user_id` = ? AND answer_id = ?;";
          }
          $this->executeQuery($sql, [
               $this->postData['voteType'],
               $this->postData['userId'],
               $this->postData['id']
          ]);
     }

     protected function deletePrevVote()
     {
          if ($this->postData['id'][0] == 'Q') {
               $sql =  "DELETE FROM vote_question  
                         WHERE `user_id` = ? AND question_id = ?;";
          }
          if ($this->postData['id'][0] == 'A') {
               $sql =  "DELETE FROM vote_answer 
                         WHERE `user_id` = ? AND answer_id = ?;";
          }
          $this->executeQuery($sql, [
               $this->postData['userId'],
               $this->postData['id']
          ]);
     }
}
