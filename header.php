<?php 

	if (!isset($_SESSION['sid']) || !isset($_SESSION['semail']) || !isset($_SESSION['sfname']) || !isset($_SESSION['slname'])) {
		header("location: login.php?msg=Something went wrong&class=alert-danger");
		exit();
	}

	$sid = $_SESSION['sid'];
	$cid = $_SESSION['cid'];
	$form = $_SESSION['form'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/style.css?s=<?= time(); ?>">
	<link rel="icon" href="assets/savess.jpg" type="image/x-icon">
	<title>Learning</title>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-sm navbar-dark " style="background-color: #000080;">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php"><img src="assets/savess.jpg" width="30" style="border-radius: 50%;" alt=""> Savess</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">Home</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" href="courses.php">My Courses</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="learn.php">My Learning</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link" href="profile.php">My Profile</a>
						</li>
					</ul>
					
					<ul class="navbar-nav mb-2 mb-lg-0">
						<li class="nav-item">
							<a href="logout.php" class="nav-link active"><i class="fas fa-power-off"></i> Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
