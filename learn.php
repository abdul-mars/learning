<?php session_start();
	require_once 'inc/config.php';
	require_once 'inc/functions.php';

	include_once 'header.php';

	// $lid = $_SESSION['lid'];
	// $lid = 2;
	// $sjid = $_GET['sjid'];

	if (isset($_GET['sjid'])) {
		$sjid = $_GET['sjid'];
	} else {
		// $sql = mysqli_query($con, "SELECT sjid FROM subjects WHERE sjid = '$sjid' LIMIT 1");
		$sql = mysqli_query($con, "SELECT sjid FROM subjects WHERE cid = $cid OR type = 'core' ORDER BY RAND() LIMIT 1");
		if (mysqli_num_rows($sql) < 1) {
			$msg = 'There is currently no subject for you.';
			$class = 'alert-danger';
			header("location: index.php?msg=$msg&class=$class");
			exit();
		} 

		$data = mysqli_fetch_assoc($sql);
		$sjid = $data['sjid'];
		
		
	}
	
	$sql = mysqli_query($con, "SELECT * FROM subjects WHERE sjid = $sjid");
	$data = mysqli_fetch_assoc($sql);
	$sjname = $data['sjname'];

	if (isset($_GET['lid'])) {
		$lid = $_GET['lid'];
	} else {
		$getLidSql = mysqli_query($con, "SELECT * FROM lessons WHERE sjid = $sjid AND lform = $form");
		if (mysqli_num_rows($getLidSql) < 1) {
			$msg = 'There is currently no lesson for this subject.';
			$class = 'alert-danger';
			header("location: index.php?msg=$msg&class=$class");
			exit();
		} else {
			$getLidData = mysqli_fetch_assoc($getLidSql);
			$lid = $getLidData['lid'];
		}
	}

	// $lid = 1;

	$lessons = fetchData($con, 'lessons', '', " WHERE lid = $lid");
	if (empty($lessons)) {
		$msg = 'There is currently no lesson for this subject.';
		$class = 'alert-danger';
		header("location: index.php?msg=$msg&class=$class");
		exit();
	}

	$lesson = $lessons[0];
	// echo $form;


?>

    <style>
        .lesson-view {
            display: flex;
            /*flex-wrap: wrap;*/
            /*justify-content: space-between;*/
        }
        .mainContent {
            flex: 1;
            min-width: 300px;
        }
        .sidebarRight {
            width: 100%;
            max-width: 300px;
        }
        .lesson-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            /*transition: background-color 0.3s;*/
        }
        .lesson-item:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="container mt-4">
        <div class="row lesson-view">
            <!-- Main Content Area -->
            <div class="col-lg-8 mainContent mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Lesson Name: <?= $sjname; ?> - <?= $lesson['ltitle'] ?></h4>
                    </div>
                    <div class="card-body">
                        <iframe src="<?= $lesson['lcontent'] ?>" frameborder="0" style="width: 100%; height: 500px;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            
            <!-- Right SidebarRight -->
            <div class="col-lg-4 sidebarRight">
                <div class="card">
                    <div class="card-header">
                        <h5>Other Lessons</h5>
                    </div>
                    <div class="card-body">
                    	<?php 
                    	$otherLessons = fetchData($con, 'lessons', '*', " WHERE sjid = $sjid AND lform = $form");
                    	if (empty($otherLessons)) {
                    		echo "No other lessons available";
                    	} else {
                    		foreach ($otherLessons as $otherLesson) { ?>
                    			<div class="lesson-item">
		                            <h6><?= $otherLesson['ltitle']; ?></h6>
		                            <p><a href="learn.php?sjid=<?= $sjid; ?>&lid=<?= $otherLesson['lid']; ?>">View Lesson</a></p>
		                        </div>
                    		<?php }
                    	} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once 'footer.php'; ?>