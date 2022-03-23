<?php

namespace Model;

class Vote extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          $this->postData = $postData;

          // Get previous vote of the question or answer.
          if ($postData['id'][0] == 'Q') {
               $prevVotes = $this->getPrevVote($postData['userId'], 'question');
          }
          if ($postData['id'][0] == 'A') {
               $prevVotes = $this->getPrevVote($postData['userId'], 'answer');
          }

          foreach ($prevVotes as $prevVote) {

               // Check if user has voted the same question or answer before.
               if (($postData['id'][0] == 'Q' && $prevVote['question_id'] == $postData['id']) ||
                    ($postData['id'][0] == 'A' && $prevVote['answer_id'] == $postData['id'])
               ) {

                    // Update previous vote type if the value is different.
                    if ($prevVote['vote'] != $postData['voteType']) {
                         $this->updatePrevVote();

                         // Update point for counter vote (from downvote to upvote with one click).
                         $postData['voteType'] ? $this->updatePoint(2) : $this->updatePoint(-2);
                         $this->updateUserPoint($postData['id']);
                         return;
                    }

                    // Delete previous vote.
                    $this->deletePrevVote();

                    // Update point for diselecting downvote or upvote.
                    $postData['voteType'] ? $this->updatePoint(-1) : $this->updatePoint(1);
                    $this->updateUserPoint($postData['id']);
                    return;
               }
          }

          $this->createPrevVote();
          // Update point for new downvote or upvote.
          $postData['voteType'] ? $this->updatePoint(1) : $this->updatePoint(-1);
          $this->updateUserPoint($postData['id']);
     }

     protected function createPrevVote()
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
      * This function updates the point of question or answer.
      * @param int $value  
      */
     private function updatePoint($value)
     {
          if ($this->postData['id'][0] == 'Q') {
               $sql = "UPDATE question SET `point` = `point` + ? 
                         WHERE question_id = ?";
          }
          if ($this->postData['id'][0] == 'A') {
               $sql = "UPDATE answer SET `point` = `point` + ? 
                         WHERE answer_id = ?";
          }
          $this->executeQuery($sql, [$value, $this->postData['id']]);
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

     private function updatePrevVote()
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

     /**
      * This function read and set the user point.
      * @param string $id  
      * Answer or question ID
      */
     protected function updateUserPoint($id)
     {
          // Get the detail of the question or answer poster using question or answer ID.
          $user = new \Controller\User();
          $posterDetail = $user->read($id);

          // Get the total point of question or answer poster.
          $poster = new \Controller\User($posterDetail['user_id']);
          $posterPoint = $poster->readPoint($posterDetail['user_id']);

          $poster->setPoint($posterPoint);
     }

     private function deletePrevVote()
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
