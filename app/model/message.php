<?php

namespace Model;

class Message extends \config\DbConn
{
     private $postData = [];

     protected function __construct($postData)
     {
          if (!empty($postData)) {
               $this->postData = $postData;
               $this->insertMsg();
          }
     }

     private function insertMsg()
     {
          $msgId = uniqid('M');

          $sql = "INSERT INTO `message` VALUES (?, ?, ?, ?)";

          $this->executeQuery($sql, [
               $msgId,
               $this->postData['senderId'],
               $this->postData['receiverId'],
               $this->postData['msgContent'],
          ]);
     }

     protected function getMsg($getData)
     {
          // Query for selecting specific chat message between two users.
          $sql = "SELECT * FROM `message`
                         LEFT JOIN user ON user.user_id = message.outgoing_msg_id
                         WHERE outgoing_msg_id = ? AND incoming_msg_id = ?
                         OR outgoing_msg_id = ? AND incoming_msg_id = ? ";

          $stmt = $this->executeQuery($sql, [
               $getData['senderId'],
               $getData['receiverId'],
               $getData['receiverId'],
               $getData['senderId'],
          ]);
          $msgs = $stmt->fetchAll();
          $msgInfo = '';
          foreach ($msgs as $msg) {
               if ($msg['outgoing_msg_id'] == $getData['senderId']) {
                    $msgInfo .= '<div class="chat-section__chat">
                                   <p class="chat-section__chat-msg outgoing-msg">' . $msg['content'] . '</p>
                                 </div>';
               }
               if ($msg['outgoing_msg_id'] == $getData['receiverId']) {
                    $msgInfo .= '<div class="chat-section__chat">
                                   <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                                   <p class="chat-section__chat-msg incoming-msg">' . $msg['content'] . '</p>
                                 </div>';
               }
          }
          return $msgInfo;
     }
}
