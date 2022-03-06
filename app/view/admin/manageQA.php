<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Manage Q&A | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/manageQA.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="manageQA--main main-content">
               <h2 class="manageQA__title main-title">Manage Q&A</h2>

               <div class="panel dialog">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question">
                         <div class="question-headers">
                              <div class="question-caption">
                                   <p class="question-title">Is Ex-Ledge the best?</p>
                                   <p class="question-age">19 mins ago</p>
                              </div>
                              <div class="button">
                                   <button class="button-answer">
                                        <p>12 Answers</p>
                                   </button>

                                   <button class="button-remove">
                                        <p>Remove</p>
                                   </button>
                              </div>
                         </div>
                         <div class="question-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                         </div>
                         <div class="question-footer">
                              <div class="question-owner">
                                   <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                                   <p class="posted-by">Posted by&nbsp</p>
                                   <p class="owner">Mike Wazowski</p>
                              </div>
                              <div class="remove-button-mobile">
                                   <i class="fa-solid fa-trash-can"></i>
                                   <p class="remove-text">Remove</p>
                              </div>

                         </div>
                    </div>
               </div>

               <div class="panel dialog">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question">
                         <div class="question-headers">
                              <div class="question-caption">
                                   <p class="question-title">Is Ex-Ledge the best?</p>
                                   <p class="question-age">19 mins ago</p>
                              </div>
                              <div class="button">
                                   <button class="button-answer">
                                        <p>12 Answers</p>
                                   </button>

                                   <button class="button-remove">
                                        <p>Remove</p>
                                   </button>
                              </div>
                         </div>
                         <div class="question-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                         </div>
                         <div class="question-footer">
                              <div class="question-owner">
                                   <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                                   <p class="posted-by">Posted by&nbsp</p>
                                   <p class="owner">Mike Wazowski</p>
                              </div>
                              <div class="remove-button-mobile">
                                   <i class="fa-solid fa-trash-can"></i>
                                   <p class="remove-text">Remove</p>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="panel dialog">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question">
                         <div class="question-headers">
                              <div class="question-caption">
                                   <p class="question-title">Is Ex-Ledge the best?</p>
                                   <p class="question-age">19 mins ago</p>
                              </div>
                              <div class="button">
                                   <button class="button-answer">
                                        <p>12 Answers</p>
                                   </button>
                                   <button class="button-remove">
                                        <p>Remove</p>
                                   </button>
                              </div>
                         </div>
                         <div class="question-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                         </div>
                         <div class="question-footer">
                              <div class="question-owner">
                                   <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                                   <p class="posted-by">Posted by&nbsp</p>
                                   <p class="owner">Mike Wazowski</p>
                              </div>
                              <div class="remove-button-mobile">
                                   <i class="fa-solid fa-trash-can"></i>
                                   <p class="remove-text">Remove</p>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="panel dialog">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question">
                         <div class="question-headers">
                              <div class="question-caption">
                                   <p class="question-title">Is Ex-Ledge the best?</p>
                                   <p class="question-age">19 mins ago</p>
                              </div>
                              <div class="button">
                                   <button class="button-answer">
                                        <p>12 Answers</p>
                                   </button>
                                   <button class="button-remove">
                                        <p>Remove</p>
                                   </button>
                              </div>
                         </div>
                         <div class="question-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                         </div>
                         <div class="question-footer">
                              <div class="question-owner">
                                   <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                                   <p class="posted-by">Posted by&nbsp</p>
                                   <p class="owner">Mike Wazowski</p>
                              </div>
                              <div class="remove-button-mobile">
                                   <i class="fa-solid fa-trash-can"></i>
                                   <p class="remove-text">Remove</p>
                              </div>
                         </div>
                    </div>
               </div>

          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>