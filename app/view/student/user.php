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
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/user.css?v=<?php echo time(); ?>">     	
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sideNavbar.php' ?>

          <main class="user--main main-content">
               <h2 class="user__title">Users</h2>
               
               <div class="user_dashboard">
                    <div class="user_container" id="user_container"></div> 
               </div>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/loadUser.js"></script>

</body>

</html>