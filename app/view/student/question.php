<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$question = new \Controller\Question();
if (isset($_GET['id'])) {
     $questionInfo = $question->read($_GET['id'])[0];
     $timestamp = $question->get_time($questionInfo['time_posted']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title><?php echo htmlspecialchars($questionInfo['title']); ?> | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/question.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/sidebar.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="question--main main-content">
               <h2 class="question__title main-title"><?php echo htmlspecialchars($questionInfo['title']); ?></h2>
               <div class="question__user">
                    <img class="question__user-profile-img" src="../../../public/img/profile1.jpg" alt="Profile Image">
                    <div class="question__user-info">
                         <h3><?php echo htmlspecialchars($questionInfo['username']); ?></h3>
                         <p><?php echo htmlspecialchars($timestamp); ?></p>
                    </div>
               </div>
               <p class="question__content">
                    <?php echo htmlspecialchars($questionInfo['content']); ?>
               </p>
               <div class="question__action-container">
                    <div class="question__action question__action--vote">
                         <i class="fa-solid fa-arrow-up fa-lg"></i>
                         <p class="question__point">
                              <?php echo htmlspecialchars($questionInfo['point']); ?>
                         </p>
                         <i class="fa-solid fa-arrow-down fa-lg"></i>
                    </div>
                    <div class="question__action question__action--comment">
                         <i class="action--comment-icon fa-solid fa-comment"></i>
                         <p>Comment</p>
                    </div>
                    <div class="question__action question__action--bookmark">
                         <i class="action--bookmark-icon fa-solid fa-bookmark"></i>
                         <p>Bookmark</p>
                    </div>
                    <div class="question__action question__action--ans">
                         <i class="action--ans-icon fa-solid fa-pen"></i>
                         <p>Answer</p>
                    </div>
               </div>
               <div class="question__comment-container--question hide">
                    <div class="question__add-comment-container ">
                         <textarea class="question__add-comment-input" placeholder="Add a comment ..."></textarea>
                         <button class="question__add-comment-btn">Add comment</button>
                    </div>
               </div>
               <div class="question__post-ans-container">
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                         <textarea class="question__post-ans-input" name="ansContent" placeholder="Type here to answer <?php echo htmlspecialchars($questionInfo['username']); ?> ..."></textarea>
                         <input type="hidden" name="userId" value="<?php echo htmlspecialchars($questionInfo['user_id']); ?>">
                         <input type="hidden" name="questionId" value="<?php echo htmlspecialchars($questionInfo['question_id']); ?>">
                         <div class="post-ans__btn-container">
                              <button class="question__cancel-ans-btn" type="button">Cancel</button>
                              <button class="question__post-ans-btn" name="postAns" type="submit">Post Answer</button>
                         </div>
                    </form>
               </div>
               <p class="question__ans-num">Be the first person to answer this question.</p>
               <?php ?>
               <!-- <div class="question__ans-container">
                    <div class="question__user question__user--ans">
                         <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                         <div class="question__user-info">
                              <h4>Username</h4>
                              <p>3 days ago</p>
                         </div>
                    </div>
                    <p class="question__ans">
                         I had a second degree stroke trying to read your question.
                    </p>
                    <div class="question__action-container">
                         <div class="question__action question__action--vote">
                              <i class="fa-solid fa-arrow-up fa-lg"></i>
                              <p class="question__point">1</p>
                              <i class="fa-solid fa-arrow-down fa-lg"></i>
                         </div>
                         <div class="question__action question__action--comment">
                              <i class="action--comment-icon fa-solid fa-comment"></i>
                              <p>Comment</p>
                         </div>
                         <div class="question__action question__action--bookmark">
                              <i class="action--bookmark-icon fa-solid fa-bookmark"></i>
                              <p>Bookmark</p>
                         </div>
                    </div>
                    <textarea class="question__add-comment-input" placeholder="Add a comment ..."></textarea>
                    <button class="question__add-comment-btn">Add comment</button>
                    <div class="question__comment-container">
                         <div class="question__user question__user--comment">
                              <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                              <div class="question__user-info">
                                   <h4>Username</h4>
                                   <p class="question__comment">
                                        I had a second degree stroke trying to read your answer
                                   </p>
                              </div>
                         </div>
                    </div>
               </div> -->
          </main>

          <?php include '../layout/sidebar.php'; ?>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/question.js"></script>
</body>

</html>