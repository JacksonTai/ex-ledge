<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
     session_start();
     include '../helper/autoloader.php';
}

class Comment extends \Model\Comment
{
     public function __construct($postData = null)
     {
          $postData ? parent::__construct($postData) : '';
     }

     public function read($criteria)
     {
          return $this->readComment($criteria);
     }
}

!empty($_POST) ? new \Controller\Comment($_POST) : null;

if (isset($_GET['replyId'])) {
     $comment = new \Controller\Comment();
     echo json_encode($comment->read($_GET['replyId']));
}
