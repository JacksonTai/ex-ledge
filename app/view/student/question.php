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
               <h1 class="question__title main-title">Title</h1>

               <div class="question-poster">
                    <div class="picture"></div>
                    <div class="details">
                         <div class="name">ch</div>
                         <p class="date">69 second ago</p>
                    </div>
               </div>


               <div class="question-ctnt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </div>
               


               <div class="ui-grid">
                    <div class="votebox">
                         <i class="fa-solid fa-arrow-up fa-lg up"></i>
                         <p class="score">1</p>
                         <i class="fa-solid fa-arrow-down fa-lg down"></i>
                    </div>
                    <button class="report">Report</button>
                    <button class="bookmark">Bookmark</button>
               </div>



               <!--does this need ajax? encapsulate in form if need be-->
               <textarea name="" id="" class="answerbox"></textarea>
               <div class="post-grid">
                    <button class="post-answer">Post Answer</button>
               </div>




               <h2 class="answer-count">1 answer</h2><hr>


               <!--container for every individual question.-->
               <div class="answer-ctnr">
                    <div class="answer-poster">
                         <div class="picture"></div>
                         <div class="details">
                              <span class="name">ch</span> 
                              <p class="date">69 second ago</p>
                         </div>
                         <!--best answer marker can be addded by just appending an empty span with class best-answer-->
                         <span class="best-answer"></span>
                    </div>

                    <div class="answer-content">asdhjjhasdjdjkhsadjkh</div>
                    <div class="ui-grid">
                         <div class="votebox">
                              <i class="fa-solid fa-arrow-up fa-lg up"></i>
                              <p class="score">1</p>
                              <i class="fa-solid fa-arrow-down fa-lg down"></i>
                         </div>
                         <button class="reply">Reply</button>
                         <button class="report">Report</button>
                    </div>

                    <div class="reply-box">

                         <div class="reply-ctnr">
                              <div class="replier-pic"></div>
                              <div class="reply-info">
                                   <div class="name">name</div>
                                   <div class="reply">sdfjkjklsdfjklsfdjklsdfjsdfljkhjkl</div>
                              </div>
                         </div>

                         <div class="reply-ctnr">
                              <div class="replier-pic"></div>
                              <div class="reply-info">
                                   <div class="name">name</div>
                                   <div class="reply">sdfjkjklsdfjklsfdjklsdfjsdfljkhjkl</div>
                              </div>
                         </div>
                    </div>


               </div>


               <div class="answer-ctnr">
                    <div class="answer-poster">
                         <div class="picture"></div>
                         <div class="details">
                              <span class="name">ch</span> 
                              <p class="date">69 second ago</p>
                         </div>

                    </div>

                    <div class="answer-content">asdhjjhasdjdjkhsadjkh</div>
                    <div class="ui-grid">
                         <div class="votebox">
                              <i class="fa-solid fa-arrow-up fa-lg up"></i>
                              <p class="score">1</p>
                              <i class="fa-solid fa-arrow-down fa-lg down"></i>
                         </div>
                         <button class="reply">Reply</button>
                         <button class="report">Report</button>
                    </div>
               </div>

               <div class="answer-ctnr">
                    <div class="answer-poster">
                         <div class="picture"></div>
                         <div class="details">
                              <span class="name">ch</span> 
                              <p class="date">69 second ago</p>
                         </div>
                    </div>
                    <div class="answer-content">asdhjjhasdjdjkhsadjkh</div>
                    <div class="ui-grid">
                         <div class="votebox">
                              <i class="fa-solid fa-arrow-up fa-lg up"></i>
                              <p class="score">1</p>
                              <i class="fa-solid fa-arrow-down fa-lg down"></i>
                         </div>
                         <button class="reply">Reply</button>
                         <button class="report">Report</button>
                    </div>
               </div>



          </main>


          <?php include '../layout/trending-sidebar.php'; ?>
          
     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>