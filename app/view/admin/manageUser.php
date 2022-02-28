<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <title>Manage User | Ex-Ledge</title>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/manageUser.css">
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <div class="main-sidebar-wrapper">

          <?php include '../layout/sidebar.php' ?>

          <main class="manageUser--main main-content">
               <h2 class="manageUser__title main-title">Manage User</h2>
               <p><?= $_SESSION['userId']; ?></p>
          </main>

     </div>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>