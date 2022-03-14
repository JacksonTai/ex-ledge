<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$user = new Controller\User();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Profile | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/profile.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

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
                              <?php $userInfo = $user->read($_SESSION['userId']); ?>
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
                                   <?php if (isset($userInfo['verification'])) : ?>
                                        <?php if ($userInfo['verification']) : ?>
                                             Verified
                                        <?php elseif (!$userInfo['verification']) : ?>
                                             Unverified
                                             <a class="profile__banner-verify-link">(Verify)</a>
                                        <?php endif; ?>
                                   <?php else : ?>
                                        N/A
                                   <?php endif; ?>

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
                         <form class="edit-profile-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                              <div class="edit-profile-form__item">
                                   <label for="username">Username</label>
                                   <input class="edit-profile__input" type="text" name="username" id="username" placeholder="Enter new username" value="<?php echo htmlspecialchars($userInfo['username']); ?>">
                              </div>
                              <div class="edit-profile-form__item">
                                   <label for="age">Age</label>
                                   <input class="edit-profile__input" type="text" name="age" id="age" placeholder="Enter new age" value="<?php echo htmlspecialchars($userInfo['age'] ?? ''); ?>">
                              </div>
                              <div class="edit-profile-form__item">
                                   <label for="gender">Gender</label>
                                   <select class="edit-profile__input" name="gender" id="gender">
                                        <?php if (!$userInfo['gender']) : ?>
                                             <option selected disabled>Select gender</option>
                                        <?php endif; ?>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                   </select>
                              </div>
                              <button class="edit-profile-form__btn" type="submit" name="edit-profile">Update</button>
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
                              <button class="modal__delete-account-btn btn--red modal__delete-account-btn--disabled">Delete Account</button>
                         </div>
                    </div>
               </div>
               <div class="modal-overlay modal-overlay--verify-account">
                    <div class="modal modal--verify-account">
                         <header class="modal__header modal__header--verify-account">
                              <button class="modal__close-btn">&#10006;</button>
                              <h2 class="modal__title">Verify Account</h2>
                         </header>
                         <form method="POST">

                         </form>
                    </div>
               </div>

               <!-- Section -->
               <section class="profile-section profile-section--overview profile-section-selected--flex">
                    <div class="profile-section__overview--about dialog">
                         <h2>About</h2>
                         <p>
                              <?php echo htmlspecialchars($userInfo['bio'] ??
                                   ucfirst($userInfo['username']) . "'s about me section is currently empty.")
                              ?>
                         </p>
                    </div>
                    <div class="profile-section__overview--stats dialog">
                         <h2>Stats</h2>
                         <p class="profile__content-label">
                              <span>Reputation Point: </span>
                         </p>
                         <p class="profile__content-label">
                              <span>Questions: </span>
                         </p>
                         <p class="profile__content-label">
                              <span>Answers: </span>
                         </p>
                    </div>
               </section>

               <section class="profile-section profile-section--question">

               </section>

               <section class="profile-section profile-section--answer">

               </section>

               <section class="profile-section profile-section--bookmark">

               </section>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/profile.js"></script>
</body>

</html>