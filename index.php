<?php session_start();
	require_once 'inc/config.php';
	require_once 'inc/functions.php';
	include_once 'header.php';

	// $form = 2;
	
	// function to get number of lessons for each course and form
	function getTotalLessons($con, $sjid, $form) {
		$totLsns = 0;
		$tSql = mysqli_query($con, "SELECT COUNT(*) AS tot_lsns FROM lessons WHERE sjid = $sjid AND lform = $form");
		if (mysqli_num_rows($tSql) > 0) {
			$tData = mysqli_fetch_assoc($tSql);
			$totLsns = $tData['tot_lsns'];
		}
		return $totLsns;
	}

	$csSql = mysqli_query($con, "SELECT * FROM courses WHERE cid = $cid");
	$csData = mysqli_fetch_assoc($csSql);

?>

	<div class="container">
		<div class="courseTitle">
			<h4>All Subjects For <?= $csData['cname']; ?> Form <?= $form; ?></h4>
		</div>
		<?php if (isset($_GET['msg']) && isset($_GET['class'])) { ?>
	        <div class="alert <?= $_GET['class']; ?> alert-dismissible fade show" role="alert">
	            <strong> <?= $_GET['msg']; ?></strong>
	            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	        </div>
	    <?php } ?>
    
		<div class="containe-fluid my-4">
			<div class="row">
				<?php 
				$subjects = fetchData($con, 'subjects', '', " WHERE cid = $cid OR type = 'core'");
				if (empty($subjects)) {
					echo "No Subject Found";
				} else { 
					foreach($subjects as $subject) { ?>
						<div class="col-md-4 col-sm-6 mb-4">
							<div class="card shadow-sm h-100">
								<div class="card-body">
									<h4 class="card-title"><?= $subject['sjname']; ?></h4>
									<p class="card-text"><?= getTotalLessons($con, $subject['sjid'], $form); ?> Lessons</p>
								</div>
								<a href="learn.php?sjid=<?= $subject['sjid']; ?>" class="stretched-link">
									<div class="card-footer text-center bg-primary text-white">
										<h5>Start Learning</h5>
									</div>
								</a>
							</div>
						</div>
					<?php }
				} ?>
			</div>
		</div>
	</div>



<?php include_once 'footer.php'; ?>