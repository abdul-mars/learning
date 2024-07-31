<?php 
	if (!isset($_GET['cid'])) {
		$msg = 'Invalid Request';
		$class = 'alert-danger';
		header("location: ../login.php");
		exit();
	} 

	$cid = $_GET['cid'];
	// $ctitle = $_GET['ctitle'];
	$sql = mysqli_query($con, "SELECT * FROM courses WHERE cid = '$cid'");
	$data = mysqli_fetch_assoc($sql);
	$ctitle = $data['ctitle'];

?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<div>
			<span>Course:</span>
			<h3><?= $ctitle; ?></h3>
		</div>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseMdl"><i class="fas fa-plus"></i> Add Chapter</button>

		<div class="modal fade" id="addCourseMdl" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="createCourseModalLabel">Add New Chapter</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/chapter_add.pro.php" id="addChapterForm" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<input type="hidden" id="cid" name="cid" value="<?= $cid; ?>" required>
							<div class="mb-3">
								<label for="title" class="form-label">Chapter Title</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Enter chapter title" required>
							</div>
							<div class="mb-3">
								<label for="video" class="form-label">Chapter Video</label>
								<input type="file" class="form-control" id="video" name="video" accept=".mp4" required>
							</div>
							<div class="mb-3">
								<label for="desc" class="form-label">Course Description</label>
								<textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Describe your course here"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" form="addChapterForm" name="submit" class="btn btn-primary">Add Chapter</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <hr>
	<div>
		<div class="table-responsive">
			<h4 class="text-center mb-3"><u>All Chapters</u></h4>
			<?php $sql = mysqli_query($con, "SELECT * FROM chapters WHERE cid = '$cid'");
			if (mysqli_num_rows($sql) < 1) {
				echo "No chapter yet";
			} else { ?>
			<table class="table table-hover table-stripped shadow-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Chapter Title</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $count = 1;
				while ($data = mysqli_fetch_assoc($sql)) { ?>
					<tr>
						<td><?= $count; ?></td>
						<td><?= ucwords($data['cctitle']); ?></td>
						<td><?= ucwords($data['ccdesc']); ?></td>
						<td>
							<button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
						</td>
					</tr>
					<?php $count++; } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
</div>