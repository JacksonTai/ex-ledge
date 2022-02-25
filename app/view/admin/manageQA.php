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
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="manageQA--main main-content">
               <h2 class="manageQA__title">Manage Q&A</h2>
               <p><?= $_SESSION['userId']; ?></p>

               <div class="panel">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down"></i>
                    </div>

                    <div class="question-headers">
                         <div class="question-caption">
                              <p class="question-title">Is Ex-Ledge the best?</p>
                              <p class="question-age">19 mins ago</p>
                         </div>
                         
                         <div class="button">

                              <button class="button-answer">
                                   <p>12 Answers</p>
                              </button>

                              <button class="button-remove">
                                   <p>Remove</p>
                              </button>
                              

                         </div>

                    </div>
               </div>

               <div class="panel">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down"></i>
                    </div>
               </div>

               <div class="panel">
                    <div class="vote-container">
                         <i class="fa-solid fa-arrow-up"></i>
                         <p>95</p>
                         <i class="fa-solid fa-arrow-down"></i>
                    </div>
               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>