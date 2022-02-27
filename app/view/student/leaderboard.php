<?php
session_start();
require '../../helper/redirector.php';
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
               <div class="container">
                    <div class="leaderboard-dashboard">
                         
                         <div class="leaderboard-container">
                              
                              <!-- top 3 -->
                              <div class="s_box">
                                   <div class="top2-s_half_box">
                                        <p class="pt">1123 pt</p>
                                        <img class="top_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="top img">
                                        <h3>changyongg</h3>
                                   </div>
                              </div>

                              <div class="s_box">
                                   <div class="top1-s_half_box">
                                        <p class="pt">1123 pt</p>
                                        <img class="top_img" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="top img">
                                        <h3>changyongg</h3>
                                   </div>
                              </div>

                              <div class="s_box">
                                   <div class="top3-s_half_box">
                                        <p class="pt">1123 pt</p>
                                        <img class="top_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                        <h3>changyongg</h3>
                                   </div>
                              </div>
                         </div>

                         <div class="allranking-container">
                              <!-- all ranking -->
                              <div class="rank_tag">
                                   <p class="no_tag">No</p>
                                   <p class="user_tag">Users</p>
                                   <p class="point_tag">Point</p>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <p class="rank_no">1</p>
                                        <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                        <p class="rank_name">changyongg</p>
                                        <p class="rank_pt">1123</p>
                                        <button class="view_profile_btn">View Profile</button>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <p class="rank_no">2</p>
                                        <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                        <p class="rank_name">changyongg</p>
                                        <p class="rank_pt">1123</p>
                                        <button class="view_profile_btn">View Profile</button>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <p class="rank_no">3</p>
                                        <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                        <p class="rank_name">changyongg</p>
                                        <p class="rank_pt">1123</p>
                                        <button class="view_profile_btn">View Profile</button>
                                   </div>
                              </div>

                              <div class="long_box">
                                   <div class="l_box">
                                        <p class="rank_no">4</p>
                                        <img class="rank_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlIy4kRyqQYE-eyQQEMvkgyyDv0IEHECKuNQ&usqp=CAU" alt="top img">
                                        <p class="rank_name">changyongg</p>
                                        <p class="rank_pt">1123</p>
                                        <button class="view_profile_btn">View Profile</button>
                                   </div>
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