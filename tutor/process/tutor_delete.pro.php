<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	$tid = cleanInput($con, $_GET['tid']); // tutor's id

	$sql = mysqli_query($con, "DELETE FROM staff WHERE tid = '$tid'");

	if ($sql) {
		$msg = 'Tutor deleted Successfully';
		$class = 'alert-success';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Unable to delete tutor';
		$class = 'alert-danger';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);