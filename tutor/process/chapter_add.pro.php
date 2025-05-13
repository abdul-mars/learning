<?php session_start();
	require_once '../../inc/config.php';
	require_once '../../inc/functions.php';

	// $tid = 1; // tutor's id

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
		exit();
	}

	// echo "<pre>";
	// print_r($_POST);

	$cid = cleanInput($con, $_POST['cid']);
	$title = cleanInput($con, ucwords($_POST['title']));
	$desc = cleanInput($con, ucwords($_POST['desc']));
	$video = $_FILES['video'];
	// $type = cleanInput($con, ucwords($_POST['courseType']));

	
	if (empty($cid) || empty($title) || empty($desc) || empty($video)) {
		$msg = 'All fields are required';
		$class = 'alert-danger';
		header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
		exit();
	}

	if ($video['error'] === UPLOAD_ERR_OK) {
	    // Get file information
	    $videoName = uniqid() . '_' . basename($video['name']); // Unique name
	    $videoTmpName = $video['tmp_name'];

	    // Move the uploaded file to a folder
	    $uploadDirectory = 'assets/videos/';
	    $videoPath = $uploadDirectory . $videoName;

	    if (move_uploaded_file($videoTmpName, '../../'.$videoPath)) {
	        // File uploaded successfully, insert data into database
	        $query = "INSERT INTO chapters (cid, cctitle, ccdesc, ccpath) VALUES ('$cid', '$title', '$desc', '$videoPath')";
	        if (mysqli_query($con, $query)) {
	            $msg = "Chapter added successfully.";
	            $class = 'alert-success';
	            header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
				exit();
	        } else {
	            $msg = "Error: " . $query . "<br>" . mysqli_error($con);
	        	// $msg = "Video uploaded and data inserted into the database successfully.";
	            $class = 'alert-danger';
	            header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
				exit();
	        }
	    } else {
	        $msg = "Error moving file to destination folder.";
	        $class = 'alert-danger';
	        header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
			exit();
	    }
	} else {
	    $msg = "Error uploading file: " . $video['error'];
        $class = 'alert-danger';
        header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
		exit();
	}

	// $sql = mysqli_query($con, "INSERT INTO content (tid, ctitle, cdesc, ctype, cprice) VALUES ('$tid', '$title', '$desc', '$type', '$price')");

	// if ($sql) {
	// 	$msg = 'Course Created Successfully';
	// 	$class = 'alert-success';
	// 	header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
	// 	exit();
	// } else {
	// 	$msg = 'Unable to create a course';
	// 	$class = 'alert-danger';
	// 	header("location: ../index.php?page=content&msg=$msg&class=$class&cid=$cid");
	// 	exit();
	// }

	mysqli_close($con);