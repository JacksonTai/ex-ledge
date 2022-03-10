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
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question-panel.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="manageQA--main main-content">
               <h2 class="manageQA__title main-title">Manage Q&A</h2>

               <?php include '../layout/question-panel.php'; ?>
               <?php include '../layout/question-panel.php'; ?>
               <?php include '../layout/question-panel.php'; ?>
               <?php include '../layout/question-panel.php'; ?>

          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>