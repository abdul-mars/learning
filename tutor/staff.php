<?php 
	// error_reporting(0);

?>
<div class="main-content">
	<div class="d-flex justify-content-between align-items-center mb-2">
		<h3>All Staff</h3>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseMdl"><i class="fas fa-plus"></i> Add Staff</button>

		<!-- add staff modal -->
		<div class="modal fade" id="addCourseMdl" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="createCourseModalLabel">Add New Staff</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="process/staff_add.pro.php" id="" method="post">
						<div class="modal-body">
							<div class="mb-2">
								<label for="stlname" class="form-label">Lastname</label>
								<input type="text" class="form-control" id="stlname" name="stlname" placeholder="Enter tutor's Lastname" required>
							</div>
							<div class="mb-2">
								<label for="stfname" class="form-label">Firstname</label>
								<input type="text" class="form-control" id="stfname" name="stfname" placeholder="Enter tutor's Firstname" required>
							</div>
							<div class="mb-2">
								<label for="stemail" class="form-label">Email</label>
								<input type="text" class="form-control" id="stemail" name="stemail" placeholder="Enter tutor's email" required>
							</div>
							<div class="mb-2">
								<label for="role" class="form-label">Role</label>
								<select name="role" id="role" class="form-select">
									<option value="teacher">Teacher</option>
									<option value="admin">Admin</option>
								</select>
							</div>
							<div class="mb-2">
								<label for="sjid" class="form-label">Subject</label>
								<select name="sjid" id="sjid" class="form-select">
									<option value=""></option>
									<?php 
									$where = 'WHERE sjid NOT IN (SELECT sjid FROM staff)';
									$subjects = fetchData($con, 'subjects', '', $where);
									if (!empty($subjects)) {
										foreach ($subjects as $subject) {
											echo "<option value=".$subject['sjid'].">".$subject['sjname']."</option>";
										}
									} ?>
								</select>
							</div>
							<div class="mb-2">
								<label for="stpassword" class="form-label">Password(auto generated)</label>
								<input type="text" class="form-control" id="stpassword" name="stpassword" value="<?= genratepass(); ?>" readonly required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Add Tutor</button>
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
			<?php $sql = mysqli_query($con, "SELECT * FROM staff LEFT jOIN subjects on staff.sjid = subjects.sjid");
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
						<th>Role</th>
						<th>Subject</th>
					</tr>
				</thead>
				<tbody>
			<?php $count = 1;
			while ($data = mysqli_fetch_assoc($sql)) { ?>
				<tr>
						<td><?= $count; ?></td>
						<td><?= ucfirst($data['stlname']); ?></td>
						<td><?= ucfirst($data['stfname']); ?></td>
						<td><?= $data['stemail']; ?></td>
						<td><?= ucfirst($data['strole']); ?></td>
						<td><?= $data['sjname']; ?></td>
					</tr>
			<?php $count++; } ?>
					</tbody>
				</table>
			<?php } ?>					
		</div>
	</div>
</div>