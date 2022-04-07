<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$answer = new \Controller\Answer();
$ansInfo = isset($_GET['id']) ? $answer->read($_GET['id']) : null;
if (!empty($_POST)) {
     $answer->update($_POST);
     header("location:../student/question.php?id=" . $ansInfo[0]['question_id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title> Edit Answer | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/sidebar.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/editAnswer.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="edit-question--main main-content">

               <h2 class="edit-question__title main-title">Edit Answer</h2>
               <form class="edit-question__post-ans-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id=" . $ansInfo['question_id']) ?>" method="POST">
                    <textarea class="edit-question__post-ans-input" name="content" placeholder="Your answer goes here..." required><?php echo htmlspecialchars($ansInfo['content']) ?></textarea>
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($_SESSION['userId']); ?>">
                    <input type="hidden" name="answerId" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                    <div class="edit-ans__btn-container">
                         <button class="edit-question__back-btn" type="button">
                              <a class="edit-question__back-link" href="../student/question.php?id=<?php echo htmlspecialchars($ansInfo['question_id']) ?>#<?php echo htmlspecialchars($ansInfo['answer_id']) ?>">Back</a>
                         </button>
                         <button class="edit-question__post-ans-btn" name="editAns" type="submit">Confirm</button>
                    </div>
               </form>

          </main>

          <?php include '../layout/sidebar.php'; ?>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <!-- <script src="<?php echo $path; ?>public/js/student/question.js"></script> -->
</body>

</html>