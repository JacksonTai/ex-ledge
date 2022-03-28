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

               <div class="user-search-wrapper">
                    <input class="user-search-bar" id="search_text" type="text" placeholder="Search user" autocomplete="off">
                    <button class="user-search-btn" type="submit">
                         <i class="fas fa-search"></i>
                    </button>
               </div>
               <div class="card-container" id="user_container"></div>
               <div class="card-container_message"></div>                    
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/admin/manageUser.js"></script>
     <script src="<?php echo $path; ?>public/js/load/user.js"></script>

</body>

</html>