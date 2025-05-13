<?php //session_start();
	//require_once 'inc/config.php';
	
	$stid = $_SESSION['stid'];
	// echo $lid;

	//include_once 'header.php';


	$sql = mysqli_query($con, "SELECT * FROM staff WHERE stid = '$stid'");
	$data = mysqli_fetch_assoc($sql);

	$sjid = $data['sjid'];
?>

	<div class="main-content">
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<div class="courseTitle">
					<h4>Profile Informaiton</h4>
				</div> <hr>
				<div class="card card-body shadow-sm">
					<dt>
						<dl>Lastname</dl>
						<dd><?= $data['stlname']; ?></dd>
					</dt>
					<dt>
						<dl>Firstname</dl>
						<dd><?= $data['stfname']; ?></dd>
					</dt>
					<dt>
						<dl>email</dl>
						<dd><?= $data['stemail']; ?></dd>
					</dt>
					<dt>
						<dl>Subject Teaching</dl>
						<?php $sSql = mysqli_query($con, "SELECT * FROM subjects WHERE sjid = '$sjid'");
						$sData = mysqli_fetch_assoc($sSql); ?>
						<dd><?= (empty($sData) ? 'Not Teaching' : $sData['sjname']); ?></dd>
					</dt>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<h4 class="chapterTitle text-center mt-2 courseTitle">Update Profile</h4> <hr>

				<?php if (isset($_GET['msg']) && isset($_GET['class'])) { ?>
				<div class="alert <?= $_GET['class']; ?> alert-dismissible fade show" role="alert">
					<strong> <?= $_GET['msg']; ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php } ?>
				
				<div>
					<form action="process/profile_update.pro.php" method="post" class="card card-body shadow-sm">
						<div class="form-group mt-2">
							<label for="lastname">Lastname:</label>
							<input type="text" class="form-control" name="lastname" id="lastname" value="<?= $data['stlname']; ?>" required>
						</div>
						<div class="form-group mt-2">
							<label for="firstname">Firstname:</label>
							<input type="text" class="form-control" name="firstname" id="firstname" value="<?= $data['stfname']; ?>" required>
						</div>
						<div class="form-group mt-2">
							<label for="email">Email:</label>
							<input type="email" class="form-control" name="email" id="email" value="<?= $data['stemail']; ?>" required>
						</div>
						<div class="form-group mt-2">
			            	<button type="submit" class="btn btn-primary btn-block" style="width: 100%">Update Profile</button>
			            </div>
			            <div class="form-group mt-2">
			            	<button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#changePassMdl" style="width: 100%">Change Password</button>
			            </div>
					</form>
					<!-- change password Modal -->
					<div class="modal fade" id="changePassMdl" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="process/password_change.pro.php" method="post">
									<div class="modal-body">
										<div class="form-group mt-2">
											<label for="oldpass">Old Password:</label>
											<input type="text" class="form-control" name="oldpass" id="oldpass" required>
										</div>
										<div class="form-group mt-2">
											<label for="newpass">New Password:</label>
											<input type="text" class="form-control" name="newpass" id="newpass" required>
										</div>
										<div class="form-group mt-2">
											<label for="cpass">Re-enter Password:</label>
											<input type="text" class="form-control" name="cpass" id="cpass" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary">Change Passwod</button>
									</div>
								</form>
							</div>
						</div>
					</div>
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
						<input type="hidden" name="cid" id="cid">
						<input type="hidden" name="lid" id="lid" value="<?= $lid; ?>">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Enroll</button>
					</div>
				</form>
			</div>
		</div>
	</div>


