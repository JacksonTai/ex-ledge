<?php
session_start();
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
               <div class="user_container_message" id = "user_container_message"></div> 

               <nav class="home__main-nav">
                    <button class="home__main-nav-btn">
                         <a class="home__main-nav-link dialog" href="#">Back</a>
                    </button>
                    <p class="home__main-nav-page">1</p>
                    <button class="home__main-nav-btn">
                         <a class="home__main-nav-link dialog" href="#">Next</a>
                    </button>
               </nav>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/loadData.js"></script>

</body>

</html>