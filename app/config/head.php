<?php
// Change file directories for index.php and files in app/view.
$url = $_SERVER['REQUEST_URI'];
strpos($url, 'app/view') ? $headPath = '../../../public/' : $headPath = '';
strpos($url, 'app/view') ? $headPath = '../../../public/' : $headPath = '';
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="copyright" content="Copyright <?= date('Y'); ?> - Ex-Ledge">
<meta name="description" content="Welcome to Ex-Ledge! A forum-based educational system that aids Malaysian high school students in their studies.">
<meta name="author" content="Chua E Heng | Ho Chang Yong | Jackson Tai | Lim Jun Yao">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="shortcut icon" href="<?= $headPath ?>img/icons/logo.ico" type="image/x-icon">
<link rel="stylesheet" href="<?= $headPath ?>css/global.css">
<link rel="stylesheet" href="<?= $headPath ?>css/layout/header.css">
<link rel="stylesheet" href="<?= $headPath ?>css/layout/sidebar.css">
<link rel="stylesheet" href="<?= $headPath ?>css/layout/footer.css">