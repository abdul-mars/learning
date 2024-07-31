<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	require_once '../auth_api/auth_functions.php';

	

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../signup.php?msg=$msg&class=$class");
		exit();
	}

	$fname = cleanInput($con, $_POST['fname']);
	$lname = cleanInput($con, $_POST['lname']);
	$email = cleanInput($con, $_POST['email']);
	$password = cleanInput($con, $_POST['password']);
	$confirmPassword = cleanInput($con, $_POST['confirmPassword']);

	if ($password !== $confirmPassword) {
		$msg = 'Passwords do not match';
		$class = 'alert-danger';
		header("location: ../signup.php?msg=$msg&class=$class");
		exit();
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$sql = mysqli_query($con, "INSERT INTO learners(llname,lfname,lemail,lpassword) VALUES('$lname', '$fname', '$email', '$password')");
	// if ($result['data'] != null) {
	if ($sql) {
		$lfname = $_SESSION['lfname'] = $fname;
		$llname = $_SESSION['llname'] = $lname;
		$lemail = $_SESSION['lemail'] = $email;
		$lid = $_SESSION['lid'] = mysqli_insert_id($con);

		header("location: ../index.php?msg=Account created successfully&class=alert-success");
		exit();
	} else {
		$msg = 'Unable to create Account';
		$class = 'alert-danger';
		header("location: ../signup.php?msg=$msg&class=alert-danger");
		exit();
	}
	
	mysqli_close($con);