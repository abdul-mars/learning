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



	// $id = cleanInput($con, $_POST['id']);
	$oldpass = cleanInput($con, $_POST['oldpass']);
	$newpass = cleanInput($con, $_POST['newpass']);
	$cpass = cleanInput($con, $_POST['cpass']);

	if ($newpass !== $cpass) {
		header("location: ../profile.php?msg=Passwords do not match&class=alert-danger");
		exit();	
	}

	$sql = mysqli_query($con, "SELECT spassword FROM students WHERE sid = '$sid'");
	$data = mysqli_fetch_assoc($sql);

	if (!password_verify($oldpass, $data['spassword'])) {
		header("location: ../profile.php?msg=Incorrect password&class=alert-danger");
		exit();
	}

	
	$newpass = password_hash($newpass, PASSWORD_DEFAULT);
	$sql = mysqli_query($con, "UPDATE students SET spassword = '$newpass' WHERE sid = '$sid'");
	if ($sql) {
		header("location: ../profile.php?msg=password changed successfully&class=alert-success");
		exit();		
	} else {
		header("location: ../profile.php?msg=Unable to change password&class=alert-danger");
		exit();
	}

	mysqli_close($con);
