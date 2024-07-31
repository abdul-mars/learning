<?php //error_reporting(0);
	if (!isset($_SESSION['stid']) || !isset($_SESSION['stemail']) || !isset($_SESSION['stfname']) || !isset($_SESSION['stlname'])) {
		header("location: login.php?msg=Something went wrong&class=alert-danger");
		exit();
	}

	$role = $_SESSION['strole'];

?>

<header>
	<nav class="navbar navbar-expand-sm navbar-dark " style="background-color: #000080;">
		<div class="container-fluid">
			<!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarToggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button> -->
			<a class="navbar-brand" href="?page=dashboard"><img src="../assets/savess.jpg" width="30" style="border-radius: 50%;" alt=""> Savess</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?page=dashboard">Home</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="?page=courses">Courses</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?page=staff">Staff</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="?page=profile">Profile</a>
					</li>
				</ul>
				<ul class="navbar-nav mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
					</li>
				</ul>
				
			</div>
		</div>
	</nav>
</header>