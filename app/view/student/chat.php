<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$user = new Controller\User();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Chat | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/chat.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="chat--main main-content">
               <section class="chat-section__chat-area">
                    <div class="chat-section__chat-area-header">
                         <button class="chat-section__back-btn">
                              <i class="fa-solid fa-arrow-left"></i>
                         </button>
                         <img class="chat-section__chat-area-header-img chat-profile-img" src="<?php echo $path; ?>public/img/profile1.jpg">
                         <h2 class="chat-section__chatting-username"></h2>
                    </div>
                    <div class="chat-section__chat-box">
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">Hello, this is incoming message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">Hello, this is incoming message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">Hello, this is incoming message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">Hello, this is incoming message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">Hello, this is incoming message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">Hello, this is outgoing message.</p>
                         </div>
                         <div class="chat-section__chat">
                              <p class="chat-section__chat-msg outgoing-msg">
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                              </p>
                         </div>
                         <div class="chat-section__chat">
                              <img class="chat-setion__user-msg-img chat-profile-img" src="../../../public/img/profile1.jpg">
                              <p class="chat-section__chat-msg incoming-msg">
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                                   Hello, this is outgoing message.
                              </p>
                         </div>
                    </div>
                    <div class="chat-section__typing-area">
                         <input class="chat-section__typing-box" type="text" placeholder="Type your message here...">
                         <button class="chat-section__send-msg-btn">
                              <i class="chat-section__send-msg-icon fab fa-telegram-plane"></i>
                         </button>
                    </div>
               </section>
               <section class="chat-section__user-list">
                    <div class="chat-section__user-search-wrapper">
                         <input class="chat-section__user-search-bar" type="text" name="user" id="" placeholder="Search user">
                         <button class="chat-section__user-search-btn">
                              <i class="fas fa-search"></i>
                         </button>
                    </div>
                    <div class="chat-section__user-container">
                         <?php $userList = $user->read(); ?>
                         <?php foreach ($userList as $user) : ?>
                              <div class="chat-section__user" id="<?php echo htmlspecialchars($user['user_id']) ?>" data-user-id=<?php echo htmlspecialchars($user['user_id']) ?>>
                                   <img class="chat-section__user-img chat-profile-img" src="<?php echo $path; ?>public/img/profile1.jpg">
                                   <div class="chat-section__user-content">
                                        <p class="chat-section__username"><?php echo htmlspecialchars($user['username']) ?></p>
                                        <p class="chat-section__user-msg">Hello</p>
                                   </div>
                              </div>
                         <?php endforeach; ?>
                    </div>
               </section>
          </main>

     </div>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/chat.js"></script>
</body>

</html>