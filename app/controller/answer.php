<?php

namespace Controller;

class Answer extends \Model\Answer
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($criteria = null)
     {
          return $this->readAnswer($criteria);
     }

     public function answerCount($criteria)
     {
          return $this->getAnswerCount($criteria);
     }
}
