<?php session_start();
	require_once '../inc/config.php';
	require_once '../inc/functions.php';

	$ccid = $_POST['ccid'];
	$sql = mysqli_query($con, "SELECT * FROM comments LEFT JOIN learners ON comments.lid = learners.lid WHERE ccid = '$ccid'");
	if (mysqli_num_rows($sql) > 0) {
		while ($data = mysqli_fetch_assoc($sql)) { ?>
			<li class="comment bg-light p-2">
				<h5><?= ucwords($data['llname'].' '.$data['lfname']); ?></h5>
				<span class="text-muted"><?= $data['cmdate']; ?></span>
				<div class="commnetText">
					<?= $data['cmtext']; ?>
				</div>
				<!-- <button class="btn btn-primary my-2 px-4">Reply</button>
				<div>
					<textarea name="" id="" cols="" rows="1" class="form-control shadow-sm"></textarea>
					<button class="btn btn-primary mt-2 px-4">Send Reply</button>
				</div> -->
			</li>
		<?php }
	} ?>