<?php session_start();
	require_once 'inc/config.php';
	
	// $lid = $_SESSION['lid'];
	$lid = 2;

	include_once 'header.php';
?>

	<div class="container">
		<div class="row">
			<div class="courseTitle">
					<h4>All Your Enrolled Courses</h4>
				</div>
			<!-- <div class="col-sm-12 col-md-8">
			</div> -->
			<!-- <div class="col-sm-1 col-md-4 d-none d-md-block"> -->
			<div class="col-12">
				<?php $sql = mysqli_query($con, "SELECT * FROM enrolls LEFT JOIN courses on enrolls.cid = courses.cid WHERE enrolls.lid = '$lid'");
				if (mysqli_num_rows($sql) < 1) {
					echo "You currently have not enrolled in any course";
				} else { 
					while($data = mysqli_fetch_array($sql)) { ?>
						<a href="learn.php?cid=<?= $data['cid']; ?>">
							<div class="content card card-body my-2">
								<div class=" d-flex justify-content-between align-items-center">
									<div>
										<h5 style="margin-bottom: -3px;"><?= $data['ctitle']; ?></h5>
										<span class="text-muted">20 Chapters</span>
									</div>
									<span><i class="far fa-play-circle fa-2x"></i></span>
								</div>
							</div>
						</a>
					<?php }
				} ?>
				</div>
			</div>
		</div>
	</div>

	<!-- enroll course Modal -->
	<div class="modal fade" id="enrolMdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Enroll Course</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="process/enroll.pro.php" method="post">
					<div class="modal-body text-center">
						<h4>Are you sure you want to enroll this course <span id="ectitle"></span>?</h4>
						<h5 id="ecdesc"></h5>
						<h5>Number of chapters <span id="ecchapters"></span></h5>
						<h5>Price is ¢<span id="ecprice"></span></h5>
						<input type="text" name="cid" id="cid">
						<input type="text" name="lid" id="lid" value="<?= $lid; ?>">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Enroll</button>
					</div>
				</form>
			</div>
		</div>
	</div>




<?php include_once 'footer.php'; ?>