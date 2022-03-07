<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php'?>
     <title>Ask Question | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/askQuestion.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="ask-question--main main-content">
               <h2 class="ask-question__title main-title">Ask Question</h2>
                   <div class="panel dialog">
                         <form class="question__form" method="POST">
                              <div class="section title">
                                   <p class="input-header">Title</p>
                                   <p class="askquestion__err-msg--title empty-input"></p>
                                   <input type="text" id="title" name="title" placeholder="e.g. How to solve question ..." class="input-box question" maxlength="100">
                              </div>
                              <div class="section body">
                                   <p class="input-header">Body</p>
                                   <p class="askquestion__err-msg--content empty-input"></p>
                                   <textarea id="content" name="content" placeholder="Description of the question ..." class="input-box content"></textarea>
                              </div>
                              <div class="section tag">
                                   <p class="input-header">Tags</p>
                                   <p class="askquestion__err-msg--tag empty-input"></p>
                                   <input type="text" id="tag" name="tag" placeholder="e.g. Physics, Mathematics, Science, ..." class="input-box">
                              </div>
                              <div class="btn-container">
                                   <button type="submit" class="post_question_btn">Post Question</button>  
                              </div>
                         </form>               
                    </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/askQuestion.js"></script>
</body>

</html>