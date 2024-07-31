<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	$lid = $_SESSION['lid']; 
	// echo $lid;

	// if ($_SERVER['REQUEST_METHOD'] != "POST") {
	// 	$msg = 'Invalid Request';
	// 	$class = 'alert-danger';
	// 	header("location: ../learn.php?page=courses");
	// 	exit();
	// }

	$cmtext = cleanInput($con, ucwords($_POST['cmtext']));
	$ccid = cleanInput($con, $_POST['ccid']);

	$sql = mysqli_query($con, "INSERT INTO comments (ccid, lid, cmtext) VALUES('$ccid', '$lid', '$cmtext')");
	if ($sql) {
		echo "Commented Successfully";
	} else {
		echo "Unable to comment.";
	}

	mysqli_close($con);

	
	