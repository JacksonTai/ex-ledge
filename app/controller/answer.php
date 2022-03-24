<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     if (!isset($_GET['id'])) {
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

     public function answerCount($criteria)
     {
          return $this->getAnswerCount($criteria);
     }
}

if (isset($_GET['questionId'], $_GET['status'])) {
     $answer = new \Controller\Answer();
     echo json_encode($answer->read($_GET['questionId'], $_GET['status']));
}
