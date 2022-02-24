<?php
// Change file directories for index.php and files in app/view.
$url = $_SERVER['REQUEST_URI'];

// Path for signin.php and signup.php pages.
strpos($url, 'app/view') ? $entryPath = '../../../public/' : $entryPath = '../app/view/verification/';

// Path for clicking logo.
strpos($url, 'app/view') ? $logoPath = '../../../public/index.php' : $logoPath = 'index.php';

if (isset($_SESSION['userId'])) {
    $logoPath = $_SERVER['PHP_SELF'];
}

// Path for images.
strpos($url, 'app/view') ? $imgPath = '../../../public/img/icons/' : $imgPath = 'img/icons/';

?>

<header class="layout-header">
    <h1 class="layout-header__logo">
        <a class="layout-header__logo-link" href="<?php echo $logoPath; ?>">
            <img class="layout-header__logo-img" src="<?php echo $imgPath; ?>logo.jpg" alt="Modeo logo">
            <span class="layout-header__logo-text">Ex-Ledge</span>
        </a>
    </h1>
    <nav class="layout-header__nav">
        <?php if (isset($_SESSION['userId'])) : ?>
            <div class="layout-header__btn-container">
                <?php if ($_SESSION['userId'][0] == "A") : ?>
                    <a class="layout-header__btn--admin" href="../admin/dashboard.php">Dashboard</a>
                    <a class="layout-header__btn--admin" href="../admin/manageQA.php">Manage Q&A</a>
                    <a class="layout-header__btn--admin" href="../admin/manageUser.php">Manage user</a>
                    <a class="layout-header__btn--admin" href="../admin/userVerification.php">User Verification</a>
                <?php elseif ($_SESSION['userId'][0] == "U") : ?>
                    <a class="layout-header__btn--admin" href="../student/home.php">Home</a>
                    <a class="layout-header__btn--admin" href="../student/user.php">Users</a>
                    <a class="layout-header__btn--admin" href="../student/leaderboard.php">Leaderboard</a>
                <?php endif; ?>
                <a class="layout-header__btn--admin" href="../../helper/logout.php">Log Out</a>
            </div>
        <?php else : ?>
            <?php if (!strpos($url, 'signin') && !strpos($url, 'signup')) : ?>
                <div class="layout-header__btn-container">
                    <a class="layout-header__btn layout-header__btn--signin" href="<?php echo $entryPath; ?>signin.php">
                        Sign in
                    </a>
                    <a class="layout-header__btn layout-header__btn--signup" href="<?php echo $entryPath; ?>signup.php">Sign up</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
    <div class="layout-header__hamburger-menu">
        <span class="layout-header__hamburger-bar"></span>
        <span class="layout-header__hamburger-bar"></span>
        <span class="layout-header__hamburger-bar"></span>
    </div>
</header>