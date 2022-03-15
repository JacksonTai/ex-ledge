<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>User Verification | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/userVerification.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="user-verification--main main-content">
               <h2 class="user-verification__title main-title">User Verification</h2>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">1</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">2</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">3</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">4</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">10</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
               <div class="user-verification-wrapper">
                    <div class="user-verification dialog">
                         <h3 class="user-verification--no">100</h3>
                         <div class="user-verification-content-container">
                              <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                              <div class="user-verification-content">
                                   <p class="user-verification--full-name">
                                        <span class="user-verification__label">Full name: </span>
                                        Jonathan
                                   </p>
                                   <p class="user-verification--ic-num">
                                        <span class="user-verification__label">NRIC: </span>
                                        123456-78-9100
                                   </p>
                              </div>
                         </div>
                         <div class="user-verification-btn-container">
                              <button class="user-verification-btn user-verification-btn--accept">Accept</button>
                              <button class="user-verification-btn user-verification-btn--reject">Reject</button>
                         </div>
                    </div>
               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>