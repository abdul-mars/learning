<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/style.css?s=<?= time(); ?>">
	<link rel="icon" href="../assets/savess.jpg" type="image/x-icon">
	<?php $page = (isset($_GET['page']) && $_GET['page'] != ''? $_GET['page'] : 'dashboard') ?>
	<title><?= ucfirst($page); ?></title>
</head>
<body>
	<?php 
		include_once '../inc/config.php';
		include_once '../inc/header.php';
		include_once '../inc/sidebar.php';
		include_once '../inc/functions.php';

		if (isset($_GET['page'])) {
			include_once $_GET['page'].'.php';
		} else {
			include_once 'dashboard.php';
		}
		
	?>



	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-3.7.1.min.js"></script>
	<!-- <script src="js/jsdelivr.js"></script> -->
	<script src="../js/script.js?s=<?= time(); ?>"></script>
</body>
</html>
<style>
	
</style>
