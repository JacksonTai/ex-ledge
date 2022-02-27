<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../config/head.php' ?>
    <title>Dashboard | Ex-Ledge</title>
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/admin/dashboard.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="container">
        <div class="main-sidebar-wrapper">

            <?php include '../layout/sidebar.php' ?>

            <main class="dashboard--main main-content">
                <h2 class="dashboard__title main-title">Admin Dashboard</h2>
 
                <div class="panel dialog">
                    <div class="panel-card-stats">
                        <p class="panel-title">Total visits</p>
                        <p class="panel-title-stat">12089</p>
                    </div>
                    <div class="panel-detail registered-users">
                        <div class="panel-card-stats">
                            <p class="panel-card-stat-count">3089</p>
                            <p class="panel-card-title">Registered user</p>
                        </div>
                    </div>
                    <div class="panel-detail total-users">
                        <div class="panel-card-stats">
                        <p class="panel-card-stat-count">7890</p>
                        <p class="panel-card-title">Total User</p>
                        </div>
                    </div>
                </div>

                <div class="panel dialog">
                    <div class="panel-card-stats">
                        <p class="panel-title">Total answered</p>
                        <p class="panel-title-stat">79%</p>
                    </div>
                    <div class="panel-detail total-ans">
                        <div class="panel-card-stats">
                            <p class="panel-card-stat-count">591</p>
                            <p class="panel-card-title">Total Answers</p>
                        </div>
                    </div>
                    <div class="panel-detail total-questions">
                        <div class="panel-card-stats">
                            <p class="panel-card-stat-count">743</p>
                            <p class="panel-card-title">Total Questions</p>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>