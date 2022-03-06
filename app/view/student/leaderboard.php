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
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/leaderboard.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>
          <!-- Note: Every main content goes inside main tag, except for the sidebar on right side. (Delete once readed) -->
          <main class="leaderboard--main main-content">
               <h2 class="leaderboard__title main-title">Leaderboard</h2>
               <div class="podium">
                    <div class="contestant_ctnr">
                         <div class="picture"></div>
                         <div class="podium-label">
                              <p>sadads</p>
                         </div>
                    </div>
                    <div class="contestant_ctnr">
                         <div class="picture"></div>
                         <div class="podium-label">
                              <p>sadads</p>
                         </div>
                    </div>
                    <div class="contestant_ctnr">
                         <div class="picture"></div>
                         <div class="podium-label">
                              <p>sadads</p>
                         </div>
                    </div>
               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>