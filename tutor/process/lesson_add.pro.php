<?php session_start();
    require_once '../../inc/config.php';
    require_once '../../inc/functions.php';


    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header("location ../index.php?page=lessons&msg=Invalid Request&class=alert-danger");
        exit();
    }

    $sjid = $_POST['sjid'];
    $lessonName = ucwords($_POST['lname']);
    $form = $_POST['form'];
    $file = $_FILES['content'];

    // echo "<pre>";
    // print_r($_POST);

    mysqli_begin_transaction($con);

    if ($file['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);

        // Determine the type based on MIME type
        $type = '';
        if (strpos($fileType, 'pdf') !== false) {
            $type = 'PDF';
        } elseif (strpos($fileType, 'video') !== false) {
            $type = 'Video';
        } else {
            // Handle unknown file type
            $type = 'Unknown';
        }

        if ($type == 'Unknown') {
            mysqli_rollback($con);
            $msg = 'Error uploading the file. Unsupported File Type';
            $class = 'alert-danger';
            header("location: ../?page=lessons&msg=$msg&class=$class");
            exit();
        }

        // Generate a unique name for the file and preserve the original extension
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;

        // Define the path where the file will be stored
        $uploadDir = '../../assets/lessons/';
        $filePath = $uploadDir . $uniqueFileName;

        // Define the path to be saved in the database
        $dbFilePath = 'assets/lessons/' . $uniqueFileName;

        // Move the file to the specified directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Insert the file information into the database
            $sql = mysqli_query($con, "INSERT INTO lessons (sjid, ltitle, ltype, lcontent, lform) VALUES ('$sjid','$lessonName', '$type', '$dbFilePath', '$form')");
            if ($sql) {
                mysqli_commit($con);
                $msg = 'New Lesson Added Successfully!';
                $class = 'alert-success';
                header("location: ../?page=lessons&msg=$msg&class=$class");
                exit();
            }
        } else {
            mysqli_rollback($con);
            $msg = 'Failed To Add New Lesson';
            $class = 'alert-danger';
            header("location: ../?page=lessons&msg=$msg&class=$class");
            exit();
        }
    } else {
        mysqli_rollback($con);
        $msg = 'Error uploading the file.';
        $class = 'alert-danger';
        header("location: ../?page=lessons&msg=$msg&class=$class");
        exit();
    }
