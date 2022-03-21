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
     <title>User Verification | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/userVerification.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="user-verification--main main-content">
               <h2 class="user-verification__title main-title">User Verification</h2>

               <?php 
               $userVerif = $user->readVerification(); 
               $verifNo = 1;
               ?>
               <?php foreach ($userVerif as $user) : ?>
                    <div class="user-verification-wrapper" id="<?php echo htmlspecialchars($user['user_id']) ?>" data-user-id=<?php echo htmlspecialchars($user['user_id']) ?>>
                         <div class="user-verification dialog">
                              <h3 class="user-verification--no"><?php echo $verifNo++; ?></h3>
                              <div class="user-verification-content-container">
                                   <img class="user-verification--img profile-icon" src="../../../public/img/profile1.jpg" alt="">
                                   <div class="user-verification-content">
                                        <p class="user-verification--full-name">
                                             <span class="user-verification__label">Full name: </span>
                                             <?php echo htmlspecialchars($user['full_name']) ?>
                                        </p>
                                        <p class="user-verification--ic-num">
                                             <span class="user-verification__label">NRIC: </span>
                                             <?php echo htmlspecialchars($user['nric_no']) ?>
                                        </p>
                                   </div>
                              </div>
                              <form action="" method="POST">
                                   <div class="user-verification-btn-container">
                                        <button class="user-verification-btn user-verification-btn--accept" type="accept" name="acceptVerif">Accept</button>
                                        <button class="user-verification-btn user-verification-btn--reject" type="reject">Reject</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               <?php endforeach; ?>
               
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>

<!-- <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "ex_ledge";

// $conn = mysqli_connect($servername, $username, $password, $database);

// if (!$conn) {
//      die("<script>alert('Connection Failed.')</script>");
//  }

// if(isset($_POST['accept'])) { 

//      $result = mysqli_query($conn, "UPDATE user SET verification='1' WHERE user_id = '$user[user_id]'");

//      if ($result) {
//           echo "<script>pop_up_success()</script>"; 
//      } else {
//      echo "<script>alert('Something went wrong')</script>"; 
//      }
// }

?> -->