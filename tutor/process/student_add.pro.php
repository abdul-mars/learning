<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	// $tid = 1; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=students&msg=$msg&class=$class");
		exit();
	}

	$slname = cleanInput($con, ucwords($_POST['slname']));
	$sfname = cleanInput($con, ucwords($_POST['sfname']));
	$semail = cleanInput($con, strtolower($_POST['semail']));
	$form = cleanInput($con, $_POST['form']);
	$cid = cleanInput($con, $_POST['cid']);
	$spassword = cleanInput($con, $_POST['spassword']);

	$checkEmail = fetchData($con, 'students', '*', " WHERE semail = '$semail'");

	if (!empty($checkEmail)) {
		$msg = 'Email is already registered';
		$class = 'alert-danger';
		header("location: ../index.php?page=students&msg=$msg&class=$class");
		exit();
	}

	// echo "<pre>";
	// print_r($_POST);

	$spassword = password_hash($spassword, PASSWORD_DEFAULT);

	$data = array (
		'sfname' => $sfname,
		'slname' => $slname,
		'semail' => $semail,
		'spassword' => $spassword,
		'cid' => $cid,
		'form' => $form
	);

	// print_r($data);

	if (insertData($con, 'students', $data)) {
		$msg = 'New student added Successfully';
		$class = 'alert-success';
		header("location: ../index.php?page=students&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Unable to add student';
		$class = 'alert-danger';
		header("location: ../index.php?page=students&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);