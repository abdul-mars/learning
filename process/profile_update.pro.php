<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	if (!isset($_SESSION['sid']) || !isset($_SESSION['semail'])) {
		header("location: ../login.php?msg=Something went wrong&class=alert-danger");
		exit();
	}

	$sid = $_SESSION['sid'];

	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("location ../profile.php?msg=Invalid Request&class=alert-danger");
		exit();
	}

	// $lid = cleanInput($con, $_POST['lid']);
	$firstname = cleanInput($con, $_POST['firstname']);
	$lastname = cleanInput($con, ucwords($_POST['lastname']));
	$email = strtolower($_POST['email']);

	
	$sql = mysqli_query($con, "UPDATE students SET sfname = '$firstname', slname = '$lastname', semail = '$email' WHERE sid = '$sid'");
	if ($sql) {
		header("location: ../profile.php?msg=Profile updated successfully&class=alert-success");
		exit();		
	} else {
		header("location: ../profile.php?msg=Unable to update profile&class=alert-danger");
		exit();
	}

	mysqli_close($con);
