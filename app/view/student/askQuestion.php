<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Ask Question | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/askQuestion.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="ask-question--main main-content">
               <h2 class="ask-question__title main-title">Ask Question</h2>
               <p><?= $_SESSION['userId']; ?></p>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>