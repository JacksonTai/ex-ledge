<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../config/head.php' ?>
    <title>Home | Ex-Ledge</title>
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/home.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="main-sidebar-wrapper">

        <?php include '../layout/sidebar.php' ?>
        <!-- Note: Every main content goes inside main tag, except for the sidebar on right side. (Delete once readed) -->
        <main class="home--main main-content">
            <div class="title-ctnr">
                <!-- h1 is not being used as it's being used for logo. (Delete once readed) -->
                <h2 class="home__title main-title">Question Ask: </h2>
                <div><button>Filter</button></div>
            </div>
            <!-- DUPLICATE AS NEEDED -->
            <div class="post-ctnr">
                <div class="vote-tab">
                    <i class="vote-arrow rotate-up"></i>
                    <p>1</p>
                    <i class="vote-arrow rotate-down"></i>
                </div>
                <div class="post-ctnt">
                    <div class="post-title">
                        <!-- Try to aVoid inline styling. (Delete once readed)
                            Reference: 
                            https://dev.to/alim1496/avoid-using-inline-css-styles-5b6p
                        -->
                        <h2 style="font-weight: 400;">what is the</h2>
                        <p>clickable button</p>
                    </div>
                    <div class="post-preview">
                        <p>ksdhjfskhfjdhjkfsdhjk</p>
                    </div>
                    <div class="post-tags">
                        <span>asdasdasd</span><span>asdassad</span><span>asdsdaasdasd</span><span>adsasdsda</span><span>asdasdasdasd</span>
                    </div>
                    <div class="post-info">
                        <p>posted by</p>
                    </div>
                </div>
            </div>
            <!-- DUPLICATE END   -->
        </main>

        <!-- SIDEBAR -->
        <aside class="home--sidebar">
            <div class="trending">
                <button>Ask questions</button>
                <div class="trending-tab">
                    <h3>Top Users</h3>
                    <hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
                <div class="trending-tab">
                    <h3>Hot Topics</h3>
                    <hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
            </div>
        </aside>

    </div>

    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>