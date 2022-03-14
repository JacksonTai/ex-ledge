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

          <?php include '../layout/sidebar.php' ?>

          <main class="user-verification--main main-content">
               <h2 class="user-verification__title main-title">User Verification</h2>


               <div class="pending-user">
                    <div class="pendinguser-ctnr">
                         <div class="numbering">1</div>
                         <div class="image"></div>
                         <div class="userinfo">Username: johndoe<br>I.C. Number: 123456-78-9100</div>

                    </div>
                    <div class="approval-ctnr">
                              <button>Accept</button>
                              <button>Reject</button>
                    </div>
               </div>

               
               <div class="pending-user">
                    <div class="pendinguser-ctnr">
                         <div class="numbering">1</div>
                         <div class="image"></div>
                         <div class="userinfo">Username: johndoe<br>I.C. Number: 123456-78-9100</div>

                    </div>
                    <div class="approval-ctnr">
                              <button>Accept</button>
                              <button>Reject</button>
                    </div>
               </div>


          </main>

     </div>

     .

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>