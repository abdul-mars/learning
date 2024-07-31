<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	require_once '../auth_api/auth_functions.php';

	$tid = 1; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../login.php?page=courses");
		exit();
	}

	$email = cleanInput($con, $_POST['email']);
	$password = cleanInput($con, $_POST['password']);

	
	if (empty($email) || empty($password)) {
		$msg = 'Something went wrong';
		$class = 'alert-danger';
		header("location: ../index.php?msg=$msg&class=$class");
		exit();
	}

	$result = loginFunc($con, 'students', 'semail', 'spassword', $email, $password);
	// if ($result['data'] != null) {
	if ($result['session'] == true) {
		$sfname = $_SESSION['sfname'] = $result['data']['sfname'];
		$slname = $_SESSION['slname'] = $result['data']['slname'];
		$semail = $_SESSION['semail'] = $result['data']['semail'];
		$sid = $_SESSION['sid'] = $result['data']['sid'];
		$cid = $_SESSION['cid'] = $result['data']['cid'];
		$form = $_SESSION['form'] = $result['data']['form'];

		header("location: ../index.php");
		exit();
	} else {
		$response = $result['response'];
		header("location: ../login.php?msg=$response&class=alert-danger");
		exit();
	}
	
	mysqli_close($con);