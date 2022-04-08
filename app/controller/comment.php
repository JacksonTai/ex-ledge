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

     public function read($criteria, $userId)
     {
          return $this->readComment($criteria, $userId);
     }

     public function update($commentId, $content)
     {
          $this->updateComment($commentId, $content);
     }

     public function delete($commentId)
     {
          $this->deleteComment($commentId);
     }
}

!empty($_POST) ? new \Controller\Comment($_POST) : null;

if (isset($_GET['replyId'])) {
     $comment = new \Controller\Comment();
     echo json_encode($comment->read($_GET['replyId'], $_GET['userId']));
}

if (isset($_GET['id'], $_GET['content'])) {
     $comment = new \Controller\Comment();
     $comment->update($_GET['id'], $_GET['content']);
}

if (isset($_GET['deleteId'])) {
     $comment = new \Controller\Comment();
     $comment->delete($_GET['deleteId']);
}
