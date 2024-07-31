<?php 
	error_reporting();
	// $con = mysqli_connect('localhost', 'root', '', 'learning');
	$stid = $_SESSION['stid'];

	$teacher = fetchData($con, 'staff', '', ' WHERE stid = '.$stid);
	$tch = $teacher[0];
	$sjid = $tch['sjid'];

	$subject = fetchData($con, 'subjects', '', ' WHERE sjid = '.$sjid );

	$sub = $subject[0];

	$sjname = $sub['sjname'];
	// $sjid = $sub['sjid'];

	// $example = 'sljfsl';



?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3>All Lessons for <?= $sjname; ?></h3>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectMdl"><i class="fas fa-plus"></i> Add Lesson</button>

		<!-- add subject modal -->
		<div class="modal fade" id="addSubjectMdl" tabindex="-1" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="">Add New Lesson</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/lesson_add.pro.php" id="addCourseForm" method="post" enctype="multipart/form-data">
						<input type="hidden" name="sjid" value="<?= $sjid; ?>">
						<div class="modal-body">
							<div class="mb-3">
								<label for="lname" class="form-label">Lesson Name</label>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter course title" required>
							</div>
							<div class="mb-3">
								<label for="form" class="form-label">Form</label>
								<input type="number" min="1" max="3" step="1" class="form-control" id="form" name="form" placeholder="Enter students form" required>
							</div>
							<div class="mb-3">
								<label class="form-label" for="content">Content</label>
								<input class="form-control" type="file" name="content" id="content" accept=".mp4, .pdf">
							</div>
							<!-- <div class="mb-3 courseDiv">
								<label for="type" class="form-label">Type</label>
								<select name="type" id="type" class="form-select">
									<option value="">Select Course</option>
									<option value="PDF">PDF</option>
									<option value="Video">Video</option>
									<option value="Docx">Docx</option>
								</select>
							</div> -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" form="addCourseForm" class="btn btn-primary">Add Lesson</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div> <hr>

	<?php if (isset($_GET['msg']) && isset($_GET['class'])) { ?>
        <div class="alert <?= $_GET['class']; ?> alert-dismissible fade show" role="alert">
            <strong> <?= $_GET['msg']; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

	<div>
		<div class="table-responsive">
			<?php $sql = mysqli_query($con, "SELECT * FROM lessons WHERE sjid = $sjid");
			if (mysqli_num_rows($sql) < 1) {
				echo "No Lesson found. Add Lessons";
			} else { ?>
			<table class="table table-hover table-stripped shadow-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Lesson Name</th>
						<th>Type</th>
						<th>Content</th>
						<th>Class</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php $count = 1;
			while ($data = mysqli_fetch_assoc($sql)) { ?>
				<tr class="">
					<td><?= $count; ?></td>
					<td><?= ucfirst($data['ltitle']); ?></td>
					<td><?= ucfirst($data['ltype']); ?></td>
					<!-- <td><?= ucfirst($data['lcontent']); ?></td> -->
					<td>
						<iframe src="learning/../../<?= $data['lcontent']; ?>" width="60" height="60" frameborder="0" style="border-radius: 50%;" allowfullscreen></iframe>
					</td>
					<td>Form <?= $data['lform']; ?></td>
					<td>
						<button class="btn btn-primary btn-sm viewLessonBtn"
						data-bs-target="#viewLessonMdl"
						data-bs-toggle="modal"
						data-lname="<?= ucfirst($data['ltitle']); ?>"
						data-path="learning/../../<?= $data['lcontent']; ?>"
						data-form="Form <?= $data['lform']; ?>"
						data-type="<?= ucfirst($data['ltype']); ?>">View</button>
					</td>
				</tr>
			<?php $count++; } ?>
					</tbody>
			</table>
			<?php } ?>					
		</div>

		<!-- View Lesson Modal -->
		<div class="modal fade" id="viewLessonMdl" data-bs-backdrop="static" tabindex="-1" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-fullscreen">
				<div class="modal-content d-flex flex-column">
					<div class="modal-header">
						<h5 class="modal-title">View Lesson</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body flex-grow-1 d-flex flex-column">
						<div class="d-flex justify-content-around align-items-center mb-3">
							<div>
								<h4>Lesson Name: <b class="lname"></b></h4>
							</div>
							<div>
								<h4>Class: <b class="form"></b></h4>
							</div>
							<div>
								<h4>Type: <b class="type"></b></h4>
							</div>
						</div>
						<hr>
						<div class="iframe-container flex-grow-1 d-flex">
							<iframe src="learning/../../<?= $data['lcontent']; ?>" frameborder="0" class="w-100 h-100" allowfullscreen></iframe>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
  .iframe-container {
    flex-grow: 1;
    display: flex;
  }
  .iframe-container iframe {
    flex-grow: 1;
  }
</style>