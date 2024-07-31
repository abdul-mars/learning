<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	$lid = $_SESSION['lid'];

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=courses");
		exit();
	}

	$cid = cleanInput($con, ucwords($_POST['cid']));
	$lid = cleanInput($con, ucwords($_POST['lid']));

	
	if (empty($cid) || empty($lid)) {
		$msg = 'Something went wrong';
		$class = 'alert-danger';
		header("location: ../index.php?msg=$msg&class=$class");
		exit();
	}

	$sql = mysqli_query($con, "SELECT * FROM enrolls WHERE lid = '$lid' AND cid = '$cid'");
	if (mysqli_num_rows($sql) > 1) {
		$msg = 'You cant enroll on the same course again';
		$class = 'alert-danger';
		header("location: ../index.php?msg=$msg&class=$class");
		exit();
	}

	$sql = mysqli_query($con, "INSERT INTO enrolls (lid, cid) VALUES ('$lid', '$cid')");

	if ($sql) {
		$msg = 'You have successfuly enrolled a course';
		$class = 'alert-success';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Unable to enroll a course';
		$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);