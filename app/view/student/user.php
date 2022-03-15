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
     <title>User | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/user.css?v=<?php echo time(); ?>">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="user--main main-content">
               <h2 class="user__title">Users</h2>
               
               <div class="user_dashboard">
                    <div class="user_container"> 

                         <?php $userList = $user->read(); ?>
                         <?php foreach ($userList as $user) : ?>
                              <div class="user_box" id="<?php echo htmlspecialchars($user['user_id']) ?>" data-user-id=<?php echo htmlspecialchars($user['user_id']) ?>>
                                   <a class="user_info" href="profile.php?id=#">
                                        <img class="user_img" src="https://wac-cdn.atlassian.com/dam/jcr:ba03a215-2f45-40f5-8540-b2015223c918/Max-R_Headshot%20(1).jpg?cdnVersion=231" alt="user_img">
                                        <div class="user_info-detail">    
                                             <p class="user_name"><?php echo htmlspecialchars($user['username']) ?></p>
                                             <p class="RP">RP: <?php echo $user['point'] ?></p>
                                        </div>
                                   </a>
                              </div>
                         <?php endforeach; ?>
                         
                    </div>  
               </div>
               <nav class="home__main-nav">
                    <button class="home__main-nav-btn">
                         <a class="home__main-nav-link dialog" href="#">Back</a>
                    </button>
                    <p class="home__main-nav-page">1</p>
                    <button class="home__main-nav-btn">
                         <a class="home__main-nav-link dialog" href="#">Next</a>
                    </button>
               </nav>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>