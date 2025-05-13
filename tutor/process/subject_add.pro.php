<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	// $stid = $_SESSION['stid']; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=subjects&msg=$msg&class=$class");
		exit();
	}

	$isCoreSubject = 0;
	if ((empty($_POST['sjname'])) || (!isset($_POST['isCoreSubject']) && empty($_POST['cid']))) {
	  	$msg = 'All fields are required';
	  	$class = 'alert-danger';
	  	header("location: ../index.php?page=subjects&msg=$msg&class=$class");
	  	exit();
	}

	$cid = cleanInput($con, ucwords($_POST['cid']));
	$sjname = cleanInput($con, ucwords($_POST['sjname']));
	$isCoreSubject = cleanInput($con, ucwords($_POST['isCoreSubject']));
	$type = 'elective';

	// echo "<pre>";
	// print_r($_POST);

	if (isset($_POST['isCoreSubject'])) {
		$cid = NULL;
		$type = 'core';
	}

	$data = array(
		'cid' => $cid,
		'sjname' => ucwords($sjname),
		'type' => $type
	);

	// print_r($data);

	if (insertData($con, 'subjects', $data)) {
		$msg = 'New Subject Added Successfully';
	  	$class = 'alert-success';
		header("location: ../index.php?page=subjects&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Failed to Add Subject';
	  	$class = 'alert-danger';
		header("location: ../index.php?page=subjects&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);
