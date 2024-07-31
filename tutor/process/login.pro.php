<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	require_once '../../auth_api/auth_functions.php';

	$tid = 1; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../login.php?page=courses&msg=$msg&class=$class");
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

	$result = loginFunc($con, 'staff', 'stemail', 'stpassword', $email, $password);
	// if ($result['data'] != null) {
	if ($result['session'] == true) {
		$stfname = $_SESSION['stfname'] = $result['data']['stfname'];
		$stlname = $_SESSION['stlname'] = $result['data']['stlname'];
		$stemail = $_SESSION['stemail'] = $result['data']['stemail'];
		$strole = $_SESSION['strole'] = $result['data']['strole'];
		$stid = $_SESSION['stid'] = $result['data']['stid'];

		if ($strole != 'admin') {
			// $page = 'lessons';
			header("location: ../?page=lessons");
			exit();
		}

		header("location: ../index.php");
		exit();
	} else {
		$response = $result['response'];
		header("location: ../login.php?msg=$response&class=alert-danger");
		exit();
	}
	
	mysqli_close($con);