<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>User | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/question.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/sidebar.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="question--main main-content">
               <h2 class="question__title main-title">What would you do when u okay so he said yes would go?</h2>
               <div class="question__user">
                    <img class="question__user-profile-img" src="../../../public/img/profile1.jpg" alt="Profile Image">
                    <div class="question__user-info">
                         <h3>Username</h3>
                         <p>3 days ago</p>
                    </div>
               </div>
               <p class="question__content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum
                    dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum
                    dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
               </p>
               <div class="question__action-container">
                    <div class="question__action question__action--vote">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p class="question__point">1</p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question__action question__action--bookmark">
                         <i class="action--bookmark-icon fa-solid fa-bookmark"></i>
                         <p>Bookmark</p>
                    </div>
               </div>
               <div class="question__post-answer-container">
                    <textarea class="question__post-answer-input" placeholder="Type here to answer 'username' ..."></textarea>
                    <button class="question__post-answer-btn">Post Answer</button>
                    <p class="question__answer-num">2 Answers</p>
               </div>
               <div class="question__answer-container">
                    <div class="question__user question__user--answer">
                         <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                         <div class="question__user-info">
                              <h3>Username</h3>
                              <p>3 days ago</p>
                         </div>
                         <div class="question__best-answer">
                              <i class="fa-solid fa-circle-check"></i>
                              <span>Best Answer</span>
                         </div>
                    </div>
                    <p class="question__answer">
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                         incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                         nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum
                         dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                         ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                         exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
               </div>
               <div class="question__answer-container">
                    <div class="question__user question__user--answer">
                         <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                         <div class="question__user-info">
                              <h3>Username</h3>
                              <p>3 days ago</p>
                         </div>
                    </div>
                    <p class="question__answer">
                         I had a second degree stroke trying to read your question.
                    </p>
               </div>
          </main>

          <?php include '../layout/sidebar.php'; ?>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>