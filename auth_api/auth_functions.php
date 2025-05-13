<?php //session_start();
	// function cleanInput($con, $value) {
	// 	$value = htmlspecialchars($value);
	// 	$value = mysqli_real_escape_string($con, $value);
	// 	$value = strip_tags($value);
	// 	return $value;
	// }
	
	function loginFunc($con, $table, $usernameColumn, $passwordColumn, $username, $password) {
		$_SESSION['session'] = false;
	    $sql = mysqli_query($con, "SELECT * FROM ".$table ." WHERE ".$usernameColumn." = '".$username."'");
	    if (mysqli_num_rows($sql) < 1) {
	        $response = "Wrong Credentials";
	        $data = null; // No data found, set to null
	    } else {
	        $data = mysqli_fetch_assoc($sql);
	        $passFromDb = $data[$passwordColumn];
	        if (password_verify($password, $passFromDb)) {
	            $_SESSION['session'] = true;
	            $response = "Login successfully";
	        } else {
	        	$_SESSION['session'] = false;
	            $response = "Wrong Credentials";
	            $data = null; // Password verification failed, set data to null
	        }
	    }

	    $session = $_SESSION['session'];
	    return array('response' => $response, 'data' => $data, 'session' => $session);
	}
