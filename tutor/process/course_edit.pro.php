<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	$stid = $_SESSION['stid']; // staff's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	if (empty($_POST['ecname']) || empty($_POST['cid'])) {
	  	$msg = 'All fields are required';
	  	$class = 'alert-danger';
	  	header("location: ../index.php?page=courses&msg=$msg&class=$class");
	  	exit();
	}

	$cid = cleanInput($con, ucwords($_POST['cid']));
	$ecname = cleanInput($con, ucwords($_POST['ecname']));

	$sql = mysqli_query($con, "UPDATE courses SET cname = '$ecname' WHERE cid = $cid");

	if ($sql) {
		$msg = 'Course Updated Successfully';
	  	$class = 'alert-success';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Failed to Update Course';
	  	$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);
