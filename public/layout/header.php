<?php

// Change file directories for index.php and files in app/view.
$url = $_SERVER['REQUEST_URI'];

// Path for signin.php and signup.php pages.
strpos($url, 'app/view') ? $entryPath = '../../public/' : $entryPath = '../app/view/';

// Path for index.php page.
strpos($url, 'app/view') ? $mainPath = '../../public/' : $mainPath = '';

// Path for images.
strpos($url, 'app/view') ? $imgPath = '../../public/img/icons/' : $imgPath = 'img/icons/';
?>

<header class="layout-header">
    <h1 class="layout-header__logo">
        <a class="layout-header__logo-link" href="<?php echo $mainPath; ?>index.php">
            <img class="layout-header__logo-img" src="<?php echo $imgPath; ?>logo.jpg" alt="Modeo logo">
            <span class="layout-header__logo-text">Ex-Ledge</span>
        </a>
    </h1>
    <nav class="layout-header__nav">
        <!-- Hide signin & signup button on signin & signup pages -->
        <?php if (!strpos($url, 'signin') && !strpos($url, 'signup')) : ?>
            <div class="layout-header__btn-container">
                <a class="layout-header__btn layout-header__btn--signin" href="<?php echo $entryPath; ?>signin.php">
                    Sign in
                </a>
                <a class="layout-header__btn layout-header__btn--signup" href="<?php echo $entryPath; ?>signup.php">Sign up</a>
            </div>
        <?php endif; ?>
    </nav>
    <div class="layout-header__hamburger-menu">
        <span class="layout-header__hamburger-bar"></span>
        <span class="layout-header__hamburger-bar"></span>
        <span class="layout-header__hamburger-bar"></span>
    </div>
</header>