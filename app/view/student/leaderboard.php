<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$ranking = new \Controller\User;
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
               <div class="leaderboard__podium-wrapper">
                    <?php $topThreeUsers = $ranking->readTopThree(); ?>
                    <a class="leaderboard__podium leaderboard__podium--1 dialog" href="profile.php?id=#">
                         <h3 class="leaderboard__podium-point"><?php echo htmlspecialchars($topThreeUsers[0]['point']); ?></h3>
                         <img class="leaderboard__podium-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="">
                         <p><?php echo htmlspecialchars($topThreeUsers[0]['username']); ?></p>
                    </a>
                    <a class="leaderboard__podium leaderboard__podium--2 dialog" href="profile.php?id=#">
                    <h3 class="leaderboard__podium-point"><?php echo htmlspecialchars($topThreeUsers[1]['point']); ?></h3>
                         <img class="leaderboard__podium-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="">
                         <p><?php echo htmlspecialchars($topThreeUsers[1]['username']); ?></p>
                    </a>
                    <a class="leaderboard__podium leaderboard__podium--3 dialog" href="profile.php?id=#">
                    <h3 class="leaderboard__podium-point"><?php echo htmlspecialchars($topThreeUsers[2]['point']); ?></h3>
                         <img class="leaderboard__podium-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="">
                         <p><?php echo htmlspecialchars($topThreeUsers[2]['username']); ?></p>
                    </a>
               </div>
               
               <div class="leaderboard__runner-up-wrapper">
                    <div class="leaderboard__runner-up-field">
                         <h3 class="leaderboard__runner-up-field--no">No</h3>
                         <h3 class="leaderboard__runner-up-field--user">Users</h3>
                         <h3 class="leaderboard__runner-up-field--point">Point</h3>
                    </div>

                    <?php  
                    $topTenUsers = $ranking->readTopTen(); 
                    $rankNumber = 4;
                    foreach ($topTenUsers as $user) {?>
                         <div class="leaderboard__runner-up dialog">
                              <p class="leaderboard__runner-up--no"><?php echo $rankNumber++; ?></p>
                              <div class="leaderboard__runner-up--user">
                                   <img class="leaderboard__runner-up--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                                   <p class="leaderboard__runner-up--username"><?php echo htmlspecialchars($user['username']); ?></p>
                              </div>
                              <p class="leaderboard__runner-up--point"><?php echo htmlspecialchars($user['point']); ?></p>
                              <button class="leaderboard__runner-up-btn">
                                   <a class="leaderboard__runner-up-link" href="profile.php?id=<?php echo htmlspecialchars($user['user_id']);?>">View Profile</a>
                              </button>
                         </div>
                    <?php } ?>

               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>