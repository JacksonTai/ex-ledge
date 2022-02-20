<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<script src="https://use.fontawesome.com/410aa0416b.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body>
	<header class="layout-header">
		<h1 class="layout-header__logo">
			<a class="layout-header__logo-link" href="#">
				<img class="layout-header__logo-img" src="img/icons/logo.jpg" alt="Modeo logo">
				<span class="layout-header__logo-text">Ex-Ledge</span>
			</a>
		</h1>
		<div>
			<img class="profile_img" src="img/user_img.jpg" alt="profile">
		</div>
		<form method="POST">
			<div class="search_container">
				<input class="search_box" type="text" name="search_key" placeholder="   Seach...." >
				<button class="search_button" type="submit" name="search_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
			</div>
		</form>
	</header>



	<div id="mySidenav" class="sidenav">
		<a href="#" class="sidenav-text">Home</a>
		<a href="#" class="sidenav-text">Users</a>
		<a href="#" class="sidenav-text">Leaderboard</a>
		<a href="#" class="sidenav-text">Logout</a>
	</div>

	<div>
		<h1>Leaderboard</h1>
	</div>
	
	<!-- top 3 -->
	<div class="top-small_box">
		<div class="s_box">
			<div class="top2-s_half_box">
				<p class="pt">1123 pt</p>
				<img class="top_img" src="img/user_img.jpg" alt="top img">
				<h3>changyongg</h3>
			</div>
		</div>
	</div>

	<div class="top-small_box">
		<div class="s_box">
			<div class="top1-s_half_box">
				<p class="pt">1123 pt</p>
				<img class="top_img" src="img/user_img.jpg" alt="top img">
				<h3>changyongg</h3>
			</div>
		</div>
	</div>

	<div class="top-small_box">
		<div class="s_box">
			<div class="top3-s_half_box">
				<p class="pt">1123 pt</p>
				<img class="top_img" src="img/user_img.jpg" alt="top img">
				<h3>changyongg</h3>
			</div>
		</div>
	</div>

	<!-- all ranking -->
	<div class="rank_tag">
		<p>No&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Users&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Point</p>
	</div>

	<div class="long_box">
		<div class="l_box">
			<p class="rank_no">1</p>
			<img class="rank_img" src="img/user_img.jpg" alt="top img">
			<p class="rank_name">changyongg</p>
			<p class="rank_pt">1123</p>
			<button class="view_profile_btn">View Profile</button>
		</div>
	</div>

	<div class="long_box">
		<div class="l_box">
			<p class="rank_no">2</p>
			<img class="rank_img" src="img/user_img.jpg" alt="top img">
			<p class="rank_name">changyongg</p>
			<p class="rank_pt">1123</p>
			<button class="view_profile_btn">View Profile</button>
		</div>
	</div>

	<div class="long_box">
		<div class="l_box">
			<p class="rank_no">3</p>
			<img class="rank_img" src="img/user_img.jpg" alt="top img">
			<p class="rank_name">changyongg</p>
			<p class="rank_pt">1123</p>
			<button class="view_profile_btn">View Profile</button>
		</div>
	</div>

	<div class="long_box">
		<div class="l_box">
			<p class="rank_no">4</p>
			<img class="rank_img" src="img/user_img.jpg" alt="top img">
			<p class="rank_name">changyongg</p>
			<p class="rank_pt">1123</p>
			<button class="view_profile_btn">View Profile</button>
		</div>
	</div>


</body>

</html>