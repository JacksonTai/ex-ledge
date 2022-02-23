<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../public/layout/head.php' ?>
     <link rel="stylesheet" href="../../public/css/student.css">
     <title>Home | Ex-Ledge</title>
</head>

<body>

     <?php include '../../public/layout/header.php'; ?>

     <aside class="student-aside--left">

     </aside>

     <main class="student--main">
          <p><?= $_SESSION['userId'] ?? ''; ?></p>
     </main>

     <aside class="student-aside--right">

     </aside>

     <?php include '../../public/layout/footer.php'; ?>

     <script src="../../public/js/script.js"></script>
     <script src="../../public/js/student.js"></script>
</body>

</html>