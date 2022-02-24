<?php $user="admin"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../public/layout/head.php'?>
    <title>Admin | Ex-Ledge</title>
    <link rel="stylesheet" href="../../public/css/admin.css">
</head>
<body>
    <?php include '../../public/layout/header.php'; ?>

    <div class="container">
        <div class="sidebar">

            <div class="sidebar-column">
                <a href="#" class="text">Dashboard</a>
                <a href="#" class="text">Manage Q&A</a>
                <a href="#" class="text">Manage user</a>
                <a href="#" class="text">User verification</a>
                <a href="#" class="text">Log out</a>
            </div>
            
        </div>

        <div class="admin-dashboard">
    
            <div class="admin-container">
                <p class="txt-3110">Admin Dashboard</p>

                <div class="panel">
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

                <div class="panel">
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

            </div>
        </div>
    </div>


    <script src="../../public/js/script.js"></script>
</body>
</html>