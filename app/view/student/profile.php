<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$user = new Controller\User();
$questions = new \Controller\Question();
$answer = new \Controller\Answer();
$bookmark = new \Controller\Bookmark();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Profile | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/answer.css">
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/profile.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="profile--main main-content">
               <section class="profile__banner dialog">
                    <div class="profile__banner-wrapper">
                         <?php if (!isset($_GET['id'])) : ?>
                              <div class="profile__banner-btn-container">
                                   <button class="profile__edit-btn">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span class="profile__edit-txt">Edit Profile</span>
                                   </button>
                                   <button class="profile__delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                        <span class="profile__delete-txt">Delete Account</span>
                                   </button>
                              </div>
                         <?php endif; ?>
                         <div class="profile__banner-header">
                              <?php
                              if (isset($_GET['id'])) {
                                   $userInfo = $user->read($_GET['id']);
                              }
                              if (!isset($_GET['id'])) {
                                   $userInfo = $user->read($_SESSION['userId']);
                              }
                              ?>
                              <img class="profile__img" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                              <h2 class="profile__username">
                                   <?php echo htmlspecialchars($userInfo['username']); ?>
                              </h2>
                         </div>
                         <div class="profile__banner-body">
                              <p class="profile__banner-content">
                                   <span class="profile__content-label">Email</span>
                                   <?php echo htmlspecialchars($userInfo['email']); ?>
                              </p>
                              <p class="profile__banner-content">
                                   <span class="profile__content-label">User ID: </span>
                                   <?php echo htmlspecialchars($userInfo['user_id']); ?>
                              </p>
                              <p class="profile__banner-content">
                                   <span class="profile__content-label">Age: </span>
                                   <?php echo htmlspecialchars($userInfo['age'] ?? 'N/A'); ?>
                              </p>
                              <p class="profile__banner-content">
                                   <span class="profile__content-label">Gender: </span>
                                   <?php echo htmlspecialchars($userInfo['gender'] ?? 'N/A'); ?>
                              </p>
                              <p class="profile__banner-content">
                                   <span class="profile__content-label">Verification Status: </span>
                                   <?php
                                   if (isset($userInfo['verification'])) {
                                        if ($userInfo['verification']) {
                                             echo 'Verified';
                                        }
                                        if (!$userInfo['verification']) {
                                             echo 'Unverified';
                                             if (!isset($_GET['id'])) {
                                                  echo '<a class="profile__banner-verify-link">(Verify)</a>';
                                             }
                                        }
                                   } else {
                                        echo 'N/A';
                                   }
                                   ?>
                              </p>
                         </div>
                    </div>
                    <nav class="profile__banner-navbar">
                         <button class="profile__banner-navbar-btn profile-btn-selected" data-section="overview">Overview</button>
                         <button class="profile__banner-navbar-btn" data-section="question">Question</button>
                         <button class="profile__banner-navbar-btn" data-section="answer">Answer</button>
                         <button class="profile__banner-navbar-btn" data-section="bookmark">Bookmark</button>
                    </nav>
               </section>

               <!-- Modal -->
               <div class="modal-overlay modal-overlay--edit-profile">
                    <div class="modal modal--edit-profile">
                         <header class="modal__header modal__header--edit-profile">
                              <button class="modal__close-btn">&#10006;</button>
                              <h2 class="modal__title">Edit Profile</h2>
                         </header>
                         <form class="edit-profile-form" method="POST">
                              <div class="edit-profile-form__item">
                                   <label for="username">Username</label>
                                   <p class="edit-profile__err-msg--username invalid-input"></p>
                                   <input class="edit-profile__input" type="text" name="username" id="username" placeholder="Enter new username" value="<?php echo htmlspecialchars($userInfo['username']); ?>">
                              </div>
                              <div class="edit-profile-form__item">
                                   <label for="age">Age</label>
                                   <p class="edit-profile__err-msg--age invalid-input"></p>
                                   <input class="edit-profile__input" type="number" name="age" id="age" placeholder="Enter new age" value="<?php echo htmlspecialchars($userInfo['age'] ?? ''); ?>" min="13" max="100">
                              </div>
                              <div class="edit-profile-form__item">
                                   <label for="gender">Gender</label>
                                   <p class="edit-profile__err-msg--gender invalid-input"></p>
                                   <select class="edit-profile__input" name="gender" id="gender">
                                        <?php if (!$userInfo['gender']) : ?>
                                             <option selected disabled>Select gender</option>
                                        <?php endif; ?>
                                        <option value="Male" <?php if (isset($userInfo['gender']) && $userInfo['gender'] == 'Male') {
                                                                      echo 'selected';
                                                                 } ?>>Male</option>
                                        <option value="Female" <?php if (isset($userInfo['gender']) && $userInfo['gender'] == 'Female') {
                                                                      echo 'selected';
                                                                 } ?>>Female</option>
                                   </select>
                              </div>
                              <button class="edit-profile-form__btn" name="updateProfile" type="submit">Update</button>
                         </form>
                    </div>
               </div>
               <div class="modal-overlay modal-overlay--delete-account">
                    <div class="modal modal--delete-account">
                         <header class="modal__header modal__header--delete-account">
                              <button class="modal__close-btn">&#10006;</button>
                              <h2 class="modal__title">Are you absolutely sure?</h2>
                         </header>
                         <div class="modal__content--delete-account">
                              <p class="modal__delete--txt">This action cannot be redone.
                                   This will permanently delete the
                                   <span class="delete__username">
                                        <?php echo htmlspecialchars($userInfo['username']); ?>
                                   </span>
                                   questions, answers, comments, chatting history and remove all related information.
                              </p>
                              <p class="modal__delete--txt">Please enter password to confirm.</p>
                              <input class="modal__delete-account-password" type="password" data-email="
                                   <?php echo htmlspecialchars($userInfo['email']); ?>" autocomplete="off">
                              <button class="modal__delete-account-btn btn--red modal__delete-account-btn--disabled">Yes, Delete my account.</button>
                         </div>
                    </div>
               </div>
               <div class="modal-overlay modal-overlay--verify-account">
                    <div class="modal modal--verify-account">
                         <header class="modal__header modal__header--verify-account">
                              <button class="modal__close-btn">&#10006;</button>
                              <?php if ($user->readVerification($_SESSION['userId'])) : ?>
                                   <h2 class="modal__title">
                                        We know you have been waiting.
                                   </h2>
                              <?php else : ?>
                                   <h2 class="modal__title">
                                        Verify Account
                                   </h2>
                              <?php endif; ?>
                         </header>
                         <?php if ($user->readVerification($_SESSION['userId'])) : ?>
                              <img class="verify-img" src="<?php echo $path; ?>public/img/verify.jpg" alt="">
                              <p class="verify-message">Don't worry, during the waiting period you can still sign in and use your Ex-Ledge account normally.</p>
                         <?php else : ?>
                              <form class="verify-form" method="POST">
                                   <div class="verify-form__item">
                                        <label for="fullName">
                                             <i class="fa-solid fa-user-tie"></i>
                                             Full Name (as per IC)
                                        </label>
                                        <p class="verify-form__err-msg verify-form__err-msg--full-name invalid-input"></p>
                                        <input class="verify__input" type="text" name="fullName" id="fullName" placeholder="Enter your full name">
                                   </div>
                                   <div class="verify-form__item">
                                        <label for="nric">
                                             <i class="fa-solid fa-id-card"></i>
                                             NRIC Number (with hypens)
                                        </label>
                                        <p class="verify-form__err-msg verify-form__err-msg--nric invalid-input"></p>
                                        <input class="verify__input" type="text" name="nric" id="nric" placeholder="Enter your NRIC number" maxlength="14">
                                   </div>
                                   <button class="verify-form__btn">Send Request</button>
                              </form>
                         <?php endif; ?>
                    </div>
               </div>

               <?php
               // Check if the user is viewing own or other's profile page.
               isset($_GET['id']) ? $userId = $_GET['id'] : $userId = $_SESSION['userId'];
               ?>

               <!-- Section -->
               <section class="profile-section profile-section--overview profile-section-selected--flex">
                    <div class="profile-section__overview--about dialog">
                         <div class="overview--about__header">
                              <h3 class="overview--about__title">About</h3>
                              <?php if (!isset($_GET['id'])) : ?>
                                   <i class="overview--about__edit-btn fa-solid fa-pen-to-square"></i>
                              <?php endif; ?>
                         </div>
                         <p class="overview--about__content" data-user-id="<?php echo htmlspecialchars($userInfo['user_id']); ?>">
                              <?php
                              if (!isset($userInfo['bio'])) {
                                   if (!isset($_GET['id'])) {
                                        echo 'Your';
                                   }
                                   if (isset($_GET['id'])) {
                                        echo htmlspecialchars(ucfirst($userInfo['username']) . "'s");
                                   }
                                   echo ' about me section is currently empty.';
                              }
                              if (isset($userInfo['bio'])) {
                                   echo htmlspecialchars($userInfo['bio']);
                              }
                              ?>
                         </p>
                         <textarea class="overview--about__bio-input" name="bio" placeholder="You can write about your sports or hobbies. People also talk about their favourite subjects to study."><?php echo htmlspecialchars($userInfo['bio'] ?? ''); ?></textarea>
                         <div class="overview--about__bio-btn-container">
                              <button class="overview--about__bio-cancel-btn">Cancel</button>
                              <button class="overview--about__bio-confirm-btn">Confirm</button>
                         </div>
                    </div>
                    <div class="profile-section__overview--stats dialog">
                         <h3 class="overview--stats__title">Stats</h3>
                         <p class="profile__content">
                              <span class="profile__content-label">Reputation Point: </span>
                              <?php echo htmlspecialchars($userInfo['point']); ?>
                         </p>
                         <p class="profile__content">
                              <span class="profile__content-label">Answer provided: </span>
                              <?php echo htmlspecialchars($answer->answerCount($userId)); ?>
                         </p>
                         <p class="profile__content">
                              <span class="profile__content-label">Question asked: </span>
                              <?php echo htmlspecialchars($questions->questionCount($userId)); ?>
                         </p>
                    </div>
               </section>

               <section class="profile-section profile-section--question">
                    <?php
                    foreach ($questions->read($userId) as $question) {
                         include '../layout/question.php';
                    }
                    ?>
               </section>

               <section class="profile-section profile-section--answer">
                    <?php
                    foreach ($answer->read($userId) as $userAns) {
                         include '../../view/layout/answer.php';
                    }
                    ?>
               </section>

               <section class="profile-section profile-section--bookmark">
                    <div class="bookmark-action-container dialog">
                         <div class="bookmark__action bookmark__action--question">
                              <i class="action--question-icon fa-solid fa-circle-question"></i>
                              <p>Question</p>
                         </div>
                         <div class="bookmark__action bookmark__action--ans">
                              <i class="action--ans-icon fa-solid fa-pen"></i>
                              <p>Answer</p>
                         </div>
                    </div>
                    <div class="bookmark-question-container">
                         <?php
                         foreach ($bookmark->read($userId) as $userBookmark) {
                              if ($userBookmark['id'][0] == 'Q') {
                                   $question = $questions->read($userBookmark['id'])[0];
                                   include '../../view/layout/question.php';
                              }
                         }
                         ?>
                    </div>

                    <div class="bookmark-answer-container hide">
                         <?php
                         foreach ($bookmark->read($userId) as $userBookmark) {
                              if ($userBookmark['id'][0] == 'A') {
                                   $userAns = $answer->read($userBookmark['id']);
                                   include '../../view/layout/answer.php';
                              }
                         }
                         ?>
                    </div>
               </section>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/profile.js"></script>
</body>

</html>