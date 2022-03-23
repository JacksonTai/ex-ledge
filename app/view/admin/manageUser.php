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
     <title>Manage User | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/manageUser.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="manageUser--main main-content">

               <h2 class="manageUser__title main-title">Manage User</h2>
                    <div class="card-container" id="user_container">
                         <?php $userInfos = $user->read();?>
                              <?php foreach ($userInfos as $userInfo) { ?>
                                   <?php                          
                                   if ($userInfo['verification'] == 0){
                                        $verificationStatus = "UNVERIFIED";
                                   } else {
                                        $verificationStatus = "VERIFIED";
                                   }?>
                                   <div class="user-card">
                                        <div class="user-card-content">
                                             <img class="profile-picture" src="../../../public/img/profile.jpg" alt="Profile Image">
                                             <div class="content-details">
                                                  <p class="detail-title">User ID:</p>
                                                  <p><?php echo htmlspecialchars($userInfo['user_id']); ?></p>
                                             </div>
                                             <div class="content-details">
                                                  <p class="detail-title">Username: </p>
                                                  <p><?php echo htmlspecialchars($userInfo['username']); ?></p>
                                             </div>
                                             <div class="content-details">
                                                  <p class="detail-title">Email: </p>
                                                  <p><?php echo htmlspecialchars($userInfo['email']); ?></p>
                                             </div>
                                             <div class="content-details">
                                                  <p class="detail-title">Verification Status: </p>
                                                  <p><?php echo htmlspecialchars($verificationStatus); ?></p>
                                             </div>
                                             <div class="ban-container">
                                                  <button class="ban-button" id="banUser" data-user-id="<?php echo htmlspecialchars($userInfo['user_id']);?>">Ban</button>
                                             </div>
                                        </div>
                                   </div>                         
                              <?php } ?>
                    </div>                    

          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/adminUser.js"></script>

</body>

</html>