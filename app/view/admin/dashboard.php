<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';

$path = '../../../';

$admins= new \Controller\User();
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

    <div class="main-sidebar-wrapper">
        <?php include '../layout/sideNavbar.php' ?>

        <main class="dashboard--main main-content">
            <h2 class="dashboard__title main-title">Admin Dashboard</h2>

            <div class="panel dialog">
                <div class="panel-card-stats">
                    <p class="panel-title">Verified ratio</p>
                    <p class="panel-title-stat"><?php if($admins->returnAdministrativeData()[0]['users']==0){echo("N/A");} 
                    else {echo(substr($admins->returnAdministrativeData()[0]['users']/$admins->returnAdministrativeData()[1]['users'], 0, 4));}?>
                    </p>
                </div>
                <div class="panel-detail registered-users">
                    <div class="panel-card-stats">
                        <p class="panel-card-stat-count"><?php echo($admins->returnAdministrativeData())[0]['users']?></p>
                        <p class="panel-card-title">Verified users</p>
                    </div>
                </div>
                <div class="panel-detail total-users">
                    <div class="panel-card-stats">
                        <p class="panel-card-stat-count"><?php echo($admins->returnAdministrativeData())[1]['users']?></p>
                        <p class="panel-card-title">Total users</p>
                    </div>
                </div>
            </div>

            <div class="panel dialog">
                <div class="panel-card-stats">
                    <p class="panel-title">Q/A ratio</p>
                    <p class="panel-title-stat"><?php if($admins->returnAdministrativeData()[2]['answers']==0){echo("N/A");} 
                    else {echo(substr($admins->returnAdministrativeData()[3]['questions']/$admins->returnAdministrativeData()[2]['answers'], 0, 4));}?>
                    </p>
                </div>
                <div class="panel-detail total-ans">
                    <div class="panel-card-stats">
                        <p class="panel-card-stat-count"><?php echo($admins->returnAdministrativeData())[2]['answers']?></p>
                        <p class="panel-card-title">Total Answers</p>
                    </div>
                </div>
                <div class="panel-detail total-questions">
                    <div class="panel-card-stats">
                        <p class="panel-card-stat-count"><?php echo($admins->returnAdministrativeData())[3]['questions']?></p>
                        <p class="panel-card-title">Total Questions</p>
                    </div>
                </div>
            </div>
        </main>

    </div>



    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>