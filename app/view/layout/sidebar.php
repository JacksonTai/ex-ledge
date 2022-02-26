<nav class="layout-side-navbar">
     <ul>
          <?php if ($_SESSION['userId'][0] == 'A') : ?>
               <li><a class="layout-side-navbar__link" href="../admin/dashboard.php">Dashboard</a></li>
               <li><a class="layout-side-navbar__link" href="../admin/manageQA.php">Manage Q&A</a></li>
               <li><a class="layout-side-navbar__link" href="../admin/manageUser.php">Manage user</a></li>
               <li><a class="layout-side-navbar__link" href="../admin/userVerification.php">User verification</a></li>
          <?php else : ?>
               <li><a class="layout-side-navbar__link" href="../student/home.php">Home</a></li>
               <li><a class="layout-side-navbar__link" href="../student/user.php">Users</a></li>
               <li><a class="layout-side-navbar__link" href="../student/leaderboard.php">Leaderboard</a></li>
          <?php endif; ?>
          <li><a class="layout-side-navbar__link" href="../../helper/logout.php">Log out</a></li>
     </ul>
</nav>