<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

!empty($_POST) ? new \Controller\Answer($_POST) : null;

$question = new \Controller\Question();
if (isset($_GET['id'])) {
     $questionInfo = $question->read($_GET['id'])[0];
     $timestamp = $question->get_time($questionInfo['time_posted']);
}
$answer = new \Controller\Answer();
$user = new \Controller\User();
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
                    <div class="question__action question__action--comment" data-reply-id="<?php echo htmlspecialchars($questionInfo['question_id']); ?>">
                         <i class="action--comment-icon fa-solid fa-comment"></i>
                         <p>Comment</p>
                    </div>
                    <div class="question__action question__action--bookmark">
                         <i class="action--bookmark-icon fa-solid fa-bookmark"></i>
                         <p>Bookmark</p>
                    </div>
                    <?php
                    $isAnswered = false;
                    $viewAnsLink = '../student/question.php?id=' . $questionInfo['question_id'] . '#ans-';

                    $answersInfo = $answer->read($questionInfo['question_id']);

                    foreach ($answersInfo as $answerInfo) {

                         if ($answerInfo['user_id'] == $_SESSION['userId']) {
                              $viewAnsLink .= $answerInfo['answer_id'];
                         }

                         $userInfo = $user->read($answerInfo['user_id']);
                         if ($userInfo['user_id'] == $_SESSION['userId']) {
                              $isAnswered = true;
                         }
                    }
                    ?>
                    <?php if ($_SESSION['userId'] != $questionInfo['user_id']) : ?>
                         <?php if (!$isAnswered) : ?>
                              <div class="question__action question__action--ans">
                                   <i class="action--ans-icon fa-solid fa-pen"></i>
                                   <p>Answer</p>
                              </div>
                         <?php elseif ($isAnswered) : ?>
                              <a class="question__action question__action--view-ans" href="<?php echo $viewAnsLink; ?>">
                                   <i class="action--view-ans-icon fa-solid fa-user-pen"></i>
                                   <p>My Answer</p>
                              </a>
                         <?php endif; ?>
                    <?php endif; ?>
               </div>
               <div class="question__add-comment-container ">
                    <textarea class="question__add-comment-input" placeholder="Add a comment ..."></textarea>
                    <div class="add-comment__btn-container">
                         <button class="question__cancel-comment-btn" type="button">Cancel</button>
                         <button class="question__add-comment-btn">Add comment</button>
                    </div>
               </div>
               <?php if ($_SESSION['userId'] != $questionInfo['user_id']) : ?>
                    <div class="question__post-ans-container">
                         <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                              <textarea class="question__post-ans-input" name="ansContent" placeholder="Type here to answer <?php echo htmlspecialchars($questionInfo['username']); ?> ..."></textarea>
                              <input type="hidden" name="userId" value="<?php echo htmlspecialchars($_SESSION['userId']); ?>">
                              <input type="hidden" name="questionId" value="<?php echo htmlspecialchars($questionInfo['question_id']); ?>">
                              <div class="post-ans__btn-container">
                                   <button class="question__cancel-ans-btn" type="button">Cancel</button>
                                   <button class="question__post-ans-btn" name="postAns" type="submit">Post Answer</button>
                              </div>
                         </form>
                    </div>
               <?php endif; ?>
               <p class="question__ans-num">
                    <?php
                    $answerNum = $answer->answerCount($questionInfo['question_id']);
                    if ($answerNum > 1) {
                         echo htmlspecialchars($answerNum . ' Answers');
                    } else if ($answerNum == 0 && $_SESSION['userId'] != $questionInfo['user_id']) {
                         echo 'Be the first person to answer this question.';
                    } else if ($answerNum == 0 || $answerNum == 1) {
                         echo htmlspecialchars($answerNum . ' Answer');
                    }
                    ?>
               </p>
               <?php $answersInfo = $answer->read($questionInfo['question_id']); ?>
               <?php foreach ($answersInfo as $answerInfo) : ?>
                    <?php $userInfo = $user->read($answerInfo['user_id']); ?>
                    <div class="question__ans-container" id="ans-<?php echo htmlspecialchars($answerInfo['answer_id']); ?>">
                         <div class="question__user question__user--ans">
                              <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                              <div class="question__user-info">
                                   <h4><?php echo htmlspecialchars($userInfo['username']); ?></h4>
                                   <p>3 days ago</p>
                              </div>
                              <?php if ($answerInfo['status'] == 1) : ?>
                                   <div class="question__best-answer">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>Best Answer</span>
                                   </div>
                              <?php endif; ?>
                         </div>
                         <p class="question__ans">
                              <?php echo htmlspecialchars($answerInfo['content']); ?>
                         </p>
                         <div class="question__action-container">
                              <div class="question__action question__action--vote">
                                   <i class="fa-solid fa-arrow-up fa-lg"></i>
                                   <p class="question__point">
                                        <?php echo htmlspecialchars($answerInfo['point']); ?>
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
                         </div>
                         <div class="question__add-comment-container ">
                              <textarea class="question__add-comment-input" placeholder="Add a comment ..."></textarea>
                              <div class="add-comment__btn-container">
                                   <button class="question__cancel-comment-btn" type="button">Cancel</button>
                                   <button class="question__add-comment-btn">Add comment</button>
                              </div>
                         </div>
                         <div class="question__comment-container">
                              <!-- <div class="question__user question__user--comment">
                                   <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                                   <div class="question__user-info">
                                        <h4>Username</h4>
                                        <p class="question__comment">
                                             I had a second degree stroke trying to read your answer
                                        </p>
                                   </div>
                              </div>
                              <div class="question__user question__user--comment">
                                   <img class="profile-icon" src="../../../public/img/profile1.jpg" alt="Profile Image">
                                   <div class="question__user-info">
                                        <h4>Username</h4>
                                        <p class="question__comment">
                                             I had a second degree stroke trying to read your answer
                                        </p>
                                   </div>
                              </div> -->
                         </div>
                    </div>
               <?php endforeach; ?>
          </main>

          <?php include '../layout/sidebar.php'; ?>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/question.js"></script>
</body>

</html>