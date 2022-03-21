<?php
session_start();
require '../../helper/redirector.php';
require '../../helper/autoloader.php';
$path = '../../../';

$questions = new \Controller\Question();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Manage Q&A | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/manageQA.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="manageQA--main main-content">
               <h2 class="manageQA__title main-title">Manage Q&A</h2>
               <?php
               foreach ($questions->read() as $question) {
                    include '../layout/question.php';
               }
               ?>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>