<?php 
	error_reporting();
	$con = mysqli_connect('localhost', 'root', '', 'learning');

	$courses = fetchData($con, 'courses');

	$example = 'sljfsl';

?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h3>All Subjects</h3>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectMdl"><i class="fas fa-plus"></i> Add Subject</button>

		<!-- add subject modal -->
		<div class="modal fade" id="addSubjectMdl" tabindex="-1" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="">Add New Subject</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/subject_add.pro.php" id="addCourseForm" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="mb-3">
								<label for="sjname" class="form-label">Subject Name</label>
								<input type="text" class="form-control" id="sjname" name="sjname" placeholder="Enter course title" required>
							</div>
							<div class="mb-3 form-check form-switch">
								<input class="form-check-input" type="checkbox" role="switch" name="isCoreSubject" id="isCoreSubject">
								<label class="form-check-label" for="isCoreSubject">It Is Core Subject</label>
							</div>
							<div class="mb-3 courseDiv">
								<label for="cid" class="form-label">Course</label>
								<select name="cid" id="cid" class="form-select">
									<option value="">Select Course</option>
									<?php 
									$courses = fetchData($con, 'courses');
									if (!empty($courses)) {
										foreach ($courses as $course) {
											echo "<option value=".$course['cid'].">".$course['cname']."</option>";
										}
									} ?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" form="addCourseForm" class="btn btn-primary">Add Subject</button>
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
			<?php $sql = mysqli_query($con, "SELECT * FROM subjects LEFT JOIN courses ON subjects.cid = courses.cid");
			if (mysqli_num_rows($sql) < 1) {
				echo "No Subject found";
			} else { ?>
			<table class="table table-hover table-stripped shadow-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Subject Name</th>
						<th>Couse</th>
						<th>Type</th>
						<!-- <th>Action</th> -->
					</tr>
				</thead>
				<tbody>
			<?php $count = 1;
			while ($data = mysqli_fetch_assoc($sql)) { ?>
				<tr class="">
					<td><?= $count; ?></td>
					<td><?= ucfirst($data['sjname']); ?></td>
					<td><?= ucfirst($data['cname']); ?></td>
					<td><?= ucfirst($data['type']); ?></td>
					<!-- <td>
						<button class="btn btn-primary btn-sm editCourseBtn" data-bs-toggle="modal"
						 data-bs-target="#editSubjectMdl"
						 data-sjid="<?= ucfirst($data['sjid']); ?>"
						 data-ecid="<?= ucfirst($data['cname']); ?>"
						 data-esjname="<?= ucfirst($data['sjname']); ?>">
							<i class="fas fa-pencil"></i>
						</button>
					</td> -->
				</tr>
			<?php $count++; } ?>
					</tbody>
			</table>
			<?php } ?>					
		</div>

		<!-- edit course modal -->
		<div class="modal fade" id="editSubjectMdl" data-bs-backdrop="static" tabindex="-1" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="">Edit Course</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/subject_edit.pro.php" id="editCourseForm" method="post" enctype="multipart/form-data">
						<div class="modal-body">
								<input type="text" name="sjid" id="sjid">
							<div class="mb-3">
								<label for="ecid" class="form-label">Course Name</label>
								<select name="ecid" id="ecid" class="form-select">
									<option value="" id="ecidFirst"></option>
								</select>
							</div>
							<div class="mb-3">
								<label for="esjname" class="form-label">Subject Name</label>
								<input type="text" class="form-control" id="esjname" name="esjname" placeholder="Enter course title" required>
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