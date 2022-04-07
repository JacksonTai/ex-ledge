<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     if (
          isset($_GET['acceptId']) ||
          isset($_GET['status']) ||
          isset($_GET['questionId']) ||
          isset($_GET['deleteId'])
     ) {
          session_start();
          include '../helper/autoloader.php';
     }
}

class Answer extends \Model\Answer
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($criteria = null, $status = null)
     {
          return $this->readAnswer($criteria, $status);
     }

     public function answerCount($criteria = null)
     {
          return $this->getAnswerCount($criteria);
     }

     public function accepted()
     {
          return $this->getAcceptedAns();
     }

     public function update($postData)
     {
          $this->updateAnswer($postData);
     }

     public function updateStatus($answerId)
     {
          return $this->updateAnswerStatus($answerId);
     }

     public function delete($deleteId)
     {
          return $this->deleteAnswer($deleteId);
     }
}

if (isset($_GET['questionId'], $_GET['status'])) {
     $answer = new \Controller\Answer();
     echo json_encode($answer->read($_GET['questionId'], $_GET['status']));
}

if (isset($_GET['acceptId'])) {
     $answer = new \Controller\Answer();
     print_r($answer->updateStatus($_GET['acceptId']));
}

if (isset($_GET['deleteId'])) {
     $answer = new \Controller\Answer();
     $answer->delete($_GET['deleteId']);
}
