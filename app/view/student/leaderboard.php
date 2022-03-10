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
     <title>Leaderboard | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/leaderboard.css?v=<?php echo time(); ?>">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="leaderboard--main main-content">
               <h2 class="leaderboard__title">Leaderboard</h2>
               <div class="leaderboard_dashboard">
                    <div class="leaderboard_container">
                         <div class="top_box top2_box">
                              <div class="top2-s_half_box">
                                   <p class="pt">1123 pt</p>
                                   <img class="top_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                   <h3>changyongg</h3>
                              </div>
                         </div>
                         <div class="top_box top1_box">
                              <div class="top1-s_half_box">
                                   <p class="pt">1123 pt</p>
                                   <img class="top_img" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="top img">
                                   <h3>changyongg</h3>
                              </div>
                         </div>
                         <div class="top_box top3_box">
                              <div class="top3-s_half_box">
                                   <p class="pt">1123 pt</p>
                                   <img class="top_img" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="top img">
                                   <h3>changyongg</h3>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="rank-tag_container">
                    <div class="rank_tag">
                         <p class="no_tag">No</p>
                         <p class="user_tag">Users</p>
                         <p class="point_tag">Point</p>
                    </div>
               </div>
               <div class="all-ranking_dashboard">
                    <div class="all-ranking_container">
                         <div class="l_box">
                              <div class="user_info">
                                   <p class="rank_no">1</p>
                                   <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                   <p class="rank_name">changyongg</p>
                                   <p class="rank_pt">1123</p>
                                   <button class="view_profile_btn">View Profile</button>
                              </div>
                         </div>
                         <div class="l_box">
                              <div class="user_info">
                                   <p class="rank_no">1</p>
                                   <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                   <p class="rank_name">changyongg</p>
                                   <p class="rank_pt">1123</p>
                                   <button class="view_profile_btn">View Profile</button>
                              </div>
                         </div>
                         <div class="l_box">
                              <div class="user_info">
                                   <p class="rank_no">1</p>
                                   <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                   <p class="rank_name">changyongg</p>
                                   <p class="rank_pt">1123</p>
                                   <button class="view_profile_btn">View Profile</button>
                              </div>
                         </div>
                         <div class="l_box">
                              <div class="user_info">
                                   <p class="rank_no">1</p>
                                   <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                   <p class="rank_name">changyongg</p>
                                   <p class="rank_pt">1123</p>
                                   <button class="view_profile_btn">View Profile</button>
                              </div>
                         </div>
                    </div>
               <div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>