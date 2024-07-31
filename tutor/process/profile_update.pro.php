<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	if (!isset($_SESSION['stid']) || !isset($_SESSION['stemail'])) {
		header("location: ../login.php?msg=Something went wrong&class=alert-danger");
		exit();
	}

	$stid = $_SESSION['stid'];

	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("location ../index.php?page=profile&msg=Invalid Request&class=alert-danger");
		exit();
	}

	// $lid = cleanInput($con, $_POST['lid']);
	$firstname = cleanInput($con, $_POST['firstname']);
	$lastname = cleanInput($con, ucwords($_POST['lastname']));
	$email = strtolower($_POST['email']);

	
	$sql = mysqli_query($con, "UPDATE staff SET stfname = '$firstname', stlname = '$lastname', stemail = '$email' WHERE stid = '$stid'");
	if ($sql) {
		header("location: ../index.php?page=profile&msg=Profile updated successfully&class=alert-success");
		exit();		
	} else {
		header("location: ../index.php?page=profile&msg=Unable to update profile&class=alert-danger");
		exit();
	}

	mysqli_close($con);
