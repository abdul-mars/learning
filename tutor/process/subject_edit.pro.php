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

	if (empty($_POST['esjname']) || empty($_POST['sjid'])) {
	  	$msg = 'All fields are required';
	  	$class = 'alert-danger';
	  	header("location: ../index.php?page=courses&msg=$msg&class=$class");
	  	exit();
	}

	$sjid = cleanInput($con, ucwords($_POST['sjid']));
	$esjname = cleanInput($con, ucwords($_POST['esjname']));

	$sql = mysqli_query($con, "UPDATE subjects SET cid = $cid, sjname = '$esjname' WHERE sjid = $sjid");

	if ($sql) {
		$msg = 'Subject Updated Successfully';
	  	$class = 'alert-success';
		header("location: ../index.php?page=Subjects&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Failed to Update Course';
	  	$class = 'alert-danger';
		header("location: ../index.php?page=courses&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);
