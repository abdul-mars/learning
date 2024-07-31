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



	// $id = cleanInput($con, $_POST['id']);
	$oldpass = cleanInput($con, $_POST['oldpass']);
	$newpass = cleanInput($con, $_POST['newpass']);
	$cpass = cleanInput($con, $_POST['cpass']);

	if ($newpass !== $cpass) {
		header("location: ../index.php?page=profile&msg=Passwords do not match&class=alert-danger");
		exit();	
	}

	$sql = mysqli_query($con, "SELECT stpassword FROM staff WHERE stid = '$stid'");
	$data = mysqli_fetch_assoc($sql);

	if (!password_verify($oldpass, $data['stpassword'])) {
		header("location: ../index.php?page=profile&msg=Incorrect password&class=alert-danger");
		exit();
	}

	
	$newpass = password_hash($newpass, PASSWORD_DEFAULT);
	$sql = mysqli_query($con, "UPDATE staff SET stpassword = '$newpass' WHERE stid = '$stid'");
	if ($sql) {
		header("location: ../index.php?page=profile&msg=password changed successfully&class=alert-success");
		exit();		
	} else {
		header("location: ../index.php?page=profile&msg=Unable to change password&class=alert-danger");
		exit();
	}

	mysqli_close($con);
