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
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/user.css?v=<?php echo time(); ?>">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="user--main main-content">
               <h2 class="user__title">Users</h2>
               <!-- <p><?= $_SESSION['userId']; ?></p> -->
               
               <div class="user_dashboard">
                    <div class="user_container">
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                         <div class="user_box">
                              <div class="user_info">
                                   <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <p class="user_name">changyongg</p>
                                   <p class="RP">RP: 213</p>
                              </div>
                         </div>
                    </div>
                    
               </div>
               <div class="page-nav_container">
                    <div class="page_nav">
                         <button class="pre_nav_btn">Prev</button>
                         <p class="nav_num">2</p>
                         <button class="next_nav_btn">Next</button>
                    </div>
               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>