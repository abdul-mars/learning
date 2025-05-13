<div class="main-content">
	<div class="row">
		<div class="col-sm-12 col-md-3 mt-2">
			<div class="card card-body shadow-sm">
				<div class="cards d-flex justify-content-between align-items-center">
					<i class="fas fa-file-alt fa-3x text-muted"></i>
					<div class="text-center">
						<?php $sql = mysqli_query($con, "SELECT COUNT(*) AS tot_courses FROM courses");
						$data = mysqli_fetch_assoc($sql); ?>
						<h3><?= $data['tot_courses']; ?></h3>
						<h5>Total Courses</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-3 mt-2">
			<div class="card card-body shadow-sm">
				<div class="cards d-flex justify-content-between align-items-center">
					<div class=""><i class="fas fa-file-code fa-3x text-muted"></i></div>
					<div class="text-center">
						<?php $sql = mysqli_query($con, "SELECT COUNT(*) AS tot_subjects FROM subjects");
						$data = mysqli_fetch_assoc($sql); ?>
						<h3><?= $data['tot_subjects']; ?></h3>
						<h5>Total Subjects</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-3 mt-2">
			<div class="card card-body shadow-sm">
				<div class="cards d-flex justify-content-between align-items-center">
					<i class="fas fa-chalkboard-teacher fa-3x text-muted"></i>
					<div class="text-center">
						<?php $sql = mysqli_query($con, "SELECT COUNT(*) AS tot_staff FROM staff");
						$data = mysqli_fetch_assoc($sql); ?>
						<h3><?= $data['tot_staff']; ?></h3>
						<h5>Total Staff</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-3 mt-2">
			<div class="card card-body shadow-sm">
				<div class="cards d-flex justify-content-between align-items-center">
					<i class="fas fa-user-graduate fa-3x text-muted"></i>
					<div class="text-center">
						<?php $sql = mysqli_query($con, "SELECT COUNT(*) AS tot_students FROM students");
						$data = mysqli_fetch_assoc($sql); ?>
						<h3><?= $data['tot_students']; ?></h3>
						<h5>Total Learners</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>