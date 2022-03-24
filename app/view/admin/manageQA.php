<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';
$questions = new \Controller\Question();
$answer = new \Controller\Answer();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Manage Q&A | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/manageQA.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="manageQA--main main-content">
               <h2 class="manageQA__title main-title">Manage Q&A</h2>
               <div id="question_container"></div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/adminQuestion.js"></script>
     <script src="<?php echo $path; ?>public/js/loadQuestion.js"></script>
</body>

</html>