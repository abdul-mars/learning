<?php 
	error_reporting();
	$con = mysqli_connect('localhost', 'root', '', 'learning');

	$courses = fetchData($con, 'courses');

?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3>All Courses</h3>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseMdl"><i class="fas fa-plus"></i> Add Course</button>

		<!-- add course modal -->
		<div class="modal fade" id="addCourseMdl" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="createCourseModalLabel">Add New Course</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/course_add.pro.php" id="addCourseForm" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="mb-3">
								<label for="cname" class="form-label">Course Name</label>
								<input type="text" class="form-control" id="cname" name="cname" placeholder="Enter course title" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" form="addCourseForm" class="btn btn-primary">Create Course</button>
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
			<?php $sql = mysqli_query($con, "SELECT * FROM courses");
			if (mysqli_num_rows($sql) < 1) {
				echo "No Course found";
			} else { ?>
			<table class="table table-hover table-stripped shadow-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Course Name</th>
						<th># Subjects</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php $count = 1;
			while ($data = mysqli_fetch_assoc($sql)) { ?>
				<tr class="">
					<td><?= $count; ?></td>
					<td><?= ucfirst($data['cname']); ?></td>
					<?php $ccsql = mysqli_query($con, "SELECT COUNT(*) AS tot_stu FROM students WHERE cid = ".$data['cid']);
					$ccdata = mysqli_fetch_assoc($ccsql); ?>
					<td><?= $ccdata['tot_stu']; ?></td>
					<td>
						<button class="btn btn-primary btn-sm editCourseBtn" data-bs-toggle="modal"
						 data-bs-target="#editCourseMdl"
						 data-cid="<?= ucfirst($data['cid']); ?>"
						 data-ecname="<?= ucfirst($data['cname']); ?>">
							<i class="fas fa-pencil"></i>
						</button>
						<!-- <a href="?page=content&cid=<?= $data['cid']; ?>&ctitle=<?= ucfirst($data['ctitle']); ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a> -->
						<!-- <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button> -->
					</td>
				</tr>
			<?php $count++; } ?>
					</tbody>
			</table>
			<?php } ?>					
		</div>

		<!-- edit course modal -->
		<div class="modal fade" id="editCourseMdl" data-bs-backdrop="static" tabindex="-1" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="">Edit Course</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/course_edit.pro.php" id="editCourseForm" method="post" enctype="multipart/form-data">
						<div class="modal-body">
								<input type="hidden" name="cid" id="cid">
							<div class="mb-3">
								<label for="ecname" class="form-label">Course Name</label>
								<input type="text" class="form-control" id="ecname" name="ecname" placeholder="Enter course title" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary px-3">Edit Course</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>