<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>User | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/user.css?v=<?php echo time(); ?>">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="user--main main-content">
               <h2 class="user__title">Users</h2>
               <!-- <p><?= $_SESSION['userId']; ?></p> -->
               
               <div class="container">
                    <div class="user-dashboard">
                         <div class="user-container">
                              <div class="long_box">
                                   <div class="l_box">
                                        <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                        <p class="username">changyongg</p>
                                        <p class="user_id">U19320as932</p>
                                        <div class="second_long_box">
                                             <div class="second_l_box">
                                                  <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                                  <p class="username">changyongg</p>
                                                  <p class="user_id">U19320as932</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231g" alt="top img">
                                        <p class="username">changyongg</p>
                                        <p class="user_id">U19320as932</p>
                                        <div class="second_long_box">
                                             <div class="second_l_box">
                                                  <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                                  <p class="username">changyongg</p>
                                                  <p class="user_id">U19320as932</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                        <p class="username">changyongg</p>
                                        <p class="user_id">U19320as932</p>
                                        <div class="second_long_box">
                                             <div class="second_l_box">
                                                  <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                                  <p class="username">changyongg</p>
                                                  <p class="user_id">U19320as932</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                        <p class="username">changyongg</p>
                                        <p class="user_id">U19320as932</p>
                                        <div class="second_long_box">
                                             <div class="second_l_box">
                                                  <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                                  <p class="username">changyongg</p>
                                                  <p class="user_id">U19320as932</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              

                              <div class="page_nav">
                                   <button class="pre_nav_btn">Prev</button>
                                   <p class="nav_num">2</p>
                                   <button class="next_nav_btn">Next</button>
                              </div>
                              <div class="side_chat">
                                   <button class="chat_btn">Chat&nbsp;&nbsp;<img class="chat_img" src="<?php echo $path; ?>public/img/chat.jpg" alt="chat"></button>
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