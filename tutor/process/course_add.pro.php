<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	$stid = $_SESSION['stid']; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	if (empty($_POST['cname'])) {
	  	$msg = 'All fields are required';
	  	$class = 'alert-danger';
	  	header("location: ../index.php?page=courses&msg=$msg&class=$class");
	  	exit();
	}

	$cname = cleanInput($con, ucwords($_POST['cname']));

	$data = array(
		'cname' => ucwords($cname)
	);

	if (insertData($con, 'courses', $data)) {
		$msg = 'New Course Added Successfully';
	  	$class = 'alert-success';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Failed to Add Course';
	  	$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);
