<?php 
	// error_reporting(0);

?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-2">
		<h3>All Students</h3>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseMdl"><i class="fas fa-plus"></i> Add Student</button>

		<!-- add student modal -->
		<div class="modal fade" id="addCourseMdl" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="createCourseModalLabel">Add New Student</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/student_add.pro.php" id="" method="post">
						<div class="modal-body">
							<div class="mb-2">
								<label for="slname" class="form-label">Lastname</label>
								<input type="text" class="form-control" id="slname" name="slname" placeholder="Enter tutor's Lastname" required>
							</div>
							<div class="mb-2">
								<label for="sfname" class="form-label">Firstname</label>
								<input type="text" class="form-control" id="sfname" name="sfname" placeholder="Enter tutor's Firstname" required>
							</div>
							<div class="mb-2">
								<label for="semail" class="form-label">Email</label>
								<input type="text" class="form-control" id="semail" name="semail" placeholder="Enter tutor's email" required>
							</div>
							<div class="mb-2">
								<label for="cid" class="form-label">Course</label>
								<select name="cid" id="cid" class="form-select">
									<option value="">Select</option>
									<?php 
									$courses = fetchData($con, 'courses');
									if (!empty($courses)) {
										foreach ($courses as $course) {
											echo "<option value=".$course['cid'].">".$course['cname']."</option>";
										}
									} ?>
								</select>
							</div>
							<div class="mb-2">
								<label for="form" class="form-label">Form</label>
								<input type="number" min="1" max="3" step="1" class="form-control" id="form" name="form" placeholder="Enter students form" required>
							</div>
							<div class="mb-2">
								<label for="spassword" class="form-label">Password(auto generated)</label>
								<input type="text" class="form-control" id="spassword" name="spassword" value="<?= genratepass(); ?>" readonly required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Add Student</button>
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
			<?php $sql = mysqli_query($con, "SELECT * FROM students LEFT jOIN courses on students.cid = courses.cid");
			if (mysqli_num_rows($sql) < 1) {
				echo "No Staff Found";
			} else { ?>
			<table class="table table-hover table-stripped shadow-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Lastname</th>
						<th>Firstname</th>
						<th>Email</th>
						<th>Class</th>
						<th>Course</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php $count = 1;
			while ($data = mysqli_fetch_assoc($sql)) { ?>
				<tr>
						<td><?= $count; ?></td>
						<td><?= ucfirst($data['slname']); ?></td>
						<td><?= ucfirst($data['sfname']); ?></td>
						<td><?= $data['semail']; ?></td>
						<td>Form <?= ucfirst($data['form']); ?></td>
						<td><?= $data['cname']; ?></td>
						<td>
							<button class="btn btn-primary btn-sm"><i class="fas fa-trash"></i> Delete</button>
						</td>
					</tr>
			<?php $count++; } ?>
					</tbody>
				</table>
			<?php } ?>					
		</div>
	</div>
</div>