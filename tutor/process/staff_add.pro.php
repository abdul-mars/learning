<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	// $tid = 1; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	}

	$stlname = cleanInput($con, ucwords($_POST['stlname']));
	$stfname = cleanInput($con, ucwords($_POST['stfname']));
	$stemail = cleanInput($con, strtolower($_POST['stemail']));
	$role = cleanInput($con, $_POST['role']);
	$sjid = cleanInput($con, $_POST['sjid']);
	$stpassword = cleanInput($con, $_POST['stpassword']);

	$checkEmail = fetchData($con, 'staff', '*', " WHERE stemail = '$stemail'");

	if (!empty($checkEmail)) {
		$msg = 'Email is already registered';
		$class = 'alert-danger';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	}

	// echo "<pre>";
	// print_r($_POST);

	$stpassword = password_hash($stpassword, PASSWORD_DEFAULT);

	$data = array (
		'stfname' => $stfname,
		'stlname' => $stlname,
		'stemail' => $stemail,
		'stpassword' => $stpassword,
		'sjid' => $sjid,
		'strole' => $role
	);

	// print_r($data);

	if (insertData($con, 'staff', $data)) {
		$msg = 'New Staff added Successfully';
		$class = 'alert-success';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	} else {
		$msg = 'Unable to add Staff';
		$class = 'alert-danger';
		header("location: ../index.php?page=staff&msg=$msg&class=$class");
		exit();
	}

	mysqli_close($con);