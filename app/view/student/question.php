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
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="question--main main-content">
               <h2 class="question__title main-title">Put 'question title' as title</h2>

               <div class="question-poster">
                    <div class="picture"></div>
                    <div class="details">
                         <div class="name">ch</div>
                         <p class="date">69 second ago</p>
                    </div>
               </div>

               <div class="question-ctnt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </div>
               <div class="ui-grid">
                    <div class="votebox"></div>
                    <button class="report">Report</button>
                    <button class="bookmark">Bookmark</button>
               </div>

          </main>


          <?php include '../layout/trending-sidebar.php'; ?>
          
     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>