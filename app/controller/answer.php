<?php

namespace Controller;

class Answer extends \Model\Answer
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }
}

!empty($_POST) ? new \Controller\Answer($_POST) : null;
